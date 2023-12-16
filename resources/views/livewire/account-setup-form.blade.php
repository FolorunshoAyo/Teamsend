<div class="py-4 px-8">
    <form wire:submit.prevent="submitAccountSetupForm">
      <div class="mb-10 flex flex-col gap-4 sm:gap-2 sm:flex-row">
        <div class="w-full sm:w-1/2">
            <div class="control icons-left">
                <input
                  class="input"
                  type="text"
                  wire:model.blur="first_name"
                  placeholder="First Name"
                  autocomplete
                />
                <span class="icon is-small left"
                  ><i class="mdi mdi-account"></i
                ></span>
              </div>
              <p class="help">Please enter your first name <span class="text-red-500">*</span></p>
              @error('first_name') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
        <div class="w-full sm:w-1/2">
            <div class="control icons-left">
                <input
                  class="input"
                  type="text"
                  wire:model.blur="last_name"
                  placeholder="Last Name"
                  autocomplete
                />
                <span class="icon is-small left"
                  ><i class="mdi mdi-account"></i
                ></span>
              </div>
              <p class="help">Please enter your last name <span class="text-red-500">*</span></p>
              @error('last_name') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="mb-10 flex flex flex-col gap-4 sm:gap-2 sm:flex-row">
        <div class="w-full sm:w-1/2">
            <div class="control icons-left">
                <input
                  class="input"
                  type="text"
                  wire:model.blur="company_name"
                  placeholder="Company Name"
                  autocomplete
                />
                <span class="icon is-small left"
                  ><i class="mdi mdi-account"></i
                ></span>
              </div>
              <p class="help">Please enter your company name <span class="text-red-500">*</span></p>
              @error('company_name') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
        <div class="w-full sm:w-1/2">
            <div class="control icons-left">
                <input
                  class="input"
                  type="text"
                  wire:model.blur="company_website"
                  placeholder="Company Website"
                  autocomplete
                />
                <span class="icon is-small left"
                  ><i class="mdi mdi-account"></i
                ></span>
              </div>
              <p class="help">Please enter your company website <span class="text-red-500">*</span></p>
              @error('company_website') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="mb-10">
        <div class="field-body">
          <div class="field">
            <div class="field addons">
              <div class="control">
                <input class="input" value="+234" size="3" readonly>
              </div>
              <div class="control expanded">
                <input class="input" wire:model.blur="phone_number"  type="tel" placeholder="Your phone number">
              </div>
            </div>
            <p class="help">Please enter your mobile number <span class="text-red-500">*</span></p>
            @error('phone_number') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>

      <div class="mb-10">
        <label class="label">What is your role? <span class="text-red-500">*</span></label>
        <div class="field-body">
          <div class="field grouped multiline">
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="owner_roles" value="CEO">
                <span class="check"></span>
                <span class="control-label">CEO</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="owner_roles" value="Marketer">
                <span class="check"></span>
                <span class="control-label">Marketer</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="owner_roles" value="Developer">
                <span class="check"></span>
                <span class="control-label">Developer</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="owner_roles" value="Other">
                <span class="check"></span>
                <span class="control-label">Other</span>
              </label>
            </div>
          </div>
        </div>
        @error('owner_roles') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
      </div>

      <div class="mb-10">
        <label class="label">How many emails do you send per month? <span class="text-red-500">*</span></label>
        <div class="field-body">
          <div class="field grouped multiline">
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="targeted_emails" value="0-5k" checked>
                <span class="check"></span>
                <span class="control-label">0 - 5k</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="targeted_emails" value="5k-10k">
                <span class="check"></span>
                <span class="control-label">5k - 10k</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="targeted_emails" value="10k-20k">
                <span class="check"></span>
                <span class="control-label">10k - 20k</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="targeted_emails" value="20k-30k">
                <span class="check"></span>
                <span class="control-label">20k - 30k</span>
              </label>
            </div>
          </div>
          @error('targeted_emails') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror        
        </div>
      </div>

      <div class="mb-10">
        <label class="label">How many employees work at your company? <span class="text-red-500">*</span></label>
        <div class="field-body">
          <div class="field grouped multiline">
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="employee_count" value="1-50" checked>
                <span class="check"></span>
                <span class="control-label">1 - 50</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="employee_count" value="50-100">
                <span class="check"></span>
                <span class="control-label">50 - 100</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="employee_count" value="100-500">
                <span class="check"></span>
                <span class="control-label">100 - 500</span>
              </label>
            </div>
            <div class="control">
              <label class="radio">
                <input type="radio" wire:model="employee_count" value="500-1000">
                <span class="check"></span>
                <span class="control-label">500 - 1000</span>
              </label>
            </div>
          </div>
          @error('employee_count') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="field spaced">
        <div class="control text-center">
          <button type="submit" wire:loading.attr="disabled" class="button py-4 px-2">
            <span>Get Started</span>  
          </button>
        </div>
      </div>
    </form>
  </div>
