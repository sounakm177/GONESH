<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublicMailbox;
use App\Models\PublicEmail;

class PublicEmailController extends Controller
{
    public function inbox($email)
    {
        $mailbox = PublicMailbox::where('email', $email)->firstOrFail();

        $emails = PublicEmail::where('mailbox_id', $mailbox->id)
                    ->latest()
                    ->get();

        return response()->json($emails);
    }

    public function show($id)
    {
        $email = PublicEmail::with('attachments')->findOrFail($id);

        return response()->json($email);
    }
}