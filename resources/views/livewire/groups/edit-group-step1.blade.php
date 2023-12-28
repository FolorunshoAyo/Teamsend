<div>
    <div class="field spaced">
        <label class="label">Group Name <span class="text-red-600">*</span></label>
        <div class="field-body">
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model="name" value="{{ $formData['name'] }}" placeholder="Group Name" />
                    <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
                @error('name') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Short Description</label>
        <div class="control">
            <textarea class="textarea" wire:model="description" placeholder="Short Description">
                {{ $formData['description'] }}
            </textarea>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Active Status</label>
        <div class="field-body">
            <div class="field">
                <label class="switch">
                    <input type="checkbox" wire:model="active" {{$formData['active']? "checked='checked'" : ""}}/>
                    <span class="check"></span>
                    <span class="control-label">Set Active?</span>
                </label>
            </div>
        </div>
    </div>
    <div class="text-end">
        <button type="button" class="button" wire:click="nextStep">Next</button>
    </div>
</div>
