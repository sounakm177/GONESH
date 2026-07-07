<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['slug' => 'free'],
            [
                'name' => 'Free',
                'description' => 'Get started with a basic temporary email address.',
                'price' => 0,
                'billing_cycle' => 'monthly',
                'max_addresses' => 2,
                'max_aliases' => 0,
                'max_domains' => 1,
                'max_api_requests_per_day' => 100,
                'max_smtp_sandboxes' => 0,
                'email_history_days' => 30,
                'is_active' => true,
            ]
        );

        Plan::updateOrCreate(
            ['slug' => 'pro'],
            [
                'name' => 'Pro',
                'description' => 'Unlock unlimited addresses, custom domains, and SMTP sandboxes.',
                'price' => 9.99,
                'billing_cycle' => 'monthly',
                'max_addresses' => -1,
                'max_aliases' => -1,
                'max_domains' => 10,
                'max_api_requests_per_day' => 10000,
                'max_smtp_sandboxes' => 10,
                'email_history_days' => 365,
                'is_active' => true,
            ]
        );
    }
}
