<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'admin_note',
        'replied_at',
    ];
 
    // ── Casts ────────────────────────────────────────────────────
    protected $casts = [
        'replied_at' => 'datetime',
    ];
 
    // ── Subject labels (matches the contact form select) ─────────
    public const SUBJECTS = [
        'general'  => 'General Enquiry',
        'support'  => 'Temporary Email Support',
        'privacy'  => 'Privacy / Data Question',
        'api'      => 'Developer API Interest',
        'abuse'    => 'Report Abuse',
        'other'    => 'Other',
    ];
 
    // ── Status values ────────────────────────────────────────────
    public const STATUSES = ['new', 'read', 'replied', 'spam', 'archived'];
 
    // ── Accessors ────────────────────────────────────────────────
 
    /** Human-readable subject label */
    public function getSubjectLabelAttribute(): string
    {
        return self::SUBJECTS[$this->subject] ?? ucfirst($this->subject);
    }
 
    // ── Scopes ───────────────────────────────────────────────────
 
    public function scopeNew(Builder $q): Builder
    {
        return $q->where('status', 'new');
    }
 
    public function scopeUnread(Builder $q): Builder
    {
        return $q->whereIn('status', ['new', 'read']);
    }
 
    public function scopeNotSpam(Builder $q): Builder
    {
        return $q->where('status', '!=', 'spam');
    }
}
