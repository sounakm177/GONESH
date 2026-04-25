<?php

namespace App\Http\Requests;

use App\Models\ContactMessage;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
 
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:120'],
            'email'   => ['required', 'email:rfc,dns', 'max:255'],
            'subject' => ['required', 'string', 'in:' . implode(',', array_keys(ContactMessage::SUBJECTS))],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }
 
    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'name.min'         => 'Name must be at least 2 characters.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'subject.in'       => 'Please select a valid subject.',
            'message.required' => 'Please enter a message.',
            'message.min'      => 'Message must be at least 10 characters.',
            'message.max'      => 'Message must not exceed 5000 characters.',
        ];
    }
 
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'    => strip_tags($this->name ?? ''),
            'message' => strip_tags($this->message ?? ''),
        ]);
    }
}
