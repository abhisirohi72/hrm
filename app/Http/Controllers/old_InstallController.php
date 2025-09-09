<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use App\Services\CurlService;

class InstallController extends Controller
{
    protected $curlService;

    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }
    public function index()
    {
        return view('install.index');
    }

    public function checkPurchaseCode()
    {
        $title = "Check Purchase Code";
        return view('install.check_purchase_code', [
            'title' =>  $title
        ]);
    }

    public function savePurchaseCode(Request $request)
    {
        $request->validate([
            "purchase_code" =>  "required",
        ]);
        if (env('APP_PLATFORM') && env('APP_PLATFORM') == "local") {
            $url = "http://127.0.0.1:8001/api/webhook/create_purchase_code";
        } else {
            $url = "https://webfintech.in/api/webhook/create_purchase_code";
        }
        // $url = "http://127.0.0.1:8001/api/webhook/create_purchase_code";
        // echo $url;
        $response = app()->call('App\Http\Controllers\WebhookController@createPurchaseCode', [
            'request' => new Request(['purchase_code' => $request->purchase_code, 'client_ip' => $request->ip()])
        ]);
        $data = $response->getData(true);
        // echo "<pre>";
        // print_r($data);
        // exit;
        // var_dump($response['original']);
        // exit;
        if ($data && $data['status'] == 1) {
            return redirect()->route('installer.index');
        } else {
            return back()->with("error", "Purchase code not found!!!");
        }
    }

    public function systemCheck(Request $request)
    {
        $requirements = [
            'php_version' => [
                'status' => version_compare(PHP_VERSION, '8.3.0', '>='),
                'value' => PHP_VERSION,
                'required' => '>= 8.3',
            ],

            'mysql_version' => [
                'status' => $this->checkMySQLVersion('8.0'),
                'value' => $this->getMySQLVersion(),
                'required' => '>= 8.0 (or MariaDB >= 10.6)',
            ],

            'functions' => [
                'allow_url_fopen' => ini_get('allow_url_fopen'),
                'file_get_contents' => function_exists('file_get_contents'),
            ],

            'extensions' => [
                'bcmath'     => extension_loaded('bcmath'),
                'ctype'      => extension_loaded('ctype'),
                'curl'       => extension_loaded('curl'),
                'dom'        => extension_loaded('dom'),
                'fileinfo'   => extension_loaded('fileinfo'),
                'gd'         => extension_loaded('gd'),
                'json'       => extension_loaded('json'),
                'mbstring'   => extension_loaded('mbstring'),
                'openssl'    => extension_loaded('openssl'),
                'pcre'       => extension_loaded('pcre'),
                'pdo'        => extension_loaded('pdo'),
                'pdo_mysql'  => extension_loaded('pdo_mysql'),
                'tokenizer'  => extension_loaded('tokenizer'),
                'xml'        => extension_loaded('xml'),
                'filter'     => extension_loaded('filter'),
                'hash'       => extension_loaded('hash'),
                'session'    => extension_loaded('session'),
                'zip'        => extension_loaded('zip'),
            ],

            'composer' => shell_exec('composer --version') ? true : false,
        ];

        return view('install.system_check', compact('requirements'));
    }

    protected function checkMySQLVersion($minVersion = '8.0')
    {
        $version = $this->getMySQLVersion();
        return $version && version_compare($version, $minVersion, '>=');
    }

    protected function getMySQLVersion()
    {
        try {
            $pdo = new \PDO("mysql:host=" . env('DB_HOST', '127.0.0.1'), env('DB_USERNAME'), env('DB_PASSWORD'));
            return $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function databaseForm()
    {
        $title = "Database Connection";
        return view('install.database', ['title' => $title]);
    }

    protected function createDatabaseIfNotExists($dbName, $dbHost, $dbUsername, $dbPassword)
    {
        try {
            $pdo = new \PDO("mysql:host=$dbHost", $dbUsername, $dbPassword);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            return true;
        } catch (\Exception $e) {
            Log::error('❌ Could not create database', ['error' => $e->getMessage()]);
            return false;
        }
    }

    protected function setEnvValue($key, $value)
    {
        $envPath = base_path('.env');
        $line = "$key=$value";
        $env = File::get($envPath);
        $keyExists = preg_match("/^$key=.*$/m", $env);

        if ($keyExists) {
            $env = preg_replace("/^$key=.*$/m", $line, $env);
        } else {
            $env .= "\n$line";
        }

        File::put($envPath, $env);
    }

    public function saveDatabase(Request $request)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        try {
            $request->validate([
                'db_host' => 'required',
                'db_port' => 'required',
                'db_database' => 'required',
                'db_username' => 'required',
            ]);

            // Copy .env.example if .env doesn't exist
            if (!File::exists(base_path('.env'))) {
                File::copy(base_path('.env.example'), base_path('.env'));
            }

            // Update .env values
            $this->setEnvValue('DB_HOST', $request->db_host);
            $this->setEnvValue('DB_PORT', $request->db_port);
            $this->setEnvValue('DB_DATABASE', $request->db_database);
            $this->setEnvValue('DB_USERNAME', $request->db_username);
            $this->setEnvValue('DB_PASSWORD', $request->db_password);

            // 🟡 Create the database if it doesn't exist
            $this->createDatabaseIfNotExists(
                $request->db_database,
                $request->db_host,
                $request->db_username,
                $request->db_password
            );

            // 🟢 Dynamically update Laravel's config and reconnect
            config([
                'database.connections.mysql.host'     => $request->db_host,
                'database.connections.mysql.port'     => $request->db_port,
                'database.connections.mysql.database' => $request->db_database,
                'database.connections.mysql.username' => $request->db_username,
                'database.connections.mysql.password' => $request->db_password,
            ]);

            DB::purge('mysql');      // Clear old DB connection
            DB::reconnect('mysql');  // Reconnect using new config
            Log::info('✅ Laravel connected DB:', [DB::connection()->getDatabaseName()]);

            // 🔍 Test DB connection
            try {
                $pdo = new \PDO(
                    "mysql:host={$request->db_host};port={$request->db_port};dbname={$request->db_database}",
                    $request->db_username,
                    $request->db_password
                );
            } catch (\Exception $e) {
                Log::error('❌ DB Connection Failed: ' . $e->getMessage());
                return back()->with('error', 'Database connection failed: ' . $e->getMessage());
            }

            // ✅ Check connected DB name
            $dbName = DB::connection()->getDatabaseName();
            Log::info("✅ Connected to database: " . $dbName);

            // 🛠 Run migrations and seeders
            if (!$this->runMigrations()) {
                return back()->with('error', 'Migration failed. Check logs.');
            }

            // 🔒 Lock install
            File::put(storage_path('db.lock'), now());

            return redirect()->route('installer.index');
        } catch (\Throwable $e) {
            Log::error("❌ Unexpected error in saveDatabase", ['error' => $e->getMessage()]);
            return response("Something went wrong. Check logs.", 500);
        }
    }

    protected function runMigrations()
    {
        set_time_limit(300); // Allow enough time

        // Explicitly set new DB env vars for Artisan subprocess
        putenv('DB_CONNECTION=mysql');
        putenv('DB_HOST=' . config('database.connections.mysql.host'));
        putenv('DB_PORT=' . config('database.connections.mysql.port'));
        putenv('DB_DATABASE=' . config('database.connections.mysql.database'));
        putenv('DB_USERNAME=' . config('database.connections.mysql.username'));
        putenv('DB_PASSWORD=' . config('database.connections.mysql.password'));
        // Log::info('✅ Laravel connected DB on migration:', [DB::connection()->getDatabaseName()]);
        $commands = [
            'php artisan migrate --force',
            'php artisan db:seed --force',
        ];

        foreach ($commands as $cmd) {
            $descriptorspec = [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ];

            $process = proc_open($cmd, $descriptorspec, $pipes, base_path(), null);

            if (is_resource($process)) {
                $stdout = stream_get_contents($pipes[1]);
                $stderr = stream_get_contents($pipes[2]);

                fclose($pipes[1]);
                fclose($pipes[2]);

                $exitCode = proc_close($process);

                Log::info("✅ Command Output ($cmd):", [$stdout]);
                Log::error("⚠️ Command Error ($cmd):", [$stderr]);

                if ($exitCode !== 0) {
                    return false;
                }
            } else {
                Log::error("❌ Failed to run: $cmd");
                return false;
            }
        }
echo config('database.connections.mysql.database'); exit;
        return true;
    }

    public function success()
    {
        File::put(storage_path('installed.lock'), now());
        return view('install.success');
    }
}
