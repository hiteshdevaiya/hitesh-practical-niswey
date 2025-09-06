<?php

namespace App\Jobs;

use App\Services\ContactService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportContactsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(ContactService $contactService)
    {
        $xmlContent = Storage::get($this->filePath);
        $xml = simplexml_load_string($xmlContent, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        foreach ($xml->contact as $contactData) {
            $data = [
                'name'    => (string) $contactData->name,
                'phone'   => (string) $contactData->phone
            ];

            $contactService->save($data);
        }

        // Delete file after processing
        Storage::delete($this->filePath);
    }
}

