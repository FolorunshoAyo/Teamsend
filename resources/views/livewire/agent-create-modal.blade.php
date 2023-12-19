<div id="new-agent-modal" class="modal active">
    <div class="modal-background --jb-modal-close" wire:click="closeModal"></div>
    <form wire:submit.prevent="createAgent" class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Add New Agent</p>
        </header>
        <section class="modal-card-body">
            <div class="field spaced">
                <label class="label">First Name <span class="text-red-600">*</span></label>
                <div class="control icons-left">
                    <input class="input" type="text" wire:model.blur="first_name" placeholder="Ex. John" />
                    <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                </div>
                <p class="help">Please enter agent's first name</p>
                @error('first_name')
                    <div class="text-xs text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="field spaced">
                <label class="label">Last Name <span class="text-red-600">*</span></label>
                <div class="control icons-left">
                    <input class="input" type="text" wire:model.blur="last_name" placeholder="Ex. Doe" />
                    <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                </div>
                <p class="help">Please enter agent's last name</p>
                @error('last_name')
                    <div class="text-xs text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="field spaced">
                <label class="label">Email <span class="text-red-600">*</span></label>
                <div class="control icons-left">
                    <input class="input" type="text" wire:model.blur="email" placeholder="Ex: jhondoe@mail.com" />
                    <span class="icon is-small left"><i class="mdi mdi-email-outline"></i></span>
                </div>
                <p class="help">Please enter agent's email address</p>
                @error('email')
                    <div class="text-xs text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="field spaced">
                <label class="label">Active Status</label>
                <div class="field-body">
                    <div class="field">
                        <label class="switch">
                            <input type="checkbox" wire:model="active" />
                            <span class="check"></span>
                            <span class="control-label">Set Active?</span>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button type="submit" class="button" wire:loading.attr="disabled">
                Save
            </button>
            <button type="button" class="button red" wire:click="closeModal">Cancel</button>
        </footer>
    </form>
</div>
