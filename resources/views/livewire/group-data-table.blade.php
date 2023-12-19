<section class="section main-section">
    <div class="p-6 bg-white shadow-sm rounded-sm">
        <div class="my-6 flex flex-col items-center sm:justify-between sm:flex-row gap-4">
            <a class="button" href="{{ route('org-admin.new-group', ['organisation' => "$reformatted_org_name"]) }}">
                <i class="mdi mdi-plus"></i>
                Add New Group
            </a>
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" placeholder="Search Groups....">
                    <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
                </div>
            </div>
        </div>
        @if ($contacts->isEmpty())
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
                    <button class="button w-1/4 md:w-1/2"  wire:click="createContact">Add New Contact</button>
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
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
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
                                <th>Contacts</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="image-cell">
                                    <div class="image">
                                        <img src="img/avatar.svg" class="rounded-full" />
                                    </div>
                                </td>
                                <td data-label="Group Name">
                                    <a class="font-medium whitespace-no-wrap inline-block" href="javascript:void(0)">
                                        Group Name
                                    </a>
                                    <p>Some Desc</p>
                                </td>
                                <td data-label="Contacts">20</td>
                                <td data-label="Status">
                                    <div class="flex items-center text-red-600">
                                        <i class="mdi mdi-close-box-multiple-outline"></i> Inactive
                                    </div>
                                </td>
                                <td data-label="Created">3 days ago</td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button green" href="javascript:void(0)">
                                            <span class="icon"><i class="mdi mdi-eye mdi-24px"></i></span>
                                        </a>
                                        <a class="button yellow" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                                        </a>
                                        <a class="button red" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-cell">
                                    <div class="image">
                                        <img src="img/avatar.svg" class="rounded-full" />
                                    </div>
                                </td>
                                <td data-label="Group Name">
                                    <a class="font-medium whitespace-no-wrap inline-block" href="javascript:void(0)">
                                        Group Name
                                    </a>
                                    <p>Some Desc</p>
                                </td>
                                <td data-label="Contacts">20</td>
                                <td data-label="Status">
                                    <div class="flex items-center text-green-600">
                                        <i class="mdi mdi-checkbox-multiple-outline"></i> Active
                                    </div>
                                </td>
                                <td data-label="Created">3 days ago</td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button green" href="javascript:void(0)">
                                            <span class="icon"><i class="mdi mdi-eye mdi-24px"></i></span>
                                        </a>
                                        <a class="button yellow" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-square-edit-outline mdi-24px"></i></span>
                                        </a>
                                        <a class="button red" href="javscript:void(0)">
                                            <span class="icon"><i class="mdi mdi-trash-can mdi-24px"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
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
