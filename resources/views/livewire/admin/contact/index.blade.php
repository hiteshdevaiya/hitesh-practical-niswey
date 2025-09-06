<div class="pt-4 pb-6 px-6 max-[767px]:px-4 h-[calc(100%-100.8px)] outer-tabs flex-1 overflow-y-auto">

    <x-breadcrumb :links="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Contact Management', 'url' => null],
    ]" />

    <div class="border border-[#E7E7E7] bg-white rounded-xl">
        <div class="flex lg:items-center justify-between py-4 px-6 w-full max-[1024px]:flex-col">
            <x-table.title name="Contact Management" />
            <div class="flex items-center md:gap-x-6 max-[767px]:flex-col max-[767px]:gap-y-6">
                <x-button @click="$dispatch('open-import')" type="button" class="bg-[#FFCD05] border border-[#FFCD05] font-medium text-base py-2.5 px-4 rounded-xl cursor-pointer whitespace-nowrap w-full md:w-[120px] 2xl:py-3.5 text-center">
                    Import
                </x-button>
                <form class="flex items-center relative w-full md:w-[250px]">
                    <x-search-input name="search" model="search" />
                    <x-button type="button" class="absolute right-[16px] top-1/2 -translate-y-1/2 transform !cursor-default">
                        <x-img name="search-icon.svg" width="20" height="20" />
                    </x-button>
                </form>
                <x-link href="{{ route('admin.contact.create') }}" class="bg-[#FFCD05] border border-[#FFCD05] font-medium text-base py-2.5 px-4 rounded-xl cursor-pointer whitespace-nowrap w-full md:w-[240px] 2xl:py-3.5 text-center">
                    Add Contact
                </x-link>
            </div>
        </div>
        <div class="overflow-auto max-h-[calc(10*55px)]">
            <table class="text-sm text-left w-full whitespace-nowrap">
                <thead class="bg-[#F3F3F3] text-[#282828]">
                    <x-table.row>
                        <x-table.th class="w-[96px]" sortable="false">Sr. No.</x-table.th>
                        <x-table.th class="w-[100px]" sortable="false">Image</x-table.th>
                        <x-table.th class="w-[150px]" field="name" :sort-col="$sortCol" :sort-asc="$sortAsc">Name</x-table.th>
                        <x-table.th class="w-[150px]" field="phone" :sort-col="$sortCol" :sort-asc="$sortAsc">Phone</x-table.th>
                        <x-table.th class="w-[150px]" field="email" :sort-col="$sortCol" :sort-asc="$sortAsc">Email</x-table.th>
                        <x-table.th class="w-[250px]" field="dob" :sort-col="$sortCol" :sort-asc="$sortAsc">DOB</x-table.th>
                        <x-table.th class="w-[89px]" sortable="false">Action</x-table.th>
                    </x-table.row>
                </thead>
                <tbody>
                    @forelse ($contacts as $key => $contact)
                        <x-table.row>
                            <x-table.td>{{ $contact->id }}</x-table.td>
                            <td class="px-6 py-2 group-first/table:border-t-0 border-t border-[#E7E7E7]">
                                <div class="w-[50px] h-[50px]">
                                    <img src="{{ $contact->image }}" width="50" height="50"
                                        class="w-full h-full object-contain bg-[#f0f0f0] rounded-sm" />
                                </div>
                            </td>
                            <x-table.td>{{ $contact->name }}</x-table.td>
                            <x-table.td>{{ $contact->phone }}</x-table.td>
                            <x-table.td>{{ $contact->email }}</x-table.td>
                            <x-table.td>{{ $contact?->dob?->format(config('constant.date_format')) }}</x-table.td>
                            <td class="px-6 py-[13px] group-first:border-t-0 border-t border-[#E7E7E7]">
                                <x-table.action-button :row-id="$contact->id"
                                    :on-edit="route('admin.contact.edit', $contact->id)"
                                    :on-delete="'window.dispatchEvent(new CustomEvent(\'show-delete\', { detail: { id: ' . $contact->id . ', module: \'contact\' } }))'"
                                />
                            </td>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.td colspan="6" class="text-center py-4">No contacts found</x-table.td>
                        </x-table.row>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-pagination-footer :paginator="$contacts" />
    </div>
    <x-delete />
    <x-custom-modal />

    <div
        x-data="{ importShow: false }"
        x-show="importShow"
        x-cloak
        @open-import.window="importShow = true"
        @close-import.window="importShow = false;"
        class="fixed inset-0 z-50 px-3 md:px-0 overflow-y-auto bg-[rgba(17,24,39,0.5)]">
        <div class="flex items-center justify-center min-h-full py-10 relative z-50">
            <div class="bg-[#FFFDF3] rounded-lg p-4 max-w-[300px] 2xl:max-w-[417px] mx-auto w-full text-center">
                <p class="text-lg font-bold mb-4 py-2 border-b border-[#E7E7E7]">Import Xml</p>
                <form wire:submit.prevent="uploadXml" enctype="multipart/form-data">
                    <div class="form-item text-left mb-4">
                        <input type="file" wire:model="xmlFile" accept=".xml" class="w-full border rounded p-2">
                        <x-error field="xmlFile" />
                    </div>
                    <div class="grid grid-cols-2 md:gap-x-4 max-[767px]:gap-x-2">
                        <x-button type="button" @click="$dispatch('close-import'); $wire.resetXmlImport()"  wire:loading.attr="disabled"
                            class="bg-white border border-[#CFCFCF] font-medium text-sm lg:text-base py-2 px-4 lg:py-3.5 lg:px-6 rounded-xl cursor-pointer whitespace-nowrap">Cancel
                        </x-button>
                        <x-button wire:loading.attr="disabled"
                            wire:target="xmlFile,uploadXml"
                            class="bg-[#FFCD05] border border-[#FFCD05] font-medium text-sm lg:text-base py-2 px-4 lg:py-3.5 lg:px-6 rounded-xl whitespace-nowrap">
                            <span wire:loading.remove wire:target="uploadXml">Save</span>
                            <span wire:loading wire:target="uploadXml">Processing...</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
