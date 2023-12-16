<div class="p-4">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <i class="mdi mdi-information-outline font-medium"></i> {{ $error }}
        </div>
      @endforeach
    @endif
    <form wire:submit.prevent="sendResetLink">
      <div class="field spaced">
        <div class="control icons-left">
          <input
            class="input"
            type="email"
            wire:model="email"
            placeholder="user@example.com"
            autocomplete="username"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-email-outline"></i
          ></span>
        </div>
        <p class="help">Please enter your registered email</p>
      </div>
      
      <div class="field spaced">
        <div class="control">
            <button type="submit" wire:loading.attr="disabled" class="button w-full capitalize">
                <span wire:loading.remove>send new password to email</span> 
                <span wire:loading wire:target="sendResetLink">sending new password ....</span>
            </button>
        </div>
      </div>
    </form>
  </div>
