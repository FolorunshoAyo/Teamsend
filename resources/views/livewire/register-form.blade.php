<div class="p-4">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <i class="mdi mdi-information-outline font-medium"></i> {{ $error }}
        </div>
      @endforeach
    @endif
    <form wire:submit.prevent="register">
      <div class="field">
        <div class="control icons-left">
          <input
            class="input"
            type="email"
            wire:model="email"
            placeholder="user@example.com"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-account"></i
          ></span>
        </div>
        <p class="help">Please enter your email</p>
      </div>

      <div class="field">
        <p class="control icons-left">
          <input
            class="input"
            type="password"
            wire:model="password"
            placeholder="Enter Password"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-asterisk"></i
          ></span>
        </p>
        <p class="help">Please enter your password</p>
      </div>
      
      <div class="field">
        <p class="control icons-left">
          <input
            class="input"
            type="password"
            wire:model="password_confirmation"
            placeholder="Retype Password"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-asterisk"></i
          ></span>
        </p>
        <p class="help">Please reenter your password</p>
      </div>

      <div class="field">
        <div class="control">
            <button type="submit" wire:loading.attr="disabled" class="button w-full">
              <span wire:loading.remove>Sign Up</span> 
              <span wire:loading wire:target="register">Signing Up ....</span>
            </button>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <a href="{{route('auth.login')}}" class="button w-full">Sign In</a>
        </div>
      </div>
    </form>
  </div>