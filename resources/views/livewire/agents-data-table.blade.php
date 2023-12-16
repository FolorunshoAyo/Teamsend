<section class="section main-section">
  <div class="my-6 flex flex-col items-center sm:justify-between sm:flex-row gap-4">
    <button class="button" wire:click="createAgent">
      <i class="mdi mdi-plus"></i>
      Add New Agent
    </button>
    <div class="field">
      <div class="control icons-left">
        <input class="input" type="text" wire:model.live.debounce.300ms="search" placeholder="Search Agents....">
        <span class="icon left"><i class="mdi mdi-magnify mdi-24px"></i></span>
      </div>
    </div>
  </div>
    @if ($agentsData->isEmpty())
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
            <button class="button w-1/4 md:w-1/2"  wire:click="createAgent">Add New Agent</button>
            </div>
        </div>
    @else
      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Agents
          </p>
          <div class="tools inline-flex items-center space-x-2">
            <label for="perPage" class="font-semibold">Show:</label>
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
              <button wire:click="refreshTable" class="card-header-icon">
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
                <th>Name</th>
                <th>Email</th>
                <th>Total Campaigns Created</th>
                <th>Total Mails Sent</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($agentsData as $agent)
                <tr>
                    <td class="image-cell">
                    <div class="image">
                        <img
                        src="{{asset('images/avatar.svg')}}"
                        class="rounded-full"
                        />
                    </div>
                    </td>
                    <td data-label="Name">{{ $agent->last_name . " " . $agent->first_name }}</td>
                    <td data-label="Email">{{ $agent->email }}</td>
                    <td data-label="Campaigns Created">5</td>
                    <td data-label="Total Mails Sent">800</td>
                    <td data-label="Status" class="flex items-center {{ $agent->active? 'text-green-600' : 'text-red-600'}}">
                      {!! $agent->active? "<i class='mdi mdi-check-circle-outline'></i> Active" : "<i class='mdi mdi-close-box-multiple-outline'></i> Inactive" !!}
                    </td>
                    <td class="actions-cell">
                    <div class="buttons right nowrap">
                        <button
                        wire:click="openAgentEditModal({{ $agent->id }})"
                        class="button small green"
                        type="button"
                        >
                        <span class="icon"><i class="mdi mdi-eye"></i></span>
                        </button>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <!-- Table pagination -->
          {{ $agentsData->links('livewire.custom-pagination') }}
        </div>
        <hr />
        <div class="text-end p-4">
          <button class="button w-1/4 md:w-1/2"  wire:click="createAgent">Add New Agent</button>
        </div>
      </div>
    @endif
    <!-- Edit Modal -->
    @if ($modalVisible)
      @livewire('agent-edit-modal', ['agent' => $selectedAgent])
    @endif

    <!-- Create Modal -->
    @if ($createModalVisible)
        @livewire('agent-create-modal')
    @endif
</section>
  @script
    <script>
      $wire.on('notifyUpdatedAgent', () => {
        toastr.success("Agent Updated Successfully", "Success");
      });
      $wire.on('notifyNewAgent', () => {
        toastr.success("New Agent Added Successfully", "Success");
      }); 
      $wire.on('tableRefreshed', () => {
        toastr.success("Table refreshed successfully", "Success");
      });
    </script>
  @endscript
