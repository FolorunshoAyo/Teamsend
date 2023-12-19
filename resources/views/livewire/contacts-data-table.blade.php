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
                <div class="tools inline-flex items-center space-x-2">
                    @if (count($selectedContacts) > 0)
                        <p class="ml-2 flex items-center p-2">
                            <span class="text-green-500">Selected: <span>{{ count($selectedContacts) }}</span>
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
                    <span class="text-green-500">Total: <span id="email-count">{{ count($contacts) }}</span>
                        contact(s)</span>
                </p>
            </header>
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th class="checkbox-cell">
                        {{-- wire:click="toggleSelectAll     --}}
                                <div id="select-all"
                                    class="data-table-custom-checkbox {{ $selectAll === false ? '' : 'active' }}">
                                    @if ($selectAll)
                                        <span class="check-icon mdi mdi-check-bold text-white"></span>
                                    @endif
                                </div>
                                {{-- <label class="checkbox">
                    <input type="checkbox" {{$selectAll === false? "" : "checked"}}>
                    <span class="check" wire:click="toggleSelectAll"></span>
                    </label> --}}
                            </th>
                            <th class="image-cell"></th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $user = Auth::user();
                        @endphp
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="checkbox-cell">
                                    {{-- wire:click="toggleSelectContact({{ $contact->id }})" --}}
                                    <div data-contact-id="{{ $contact->id }}"
                                        class="data-table-custom-checkbox {{ in_array($contact->id, $selectedContacts) ? 'active' : '' }}">
                                        @if (in_array($contact->id, $selectedContacts))
                                            <span class="check-icon mdi mdi-check-bold text-white"></span>
                                        @endif
                                    </div>
                                    {{-- <label class="checkbox">
                        <input type="checkbox" {{ in_array($contact->id, $selectedContacts)? "checked" : "" }}>
                        <span class="check" wire:click="toggleSelectContact({{ $contact->id }})"></span>
                        </label> --}}
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
                    </tbody>
                </table>
                <!-- Table pagination -->
                {{ $contacts->links('livewire.custom-pagination') }}
            </div>
        </div>
    @endif
    <!-- Edit Modal -->
    @if ($modalVisible)
        @livewire('contact-edit-modal', ['contact' => $selectedContact, 'orgId' => $org_id])
    @endif

    <!-- Create Modal -->
    @if ($createModalVisible)
        @livewire('contact-create-modal', ['orgId' => $org_id])
    @endif
</section>
@script
    <script>
        $wire.dispatch('getSelectedAndAllContacts');

        $wire.on('tableSuccess', (event) => {
            toastr.success(event.message, "Success");
        });
        $wire.on('tableRefreshed', () => {
            toastr.success("Table refreshed successfully", "Success");
        });

        $wire.on('tableError', (event) => {
            toastr.error(event.details.message, "Error");
        });
    </script>
@endscript

@section('page-script')
<script>
    // Storing selected and all organisation contacts
    let selectedContacts = [];
    let allContacts = [];
    let selectAll = false;
    let loadingBackgroundData = true;

    // Select All checkbox
    const selectAllCheckbox = document.querySelector("#select-all");

    // Checkbox functionality
    document.querySelectorAll(".data-table-custom-checkbox").forEach(checkbox => {
        checkbox.addEventListener("click", handleClick);
    });

    function handleClick (e) {
        if(loadingBackgroundData !== true){
            const checkbox = e.currentTarget;

            if(checkbox.id === "select-all"){
                if(checkbox.classList.contains('active')){
                    selectedContacts = [];

                    // Removed all checked records
                    document.querySelectorAll(".data-table-custom-checkbox").forEach(selectedContact => {
                        selectedContact.classList.remove("active");
                        selectedContact.innerHTML = "";
                    });

                }else{
                    selectedContacts = [...allContacts];

                    updateDataTableState();
                }   
            }else{
                const contact_id = Number(checkbox.dataset.contactId);

                if(checkbox.classList.contains('active')){
                    // is activated
                    let index = selectedContacts.indexOf(contact_id);

                    if (index !== -1) {
                        selectedContacts.splice(index, 1);

                        console.log(`Removed ${contact_id} from the selected list.`);

                        checkbox.classList.remove('active');
                        checkbox.innerHTML = "";
                    }else{
                        console.log(`${contact_id} not found in the selected list.`);
                    }
                }else{
                    selectedContacts.push(contact_id);

                    checkbox.classList.add("active");

                    checkbox.innerHTML = "<span class='mdi mdi-check-bold text-white'></span>";
                }

                updateDataTableState();
            }
        }else{
            return;
        }
    }

    function updateDataTableState(){
        if(arraysEqualSorted(selectedContacts, allContacts)){
            selectAll = true;
            selectAllCheckbox.classList.add("active");
            selectAllCheckbox.innerHTML = "<span class='mdi mdi-check-bold text-white'></span>";
        }else{
            selectAll = false;
            selectAllCheckbox.classList.remove("active");
            selectAllCheckbox.innerHTML = "";
        }

        if(selectAll === true){
            selectedContacts = [...allContacts];
        }

        updateDataTable();
    }

    function updateDataTable(){
        selectedContacts.forEach(selectedContact => {
            const selectedContactEl = document.querySelector(`.data-table-custom-checkbox[data-contact-id="${selectedContact}"]`);

            // Update checkbox state from the dom
            if(!selectedContactEl.classList.contains("active")){
                selectedContactEl.classList.add("active");
                selectedContactEl.innerHTML = "<span class='mdi mdi-check-bold text-white'></span>";
            }
            
        });
    }

    function arraysEqualSorted(a, b) {
        const sortedA = [...a].sort();
        const sortedB = [...b].sort();

        return JSON.stringify(sortedA) === JSON.stringify(sortedB);
    }

    // Code for working with the checkboxes
    document.addEventListener('livewire:init', function () {
        Livewire.on('sendSelectedAndAllContacts', function (data) {
            loadingBackgroundData = false;
            allContacts = data[0].allContacts;
            selectedContacts = data[0].selectedContacts;
        });

        Livewire.on('actionDoneOnDataTable', function(){
            // Send collated selectedCOntacts
            $wire.dispatch('updateCollatedContacts', { selectedContacts, selectAll });
        });
    });
</script>
@endsection
