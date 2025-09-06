<?php

namespace App\Services;

use App\Models\Contact;
use Carbon\Carbon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContactService
{
    public function save(array $data, ?TemporaryUploadedFile $image = null, string $uniqueField = 'phone'): Contact
    {
        $data = $this->normalizeData($data);

        // Check if contact exists based on unique field
        $contact = Contact::where($uniqueField, $data[$uniqueField] ?? null)->first();

        if ($contact) {
            $contact->update($data);
        } else {
            $contact = Contact::create($data);
        }

        if ($image) {
            $this->handleImageUpload($contact, $image);
        }

        return $contact;
    }

    /**
     * Normalize incoming data (date format, etc.).
     */
    protected function normalizeData(array $data): array
    {
        if (!empty($data['date'])) {
            $data['dob'] = Carbon::createFromFormat(config('constant.date_format_js'), $data['date']);
            unset($data['date']);
        }

         if (!empty($data['phone'])) {
            // Remove all spaces
            $data['phone'] = str_replace(' ', '', $data['phone']);
            // Remove leading '+'
            $data['phone'] = ltrim($data['phone'], '+');
        }

        return $data;
    }

    /**
     * Handle media upload.
     */
    protected function handleImageUpload(Contact $contact, TemporaryUploadedFile $image): void
    {
        $contact->clearMediaCollection('contact/image')
            ->addMedia($image->getRealPath())
            ->usingFileName($image->getClientOriginalName())
            ->toMediaCollection('contact/image');
    }
}
