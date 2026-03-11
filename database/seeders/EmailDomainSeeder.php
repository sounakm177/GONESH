<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailDomainSeeder extends Seeder
{
    public function run(): void
    {
        $domains = [
            ['domain' => 'inboxoro.com',  'label' => 'InboxOro',  'is_active' => true,  'is_premium' => false, 'sort_order' => 1],
            ['domain' => 'burnbox.dev',   'label' => 'BurnBox',   'is_active' => true,  'is_premium' => false, 'sort_order' => 2],
            ['domain' => 'zaptmp.net',    'label' => 'ZapTmp',    'is_active' => true,  'is_premium' => false, 'sort_order' => 3],
            ['domain' => 'voidmail.cc',   'label' => 'VoidMail',  'is_active' => true,  'is_premium' => false, 'sort_order' => 4],
            ['domain' => 'mailsink.app',  'label' => 'MailSink',  'is_active' => true,  'is_premium' => true,  'sort_order' => 5],
        ];

        foreach ($domains as $domain) {
            DB::table('email_domains')->updateOrInsert(
                ['domain' => $domain['domain']],
                array_merge($domain, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}