<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\InboundEmailService;
use Illuminate\Support\Facades\Log;

class ParseEmail extends Command
{
    protected $signature = 'email:parse';
    protected $description = 'Parse incoming email from Postfix';

    public function handle()
    {
        try {
            $rawEmail = file_get_contents("php://stdin");

            if (!$rawEmail) {
                Log::error("No email content received");
                return 1;
            }

            $service = app(InboundEmailService::class);

            $result = $service->processRawEmail($rawEmail);

            Log::channel('inbound')->info("Email processed", $result);

            return 0;

        } catch (\Throwable $e) {
            Log::error("Email parsing failed: " . $e->getMessage());
            return 1;
        }
    }
}