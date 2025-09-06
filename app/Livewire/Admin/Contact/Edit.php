<?php

namespace App\Livewire\Admin\Contact;

use App\Livewire\Admin\Layout\BaseComponent;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Venue;
use App\Rules\MaxImageSize;
use App\Rules\ValidImageExtension;
use App\Services\ContactService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Title('Edit Contact')]
class Edit extends BaseComponent
{
    use WithFileUploads;

    public Contact $contact;

    public $name;
    public $phone;
    public $address;
    public $email;
    public $date;
    public $image;
    public $image_preview;
    public $image_id;

    protected function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'phone'   => [
                'required',
                'digits_between:7,15',
                function ($attribute, $value, $fail) {
                    $exists = Contact::where('phone', $value);

                    if ($this->contact) {
                        $exists->where('id', '!=', $this->contact->id);
                    }

                    if ($exists->exists()) {
                        $fail('This phone number already exists.');
                    }
                },
            ],
            'address'     => 'required|string|max:255',
            'date'        => 'required|date_format:d/m/Y',
            'email'       => 'required|email|max:255',
            'image'       => ['nullable', 'image', new MaxImageSize(), new ValidImageExtension()],
        ];
    }

    protected function messages()
    {
        $maxSize = config('media-library.max_file_size_in_mb');
        return [
            'name.required'        => 'Name is required.',
            'phone.required'       => 'Phone is required.',
            'phone.digits_between' => 'Phone must be between 7 and 15 digits.',
            'address.required'     => 'Address is required.',
            'date.required'        => 'Birth date is required.',
            'date.date_format'     => 'Birth date must be in the format DD/MM/YYYY.',
            'email.required'       => 'Email is required.',
            'email.email'    => 'Please enter a valid email address.',
            'image.required'       => 'Please upload image.',
            'image.image'          => 'The image must be a valid image.',
            'image.max'            => "The image may not be greater than {$maxSize}MB.",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'image' => 'image',
        ];
    }

    public function mount()
    {
        $this->name = $this->contact->name;
        $this->phone = $this->contact->phone;
        $this->email = $this->contact->email;
        $this->date = $this->contact?->dob?->format(config('constant.date_format_js'));
        $this->address = $this->contact->address;
        $this->image_preview = $this->contact->getFirstMediaUrl('contact/image');
        $this->image_id = $this->contact->getFirstMedia('contact/image')?->id;
    }

    public function removeImage(): void
    {
        $this->image_preview = null;
        $this->image = null;
        $this->image_id = null;
    }

    protected function setPreviewUrl(string $property, string $url): void
    {
        $previewProperty = $property . '_preview';
        $this->$previewProperty = $url;
    }

    protected function resetPreviewUrl(string $property): void
    {
        $previewProperty = $property . '_preview';
        $this->$previewProperty = null;
    }

    public function updated(string $propertyName): void
    {
        if ($propertyName === 'image') {
            try {
                $this->validateOnly($propertyName);

                $file = $this->$propertyName;

                if ($file instanceof TemporaryUploadedFile) {
                    $this->setPreviewUrl($propertyName, $file->temporaryUrl());
                }
            } catch (ValidationException $e) {
                $this->reset([$propertyName]);
                $this->resetPreviewUrl($propertyName);

                $rawMessage = $e->validator->errors()->first($propertyName);
                $prettyMessage = str_replace($propertyName, 'Image', $rawMessage);

                $this->addError($propertyName, $prettyMessage);
            }
        }
    }

    public function save(ContactService $contactService)
    {
        $validated = $this->validate();

        $contactService->save( $validated, $this->image);

        session()->flash('success', 'Contact updated successfully.');
        $this->redirectRoute('admin.contact.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.contact.edit');
    }
}
