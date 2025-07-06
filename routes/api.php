<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

/*WEBHOOKS*/
Route::get('webhook/receive', [WebhookController::class, 'handle'])->name('webhook.recieve');
?>