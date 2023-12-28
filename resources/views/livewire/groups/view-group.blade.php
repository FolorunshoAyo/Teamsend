<section class="section main-section">
    <div class="bg-white rounded-sm p-4 shadow-sm">
        <div class="flex my-4 items-center justify-between my-4">
            <div>
                <h3 class="text-2xl font-bold text-green-600 mb-2">{{ $groupName }}</h3>
                @if ($groupDesc)
                    <p class="text-sm">{{$groupDesc}}</p>
                @endif
            </div>
            <div class="flex flex-col gap-2">
                <div class="text-right">
                    @if ($isActive === 1)
                    <span class="inline-block w-1/2 text-center font-bold text-lg text-white bg-green-600 p-2 rounded-sm text-sm shadow">Active</span>
                    @else
                    <span class="inline-block w-1/2 text-center font-bold text-lg text-white bg-red-600 p-2 rounded-sm text-sm shadow">Inactive</span>
                    @endif
                </div>
                <p class="font-semibold">Date Created: <span class="text-green-600">{{ $createdAt }}</span></p>
            </div>
        </div>
        <div class="my-4">
            <div class="field">
              <div class="control icons-left">
                <input class="input" type="text"  wire:model.live.debounce.300ms="search" placeholder="Search contacts ....">
                <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
              </div>
            </div>
        </div>
        @if ($groupContacts->isEmpty())
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
                        Contacts
                    </p>
                    <div class="tools inline-flex relative items-center space-x-2">
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
                        <button wire:click="addSelectedToFavourites" class="card-header-icon" title="Add to Favourites">
                        <span class="icon"><i class="mdi mdi-star-outline mdi-24px"></i></span>
                        </button>
                        <button wire:click="removeSelectedFromGroup" class="card-header-icon" title="Remove selected email from group">
                        <span class="icon"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span>
                        </button>
                        <button class="card-header-icon" title="send test mail">
                        <span class="icon"><i class="mdi mdi-send mdi-24px"></i></span>
                        </button>
                        <button class="card-header-icon" title="Export CSV">
                        <span class="icon"><i class="mdi mdi-file-document-outline mdi-24px"></i></span>
                        </button>
                    </div>
                    <p class="ml-2 flex items-center p-2">
                        <span class="text-green-500">Total: <span>{{ count($groupContacts) }}</span>
                            contact(s)</span>
                    </p>
                    </div>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th class="checkbox-cell">
                                    <label class="checkbox" wire:click="toggleSelectAll">
                                        <input type="checkbox" wire:model="selectAll"/> 
                                        <span class="check"></span>
                                    </label>
                                </th>
                                <th class="image-cell"></th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupContacts as $contact)
                                <tr>
                                    <td class="checkbox-cell">
                                        <label class="checkbox"  wire:click="updateSelectedContacts">
                                            <input type="checkbox" wire:model="selectedContacts" value="{{ $contact->id }}"/>
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
                                    <td data-label="Created">{{ $contact->pivot->created_at->diffForHumans() }}</td>
                                    <td class="actions-cell">
                                        <div class="buttons right nowrap">
                                            <button class="favourite-btn {{ $contact->is_favourite ? 'is-favourite' : '' }}"
                                                wire:click="setToFavourite('{{ $contact->id }}')">
                                                <span class="icon"><i class="mdi mdi-star-outline mdi-24px"></i></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Table pagination -->
                    {{ $groupContacts->links('livewire.custom-pagination') }}
                </div>
            </div>
        @endif
    </div>
</section>
@script
  <script>
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
