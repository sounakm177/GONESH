<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Email;
use App\Models\EmailHeader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $query = $address->emails()->getQuery();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('from_name', 'like', "%{$search}%")
                  ->orWhere('from_email', 'like', "%{$search}%");
            });
        }

        if ($filter = $request->input('filter')) {
            if ($filter === 'unread') {
                $query->where('is_read', false);
            } elseif ($filter === 'starred') {
                $query->where('is_starred', true);
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        $perPage = min(max($perPage, 1), 100);

        $emails = $query->latest('received_at')->paginate($perPage);

        $data = $emails->map(function (Email $email) {
            return [
                'id' => $email->id,
                'sender' => $email->from_name ?: explode('@', $email->from_email)[0],
                'email' => $email->from_email,
                'avatar' => strtoupper(substr($email->from_name ?: $email->from_email, 0, 1)),
                'color' => $this->avatarColor($email->from_email),
                'time' => $email->received_at?->diffForHumans() ?? 'just now',
                'subject' => $email->subject ?? '(no subject)',
                'body' => $email->html_body ?: ($email->text_body ? '<pre>' . e($email->text_body) . '</pre>' : ''),
                'unread' => !$email->is_read,
                'starred' => $email->is_starred,
            ];
        });

        return response()->json([
            'emails' => $data,
            'total' => $emails->total(),
            'unread' => $address->emails()->where('is_read', false)->count(),
            'page' => $emails->currentPage(),
            'last_page' => $emails->lastPage(),
            'has_more' => $emails->currentPage() < $emails->lastPage(),
            'per_page' => $perPage,
        ]);
    }

    public function show(Request $request, Address $address, Email $email): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id || $email->address_id !== $address->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        if (!$email->is_read) {
            $email->update(['is_read' => true]);
        }

        $headers = $email->headers()->pluck('header_value', 'header_name');

        return response()->json([
            'email' => [
                'id' => $email->id,
                'sender' => $email->from_name ?: explode('@', $email->from_email)[0],
                'from_email' => $email->from_email,
                'from_name' => $email->from_name,
                'to_email' => $email->to_email,
                'subject' => $email->subject ?? '(no subject)',
                'html_body' => $email->html_body,
                'text_body' => $email->text_body,
                'received_at' => $email->received_at?->toISOString(),
                'time' => $email->received_at?->diffForHumans() ?? 'just now',
                'unread' => false,
                'starred' => $email->is_starred,
                'headers' => $headers,
            ],
        ]);
    }

    public function raw(Request $request, Address $address, Email $email): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id || $email->address_id !== $address->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $headers = $email->headers()->pluck('header_value', 'header_name');
        $lines = [];
        foreach ($headers as $name => $value) {
            $lines[] = "{$name}: {$value}";
        }
        $lines[] = '';
        $lines[] = $email->text_body ?? $email->html_body ?? '(no content)';

        return response()->json(['raw' => implode("\n", $lines)]);
    }

    public function markRead(Request $request, Address $address, Email $email): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id || $email->address_id !== $address->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $email->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function markUnread(Request $request, Address $address, Email $email): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id || $email->address_id !== $address->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $email->update(['is_read' => false]);

        return response()->json(['success' => true]);
    }

    public function markAllRead(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $address->emails()->where('is_read', false)->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, Address $address, Email $email): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id || $email->address_id !== $address->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $email->delete();

        return response()->json(['success' => true]);
    }

    public function destroyAll(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();
        if ($address->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $address->emails()->delete();

        return response()->json(['success' => true]);
    }

    private function avatarColor(string $email): string
    {
        $colors = ['#4285F4', '#7C3AED', '#10B981', '#F59E0B', '#EF4444', '#EC4899', '#14B8A6', '#F97316'];
        return $colors[crc32($email) % count($colors)];
    }
}
