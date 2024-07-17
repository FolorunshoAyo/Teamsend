<div>
    <span class="text-green-600 font-semi-bold">
        Groups ({{ $totalGroups }})
      </span>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mb-3">
        @php
            $user = Auth::user();
        @endphp
        @foreach ($groups as $group)
            <label class="form-card card">
                <header class="card-header">
                    <div class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-group mr-4"></i></span>
                        <div class="leading-tight text-xs">
                            {{ $group->list_name }} created by <span class="text-green-500">{{ $group->userOrganisation->user->id !== $user->id ? $group->userOrganisation->user->first_name . ' ' . $group->userOrganisation->user->last_name : 'me'  }}</span> 
                            <p><span>created:</span> <span class=""></span>{{ $group->created_at->diffForHumans() }}</p>
                            @if ($group->updated_at > $group->created_at)
                            <p>updated: <span class="text-green-500">{{ $group->updated_at->diffForHumans() }}</span></p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-2">
                        <span class="mr-2 text-green-500">Select:</span>
                        <input type="radio" wire:model="group" value="{{ $group->id }}" {{ $formData['selectedEmailGroup'] == $group->id ? "checked='checked'" : "" }}>
                        <span class="check"></span>
                    </div>
                </header>
                <div class="card-content">
                    <div class="w-full h-40 bg-no-repeat bg-contain bg-center mb-2"
                        style="background-image: url('https://fullaccess.maildoll.com/not_found/group.png');">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('org-admin.view-group', [
                            'organisation' => $org_name,
                            'id' => $group->id 
                        ]) }}" class="button">View Group</a>
                    </div>
                </div>
            </label>
        @endforeach
    </div>
    <div class="my-2">
        {{-- {{ $groups->links('livewire.custom-pagination') }} --}}
    </div>
    <div class="my-6 text-end">
        <button type="button" wire:click="previousStep" class="button">Back</button>
        <button type="button" wire:click="createCampaign" class="button flex items-center gap-2 justify-center bg-green-500 text-white mr-2">
            <span wire:loading.remove><i class="mdi mdi-open-in-new mdi-24px"></i> Save Campaign</span>
            <span wire:loading wire:target="createCampaign">Creating ....</span>
        </button>
    </div>
</div>
