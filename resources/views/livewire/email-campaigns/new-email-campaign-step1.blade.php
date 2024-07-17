<div>
    <div class="field spaced">
        <label class="label">Campaign Name <span class="text-red-600">*</span></label>
        <div class="field-body">
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model="name" value="{{ $formData['name'] }}" placeholder="Campaign Name" />
                    <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
                @error('name') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Short Description</label>
        <div class="control">
            <textarea class="textarea" wire:model="description" value="{{ $formData['description'] }}" placeholder="Short Description">
                {{ $formData['description'] }}
            </textarea>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Campaign Subject <span class="text-red-600">*</span></label>
        <div class="field-body">
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model="subject" value="{{ $formData['subject'] }}" placeholder="Campaign Subject" />
                    <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
                @error('subject') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Set From <span class="text-red-600">*</span></label>
        <div class="field-body">
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="email" wire:model="set_from" value="{{ $formData['set_from'] }}" placeholder="Set From" />
                    <span class="icon left"><i class="mdi mdi-email-arrow-left"></i></span>
                </div>
                @error('set_from') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Reply To <span class="text-red-600">*</span></label>
        <div class="field-body">
            <div class="field">
                <div class="control icons-left">
                    <input class="input" type="text" wire:model="reply_to" value="{{ $formData['reply_to'] }}" placeholder="Reply To" />
                    <span class="icon left"><i class="mdi mdi-email-arrow-right"></i></span>
                </div>
            </div>
            @error('reply_to') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="field spaced">
        <label class="label">Active Status</label>
        <div class="field-body">
            <div class="field">
                <label class="switch">
                    <input type="checkbox" wire:model="active" {{$formData['active']? "checked='checked'" : ""}} />
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
