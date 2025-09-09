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

    // public function savePurchaseCode(Request $request)
    // {
    //     $request->validate([
    //         "purchase_code" =>  "required",
    //     ]);
    //     if (env('APP_PLATFORM') && env('APP_PLATFORM') == "local") {
    //         $url = "http://127.0.0.1:8001/api/webhook/create_purchase_code";
    //     } else {
    //         $url = "https://dhaliwalenterprises.com/purchase_code.php";
    //     }
    //     // $url = "http://127.0.0.1:8001/api/webhook/create_purchase_code";
    //     // echo $url;
    //     // $response = app()->call('App\Http\Controllers\WebhookController@createPurchaseCode', [
    //     //     'request' => new Request(['purchase_code' => $request->purchase_code, 'client_ip' => $request->ip()])
    //     // ]);
    //     $response = $this->curlService->sendPost($url, [
    //         'purchase_code' => $request->purchase_code,
    //         'client_ip' => $request->ip()
    //     ]);
    //     // var_dump($response);
    //     // echo "<pre>";
    //     // print_r($response);
    //     // echo "return".$response['status'];
    //     // // exit;
    //     if ($response && $response['status'] == "yes") {
    //         // echo "bla";
    //         return redirect()->route('installer.index');
    //     } else {
    //         // echo "else";
    //         return back()->with("error", "Purchase code not found!!!");
    //     }
    // }
    public function savePurchaseCode(Request $request)
    {
        $request->validate([
            "purchase_code" =>  "required",
        ]);
        $url = "https://dhaliwalenterprises.com/purchase_code.php";
        // $url = "http://127.0.0.1:8001/api/webhook/create_purchase_code";
        $response = $this->curlService->sendPost($url, [
            'purchase_code' => $request->purchase_code,
            'client_ip' => $request->ip()
        ]);
        // echo "<pre>";
        // print_r($response);
        // exit;
        if ($response && $response['status'] == "yes") {
            // echo "if";
            return redirect()->route('installer.index');
        } else {
            // echo "else";
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
        // echo $url = url('/'); exit;
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
            Log::info('✅ Laravel connected DB1:', [DB::connection()->getDatabaseName()]);
            $request->validate([
                'db_host'     => 'required',
                'db_port'     => 'required',
                'db_database' => 'required',
                'db_username' => 'required',
            ]);

            // Copy .env.example if .env doesn't exist
            if (!File::exists(base_path('.env'))) {
                File::copy(base_path('.env.example'), base_path('.env'));
            }

            // Update .env
            $this->setEnvValue('DB_HOST', $request->db_host);
            $this->setEnvValue('DB_PORT', $request->db_port);
            $this->setEnvValue('DB_DATABASE', $request->db_database);
            $this->setEnvValue('DB_USERNAME', $request->db_username);
            $this->setEnvValue('DB_PASSWORD', $request->db_password);

            // Create database if not exists
            $this->createDatabaseIfNotExists(
                $request->db_database,
                $request->db_host,
                $request->db_username,
                $request->db_password
            );

            

            // Override runtime DB config
            config([
                'database.connections.mysql.host'     => $request->db_host,
                'database.connections.mysql.port'     => $request->db_port,
                'database.connections.mysql.database' => $request->db_database,
                'database.connections.mysql.username' => $request->db_username,
                'database.connections.mysql.password' => $request->db_password,
            ]);

            // 3. Purge and reconnect
            DB::purge('mysql');
            DB::reconnect('mysql');

            // Optional: Clear Laravel caches if using config cache
            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            Log::info('✅ Laravel connected DB3:', [DB::connection()->getDatabaseName()]);
            // Test DB connection
            try {
                DB::connection()->getPdo();
                Log::info("✅ Connected to DB5: " . DB::connection()->getDatabaseName());
            } catch (\Exception $e) {
                Log::error('❌ DB connection failed: ' . $e->getMessage());
                return back()->with('error', 'Database connection failed: ' . $e->getMessage());
            }

            // 4. Run migrations on updated connection
            try {
                $this->runMigrations();

                // Mark install
                File::put(storage_path('db.lock'), now());

                return redirect()->route('check.purchase.code')->with('success', 'DB saved & migrated.');
            } catch (\Throwable $e) {
                Log::error('Migration failed: ' . $e->getMessage());

                return response()->json([
                    'status' => false,
                    'message' => 'Migration failed: ' . $e->getMessage()
                ], 500);
            }
        } catch (\Throwable $e) {
            Log::error("❌ Unexpected error in saveDatabase", ['error' => $e->getMessage()]);
            return response("Something went wrong. Check logs.", 500);
        }
    }

    protected function runMigrations()
    {
        set_time_limit(300); // Allow enough time

        $artisanPath = base_path('artisan');

        // Run Migrations
        $migrateCmd = PHP_BINARY . " $artisanPath migrate:fresh --force";
        $seedCmd    = PHP_BINARY . " $artisanPath db:seed --force"; // <-- Add seeding

        $commands = [$migrateCmd, $seedCmd];

        foreach ($commands as $cmd) {
            $descriptorspec = [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ];

            $process = proc_open($cmd, $descriptorspec, $pipes);

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

        return true;
    }

    public function success()
    {
        $title= "Project Successful Active";

        File::put(storage_path('installed.lock'), now());
        
        return view('install.success', [
            "title" => $title
        ]);
    }
}
