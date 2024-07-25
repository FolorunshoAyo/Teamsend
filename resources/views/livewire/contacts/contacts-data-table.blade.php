<section class="section main-section">
    <div class="field">
        <div class="control icons-left">
            <input class="input" wire:model.live.debounce.300ms="search" placeholder="Search contacts ....">
            <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
        </div>
    </div>
    <div class="my-6 flex flex-col items-center md:flex-row gap-4">
        <div class="w-1/2 md:w-1/4">
            <button class="button w-full md:w-fit" wire:click="createContact">
                <i class="mdi mdi-plus"></i>
                Add New Contact
            </button>
        </div>
        <div class="flex flex-wrap gap-4">
            <button wire:click="clearFilter" class="filter-button {{ $activeFilter === null ? 'active' : '' }}">
                <i class="mdi mdi-email-outline mdi-24px"></i>
                <span>All Contacts</span>
            </button>
            <button wire:click="applyFilter('favourite')"
                class="filter-button {{ $activeFilter === 'favourite' ? 'active' : '' }}">
                <i class="mdi mdi-star-outline mdi-24px"></i>
                <span>Favourites</span>
            </button>
            <button wire:click="applyFilter('blocked')"
                class="filter-button {{ $activeFilter === 'blocked' ? 'active' : '' }}">
                <i class="mdi mdi-close-octagon-outline mdi-24px"></i>
                <span>Blocked</span>
            </button>
            <button wire:click="applyFilter('trashed')"
                class="filter-button {{ $activeFilter === 'trashed' ? 'active' : '' }}">
                <i class="mdi mdi-trash-can-outline mdi-24px"></i>
                <span>Trashed</span>
            </button>
        </div>
    </div>
    @if ($contacts->isEmpty())
        <div class="card empty">
            <div class="card-content">
                <div>
                    <span class="icon large text-green-500"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                </div>
                <p>Nothing's here…</p>
            </div>
            <hr />
            <div class="text-end p-4">
                <button class="button w-1/4 md:w-1/2" wire:click="createContact">Add New Contact</button>
            </div>
        </div>
    @else
        <div class="card has-table">
            <header class="card-header tool-table">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                    All Contacts
                </p>
                <div class="tools inline-flex relative items-center space-x-2">
                    {{-- <div id="loading-overlay" class="absolute top-0 right-0 w-full h-full bg-black opacity-5 z-50" style="display: none;"></div> --}}
                    {{-- <p id="contacts-count" class="ml-2 flex items-center p-2" style="display: {{count($selected) > 0? 'block' : 'none'}}">
                        <span class="text-green-500">Selected: <span>{{ count($selected) }}</span>
                                contact(s)</span>
                    </p> --}}
                    @if (count($selected) > 0)
                    <p class="ml-2 flex items-center p-2">
                        <span class="text-green-500">Selected: <span>{{ count($selected) }}</span>
                                contact(s)</span>
                    </p>
                    @endif
                    <span class="font-semibold">Show:</span>
                    <div class="control">
                        <div class="select">
                            <select wire:model.change="perPage" id="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <button class="card-header-icon" wire:click="refreshTable" title="reload">
                        <span class="icon"><i class="mdi mdi-reload mdi-24px"></i></span>
                    </button>
                    <button class="card-header-icon"
                        wire:click="{{ $activeFilter === 'favourite' ? "removeSelectedFrom('favourite')" : "addSelectedTo('favourite')" }}"
                        title="{{ $activeFilter === 'favourite' ? 'Remove from favourites' : 'Add to favourites' }}">
                        <span class="icon"><i
                                class="mdi {{ $activeFilter === 'favourite' ? 'mdi-star-remove-outline' : 'mdi-star-plus-outline' }} mdi-24px"></i></span>
                    </button>
                    <button class="card-header-icon"
                        wire:click="{{ $activeFilter === 'blocked' ? "removeSelectedFrom('blocked')" : "addSelectedTo('blocked')" }}"
                        title="{{ $activeFilter === 'blocked' ? 'Remove emails(s) from blacklist' : 'Blacklist email(s)' }}">
                        <span class="icon"><i
                                class="mdi {{ $activeFilter === 'blocked' ? 'mdi-check-circle-outline' : 'mdi-cancel' }} mdi-24px"></i></span>
                    </button>
                    <button class="card-header-icon"
                        wire:click="{{ $activeFilter === 'trashed' ? "removeSelectedFrom('trashed')" : "addSelectedTo('trashed')" }}"
                        title="{{ $activeFilter === 'trashed' ? 'Remove selected email(s) from trash' : 'Trash selected email(s)' }}">
                        <span class="icon"><i
                                class="mdi {{ $activeFilter === 'trashed' ? 'mdi-delete-empty' : 'mdi-delete' }} mdi-24px"></i></span>
                    </button>
                    {{-- <button class="card-header-icon" title="send test mail">
                    <span class="icon"><i class="mdi mdi-send mdi-24px"></i></span>
                </button> --}}
                    <button class="card-header-icon" title="Export CSV">
                        <span class="icon"><i class="mdi mdi-file-document-outline mdi-24px"></i></span>
                    </button>
                </div>
                <p class="ml-2 flex items-center p-2">
                    <span class="text-green-500">Total: 
                        <span>{{ $totalContacts }}</span> contact(s)
                    </span>
                </p>
            </header>
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th class="checkbox-cell">
                                <label class="checkbox" wire:click="toggleSelectAll">
                                    <input type="checkbox" wire:model="selectAll">
                                    <span class="check"></span>
                                </label>
                            </th>
                            {{-- <th class="checkbox-cell">
                                <label class="checkbox">
                                    <input type="checkbox" wire:model="selectPage">
                                    <span class="check"></span>
                                </label>
                            </th> --}}
                            <th class="image-cell"></th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($isLoading)
                            @foreach (range(1, 7) as $index)
                                <tr>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                    <td class="border px-4 py-2">
                                    <div class="h-4 bg-gray-200 animate-pulse rounded"></div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @php
                                $user = Auth::user();
                            @endphp
                            @foreach ($contacts as $contact)
                                <tr wire:key="{{ $contact->id }}">
                                    <td class="checkbox-cell">   
                                        <label class="checkbox" wire:click="toggleSelected">
                                            <input type="checkbox" wire:model="selected" value="{{ $contact->id }}">
                                            <span class="check"></span>
                                        </label>
                                    </td>
                                    <td class="image-cell">
                                        <div class="image">
                                            <img src="{{ asset('images/avatar.svg') }}" class="rounded-full" />
                                        </div>
                                    </td>
                                    <td data-label="User">{{ $contact->last_name . ' ' . $contact->first_name }}</td>
                                    <td data-label="Email">{{ $contact->email }}</td>
                                    <td data-label="Phone Number">{{ $contact->country_code . ' ' . $contact->phone }}</td>
                                    <td data-label="Created By">
                                        {{ $contact->userOrganisation->user->id !== $user->id ? $contact->userOrganisation->user->first_name . ' ' . $contact->userOrganisation->user->last_name : 'Me' }}
                                    </td>
                                    <td class="actions-cell">
                                        <div class="buttons right nowrap">
                                            <button class="favourite-btn {{ $contact->is_favourite ? 'is-favourite' : '' }}"
                                                wire:click="setToFavourite('{{ $contact->id }}')">
                                                <span class="icon"><i class="mdi mdi-star-outline mdi-24px"></i></span>
                                            </button>
                                            <button class="button small light"
                                                wire:click="openContactEditModal('{{ $contact->id }}')">
                                                <span class="icon"><i
                                                        class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <!-- Table pagination -->
                {{ $contacts->links('livewire.custom-pagination') }}
            </div>
        </div>
    @endif
    <!-- Edit Modal -->
    @if ($modalVisible)
        @livewire('contacts.contact-edit-modal', ['contact' => $selectedContact, 'orgId' => $org_id])
    @endif

    <!-- Create Modal -->
    @if ($createModalVisible)
        @livewire('contacts.contact-create-modal', ['orgId' => $org_id])
    @endif
</section>
@script
    <script>
        $wire.on('tableSuccess', (event) => {
            console.log(event);
            toastr.success(event.message, "Success");
        });
        $wire.on('tableRefreshed', () => {
            toastr.success("Table refreshed successfully", "Success");
        });

        $wire.on('tableError', (event) => {
            toastr.error(event.message, "Error");
        });
    </script>
@endscript
