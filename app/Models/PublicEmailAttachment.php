<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PublicEmailAttachment extends Model
{
    protected $fillable = ['email_id', 'file_name', 'file_path', 'file_size', 'mime_type'];

    // ── Relationships ────────────────────────────────────────────────
    public function email(): BelongsTo
    {
        return $this->belongsTo(PublicEmail::class, 'email_id');
    }

    // ── Helpers ──────────────────────────────────────────────────────

    /** Returns the file extension (uppercase, e.g. PDF). */
    public function extension(): string
    {
        return strtoupper(pathinfo($this->file_name, PATHINFO_EXTENSION)) ?: 'BIN';
    }

    /** Human-readable file size (KB / MB). */
    public function humanSize(): string
    {
        if ($this->file_size >= 1_048_576) {
            return round($this->file_size / 1_048_576, 1) . ' MB';
        }
        return round($this->file_size / 1024, 1) . ' KB';
    }

    /** Signed temporary download URL (10 min). */
    public function downloadUrl(): string
    {
        return route('attachment.download', ['attachment' => $this->id]);
    }

    /** Icon colours per extension — matches blade view design. */
    public function iconStyle(): array
    {
        return match ($this->extension()) {
            'PDF'        => ['color' => '#dc2626', 'bg' => '#fee2e2'],
            'ZIP', 'RAR' => ['color' => '#7c3aed', 'bg' => '#ede9fe'],
            'CSV'        => ['color' => '#16a34a', 'bg' => '#dcfce7'],
            'PNG', 'JPG',
            'JPEG','GIF' => ['color' => '#2563EB', 'bg' => '#dbeafe'],
            'FIG'        => ['color' => '#F24E1E', 'bg' => '#FEE2E2'],
            default      => ['color' => '#6B7280', 'bg' => '#F3F4F6'],
        };
    }
}