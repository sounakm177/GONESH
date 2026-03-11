<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublicMailbox;
use Illuminate\Support\Str;

class PublicMailboxController extends Controller
{
    public function generate(Request $request)
    {
        $domain = "inboxoro.com";

        $random = Str::lower(Str::random(8));

        $email = $random . '@' . $domain;

        $mailbox = PublicMailbox::create([
            'email' => $email,
            'domain' => $domain,
            'session_id' => session()->getId(),
            'expires_at' => now()->addMinutes(10)
        ]);

        if($request->ajax()){
            return response()->json($mailbox);
        }

        return view('welcome', ['mailbox' => $mailbox]);
    }
}
