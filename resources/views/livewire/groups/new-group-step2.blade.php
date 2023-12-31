<div>
    {{-- <div class="flex gap-4 my-6">
        <button type="submit"
            class="button flex gap-2 items-center justify-center bg-green-500 text-white">
            <i class="mdi mdi-open-in-new mdi-24px"></i> Create Group
        </button>
        <button type="submit"
            class="button flex gap-2 items-center justify-center bg-green-500 text-white">
            <i class="mdi mdi-plus mdi-24px"></i> Add All The Contacts
        </button>
    </div> --}}
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
                    <p class="ml-2 flex items-center p-2">
                        <span class="text-green-500">Total: <span>{{ $totalContacts }}</span>
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
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr wire:key="{{ $contact->id }}">
                                <td class="checkbox-cell">
                                    <label class="checkbox"  wire:click="toggleSelectedContacts">
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
                                <td data-label="Created">{{$contact->created_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Table pagination -->
                {{ $contacts->links('livewire.custom-pagination') }}
                <div class="my-6 text-end">
                    <button type="button" wire:click="previousStep" class="button">Back</button>
                    <button wire:click="createGroup"
                        class="button flex items-center gap-2 justify-center bg-green-500 text-white mr-2">
                        <i class="mdi mdi-open-in-new mdi-24px"></i> Create Group
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
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
