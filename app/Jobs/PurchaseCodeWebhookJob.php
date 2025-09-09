<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class PurchaseCodeWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $webhookData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $webhookData)
    {
        $this->webhookData = $webhookData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Processing Webhook:', $this->webhookData);
    }
}
