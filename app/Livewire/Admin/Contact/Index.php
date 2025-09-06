<?php

namespace App\Livewire\Admin\Contact;

use App\Jobs\ImportContactsJob;
use App\Livewire\Admin\Layout\BaseComponent;
use App\Models\Contact;
use App\Traits\WithPerPage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Title('Contact Management')]
class Index extends BaseComponent
{
    use WithPagination, WithPerPage, WithFileUploads;

    public ?TemporaryUploadedFile $xmlFile = null;

    protected function rules(): array
    {
        return [
            'xmlFile' => 'required|mimes:xml|max:10240', // 10 MB
        ];
    }

    protected function searchableFields(): array
    {
        return [
            'contacts.name',
            'contacts.phone',
            'contacts.email'
        ];
    }

    protected function sortableMap(): array
    {
        return [
            'name' => 'contacts.name',
            'phone' => 'contacts.phone',
            'email' => 'contacts.email',
            'dob' => 'contacts.dob',
        ];
    }

    public function deleteItem($id)
    {
        Contact::findOrFail($id)->delete();
        $this->dispatch('notify', 'Contact deleted successfully');
    }

    public function uploadXml(): void
    {
        $this->validate();

        $path = $this->xmlFile->store('imports');
        ImportContactsJob::dispatch($path);

        $this->resetXmlImport();

        $this->dispatch('close-import');
        $this->dispatch('notify', 'XML import started. You will be notified once completed.');
    }

    public function resetXmlImport()
    {
        $this->reset(['xmlFile']);
        $this->resetErrorBag(['xmlFile']);
    }

    public function updated(string $propertyName): void
    {
        if ($propertyName === 'xmlFile') {
            try {
                $this->validateOnly($propertyName);
            } catch (ValidationException $e) {
                $this->reset([$propertyName]);

                $rawMessage = $e->validator->errors()->first($propertyName);

                $this->addError($propertyName, $rawMessage);
            }
        }
    }

    public function render()
    {
        $contacts = Contact::query();
        $contacts = $this->applySearch($contacts);
        $contacts = $this->applySorting($contacts);
        $contacts = $contacts->paginate($this->perPage);

        return view('livewire.admin.contact.index', compact('contacts'));
    }
}
