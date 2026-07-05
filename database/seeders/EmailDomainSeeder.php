<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailDomainSeeder extends Seeder
{
    public function run(): void
    {
        $domains = [
            ['name' => 'inboxoro.com',  'display_name' => 'InboxOro',  'type' => 'free', 'status' => 'active', 'priority' => 1],
            ['name' => 'burnbox.dev',   'display_name' => 'BurnBox',   'type' => 'free', 'status' => 'active', 'priority' => 2],
            ['name' => 'zaptmp.net',    'display_name' => 'ZapTmp',    'type' => 'free', 'status' => 'active', 'priority' => 3],
            ['name' => 'voidmail.cc',   'display_name' => 'VoidMail',  'type' => 'free', 'status' => 'active', 'priority' => 4],
            ['name' => 'mailsink.app',  'display_name' => 'MailSink',  'type' => 'pro',  'status' => 'active', 'priority' => 5],
            [
                'name' => 'inboxoro.com',
                'display_name' => 'InboxOro',
                'type' => 'free',
                'status' => 'active',
                'is_system' => true,
                'mx_verified' => true,
                'priority' => 1,
                'health_score' => 100,
                'blocked_score' => 2,
            ],
            [
                'name' => 'burnbox.dev',
                'display_name' => 'BurnBox',
                'type' => 'free',
                'status' => 'active',
                'is_system' => true,
                'mx_verified' => true,
                'priority' => 2,
                'health_score' => 98,
                'blocked_score' => 5,
            ],
            [
                'name' => 'zaptmp.net',
                'display_name' => 'ZapTmp',
                'type' => 'free',
                'status' => 'active',
                'is_system' => true,
                'mx_verified' => true,
                'priority' => 3,
                'health_score' => 95,
                'blocked_score' => 8,
            ],
            [
                'name' => 'voidmail.cc',
                'display_name' => 'VoidMail',
                'type' => 'free',
                'status' => 'active',
                'is_system' => true,
                'mx_verified' => true,
                'priority' => 4,
                'health_score' => 92,
                'blocked_score' => 12,
            ],
            [
                'name' => 'mailsink.app',
                'display_name' => 'MailSink',
                'type' => 'pro',
                'status' => 'active',
                'is_system' => true,
                'mx_verified' => true,
                'priority' => 5,
                'health_score' => 100,
                'blocked_score' => 0,
            ],
            [
                'name' => 'securebox.pro',
                'display_name' => 'SecureBox',
                'type' => 'pro',
                'status' => 'active',
                'is_system' => false,
                'mx_verified' => true,
                'priority' => 6,
                'health_score' => 99,
                'blocked_score' => 1,
            ],
            [
                'name' => 'custom.example.com',
                'display_name' => 'Example Custom',
                'type' => 'custom',
                'status' => 'active',
                'is_system' => false,
                'mx_verified' => false,
                'priority' => 99,
                'health_score' => 85,
                'blocked_score' => 3,
            ],
        ];

        foreach ($domains as $domain) {
            DB::table('email_domains')->updateOrInsert(
                ['name' => $domain['name']],
                array_merge($domain, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}