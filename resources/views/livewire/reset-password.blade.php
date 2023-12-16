<div class="p-4">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <i class="mdi mdi-information-outline font-medium"></i> {{ $error }}
        </div>
      @endforeach
    @endif
    <form wire:submit.prevent="resetPassword">
      <div class="field spaced">
        <div class="field">
            <label class="label">New password</label>
            <div class="control">
              <input
                type="password"
                autocomplete="new-password"
                wire:model="password"
                class="input"
              />
            </div>
            <p class="help">Required. New password</p>
        </div>
        <div class="field">
            <label class="label">Confirm password</label>
            <div class="control">
              <input
                type="password"
                autocomplete="new-password"
                wire:model="password_confirmation"
                class="input"
              />
            </div>
            <p class="help">Required. New password one more time</p>
        </div>
        <hr />
        <div class="field spaced">
            <div class="control">
                <button type="submit" wire:loading.attr="disabled" class="button w-full capitalize">
                    <span wire:loading.remove>Update password</span> 
                    <span wire:loading wire:target="sendResetLink">updating password ....</span>
                </button>
            </div>
        </div>
    </form>
  </div>
