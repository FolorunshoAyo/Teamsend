<section class="section main-section">
    <div class="p-6 bg-white shadow-sm rounded-sm">
        <div class="my-6 flex flex-col items-center sm:justify-between sm:flex-row gap-4">
            <a class="button" href="{{ route('org-admin.new-group', ['organisation' => "$org_name"]) }}">
                <i class="mdi mdi-plus"></i>
                Add New Group
            </a>
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model.live.debounce.300ms="search" placeholder="Search Groups....">
                    <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
                </div>
            </div>
        </div>
        @if ($groups->isEmpty())
            <div class="card empty">
                <div class="card-content">
                    <div>
                        <span class="icon large text-green-500"
                        ><i class="mdi mdi-emoticon-sad mdi-48px"></i
                        ></span>
                    </div>
                    <p>Nothing's here…</p>
                </div>
                <hr />
                <div class="text-end p-4">
                    <a class="button w-1/4 md:w-1/2"  href="{{ route('org-admin.new-group', ['organisation' => "$org_name"]) }}">
                        <i class="mdi mdi-plus"></i>
                        Add New Group
                    </a>
                </div>
            </div>
        @else
            <div class="card has-table mb-6">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        All Groups
                    </p>
                    <div class="tools inline-flex items-center space-x-2">
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
                        <div>
                            <button class="card-header-icon" wire:click="refreshTable" title="reload">
                                <span class="icon"><i class="mdi mdi-reload"></i></span>
                            </button>
                        </div>
                    </div>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Group Name</th>
                                <th>Contacts Count</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $user = Auth::user();
                            @endphp
                            @foreach ($groups as $group)
                            <tr wire:key="{{ $group->id }}">
                                <td class="image-cell">
                                    <div class="image">
                                        <img src="{{ asset('images/avatar.svg') }}" class="rounded-full" />
                                    </div>
                                </td>
                                <td data-label="Group Name">
                                    <a class="font-medium whitespace-no-wrap inline-block" href="javascript:void(0)">
                                        {{ $group->list_name }}
                                    </a>
                                    @if ($group->list_description)
                                        <p>{{ $group->list_description }}</p>
                                    @endif
                                </td>
                                <td data-label="Contacts Count">{{ count($group->contacts) }}</td>
                                <td data-label="Status">
                                    <div class="flex items-center text-green-600">
                                        @if($group->active)
                                        <i class="mdi mdi-checkbox-multiple-outline"></i> Active
                                        @else
                                        <i class="mdi mdi-close-box-multiple-outline"></i> Inactive
                                        @endif
                                    </div>
                                </td>
                                <td data-label="Created By">
                                    {{ $group->userOrganisation->user->id !== $user->id ? $group->userOrganisation->user->first_name . ' ' . $group->userOrganisation->user->last_name : 'Me' }}
                                </td>
                                <td data-label="Created At">
                                    {{$group->created_at->diffForHumans()}}
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button green" href="{{ route('org-admin.view-group', ['organisation' => "$org_name", 'id' => "$group->id"]) }}">
                                            <span class="icon"><i class="mdi mdi-eye mdi-24px"></i></span>
                                        </a>
                                        <a class="button yellow" href="{{ route('org-admin.edit-group', ['organisation' => "$org_name", 'id' => "$group->id"]) }}">
                                            <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                                        </a>
                                        <button class="button red" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Table pagination -->
                    {{ $groups->links('livewire.custom-pagination') }}
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
