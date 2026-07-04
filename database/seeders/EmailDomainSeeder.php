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