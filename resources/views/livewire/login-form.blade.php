<div class="p-4">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <i class="mdi mdi-information-outline font-medium"></i> {{ $error }}
        </div>
      @endforeach
    @endif    
    <form wire:submit.prevent="login">
      <div class="field">
        <div class="control icons-left">
          <input
            class="input"
            type="email"
            wire:model="email"
            placeholder="user@example.com"
            autocomplete="username"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-account"></i
          ></span>
        </div>
        <p class="help">Please enter your login</p>
      </div>

      <div class="field">
        <p class="control icons-left">
          <input
            class="input"
            type="password"
            wire:model="password"
            placeholder="Password"
            autocomplete="current-password"
          />
          <span class="icon is-small left"
            ><i class="mdi mdi-asterisk"></i
          ></span>
        </p>
        <p class="help">Please enter your password</p>
      </div>

      <div class="field spaced flex justify-between">
        <div class="control">
          <label class="checkbox"
            ><input type="checkbox" wire:model="remember"/>
            <span class="check"></span>
            <span class="control-label">Remember</span>
          </label>
        </div>
        <a href="{{route('auth.forgot-password')}}">Forgot Password?</a>
      </div>

      <div class="field">
        <div class="control">
          <button type="submit" wire:loading.attr="disabled" class="button w-full">
            <span wire:loading.remove>Sign In</span> 
            <span wire:loading wire:target="login">Signing In ....</span>
          </button>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <a href="{{route('auth.register')}}" class="button w-full">Sign Up</a>
        </div>
      </div>
    </form>
  </div>
