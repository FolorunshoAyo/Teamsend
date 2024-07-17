<section class="section main-section">
    <div class="p-6 bg-white shadow-sm rounded-sm">
        <div class="my-6 flex flex-col items-center sm:justify-between sm:flex-row gap-4">
            <a class="button" href="{{ route('org-admin.new-email-campaign', ['organisation' => "$org_name"]) }}">
                <i class="mdi mdi-plus"></i>
                Add New Campaign
            </a>
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model.live.debounce.300ms="search" placeholder="Search campaigns....">
                    <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
                </div>
            </div>
        </div>
        @if ($campaigns->isEmpty())
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
                    <a class="button w-1/4 md:w-1/2"  href="{{ route('org-admin.new-email-campaign', ['organisation' => "$org_name"]) }}">
                        <i class="mdi mdi-plus"></i>
                        Add New Campaign
                    </a>
                </div>
            </div>
        @else
            <div class="card has-table mb-6">
                <div class="filter-button-group inline-flex items-center rounded-md shadow-sm p-2" role="group">
                    <span class="mr-2">Filter by: </span>
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-900 bg-transparent border border-r-0 border-green-900 rounded-e-lg hover:bg-green-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-green-500 focus:bg-green-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-green-700 dark:focus:bg-green-700">
                      <i class="mdi mdi-check-circle-outline"></i>
                      Sent
                    </button>
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-900 bg-transparent border border-yellow-900 rounded-s-lg hover:bg-yellow-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-yellow-500 focus:bg-yellow-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-yellow-700 dark:focus:bg-yellow-700">
                      <i class="mdi mdi-cancel"></i>
                      Undelivered
                    </button>
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-900 bg-transparent border-t border-b  border-r border-blue-900 hover:bg-blue-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-700 dark:focus:bg-blue-700">
                      <i class="mdi mdi-calendar-clock"></i>
                      Schedules
                    </button>
                </div>
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        All Campaigns
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
                <div class="card-content overflow-x-scroll">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Campaign Name</th>
                                <th>Sent To (Count)</th>
                                <th>Template</th>
                                <th>Status</th>
                                <th>Send Status</th>
                                <th>Created</th>
                                <th>Instant Mailing</th>
                                <th>Schedule</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $user = Auth::user();
                            @endphp
                            @foreach ($campaigns as $campaign)
                            <tr wire:key="{{ $campaign->id }}">
                                <td class="image-cell">
                                    <div class="image">
                                        <img src="{{ asset('images/avatar.svg') }}" class="rounded-full" />
                                    </div>
                                </td>
                                <td data-label="Campaign Name">
                                    <a class="font-medium whitespace-no-wrap inline-block" href="javascript:void(0)">
                                        {{ $campaign->campaign_name }}
                                    </a>
                                    @if ($campaign->campaign_description)
                                        <p>{{ $campaign->campaign_description }}</p>
                                    @endif
                                </td>
                                <td data-label="Sent To">{{ count([1,2,3]) }} / {{ count([1,2,3]) }}</td>
                                <td data-label="Template">
                                    <a href="javascript:void(0)" class="flex items-center font-lg cursor-pointer hover:text-green-600 transition duration-300">
                                      View Template <i class="ml-2 mdi mdi-open-in-new"></i>
                                    </a>
                                </td>
                                <td data-label="Status">
                                    @if($campaign->status === 0)
                                        <span class="flex items-center text-red-600"><i class="mdi mdi-content-save-all-outline"></i> Active</span>
                                    @else
                                        <span class="flex items-center text-green-600"><i class="mdi mdi-check-circle-outline"></i> Inactive
                                    @endif
                                </td>
                                <td data-label="Send Status">
                                    @if($campaign->send_status === 0)
                                        <span class="flex items-center text-red-600"><i class="mdi mdi-cancel"></i> Undelivered</span>
                                    @elseif($campaign->send_status === 1)
                                        <span class="flex items-center text-green-600"><i class="mdi mdi-check-circle-outline"></i> Sent</span>
                                    @else
                                        <span class="flex items-center text-blue-600"></span><i class="mdi mdi-calendar-clock"></i> Scheduled</span>
                                    @endif
                                </td>
                                <td data-label="Created">
                                    {{$campaign->created_at->diffForHumans()}}
                                </td>
                                <td data-label="Instant Mailing">
                                    <button class="button" {{ $campaign->send_status === 1? "disabled" : "" }}>Instant Mailing</button>
                                </td>
                                <td data-label="Schedule">
                                    <button class="button" {{ $campaign->send_status === 1? "disabled" : "" }}>Schedule Mailing</button>
                                </td>
                                <td data-label="Actions" class="actions-cell">
                                    <div class="buttons right nowrap">
                                        <a class="button green" href="{{ route('org-admin.view-email-campaign', ['organisation' => "$org_name", 'id' => "$campaign->id"]) }}">
                                            <span class="icon"><i class="mdi mdi-eye mdi-24px"></i></span>
                                        </a>
                                        <a class="button yellow" href="{{ route('org-admin.edit-email-campaign', ['organisation' => "$org_name", 'id' => "$campaign->id"]) }}">
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
                    {{ $campaigns->links('livewire.custom-pagination') }}
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
