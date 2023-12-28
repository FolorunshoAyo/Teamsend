<div id="view-agent-modal" class="modal active">
    <div class="modal-background --jb-modal-close" wire:click="closeModal"></div>
    <form wire:submit.prevent="updateAgent" class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">View Agent</p>
      </header>
      <section class="modal-card-body">
        <div class="field spaced">
          <label class="label">First Name</label>
          <div class="control icons-left">
            <input
              class="input"
              type="text"
              value="{{$first_name}}"
              placeholder="Ex. John"
              disabled
            />
            <span class="icon is-small left"
              ><i class="mdi mdi-account"></i
            ></span>
          </div>
        </div>

        <div class="field spaced">
          <label class="label">Last Name</label>
          <div class="control icons-left">
            <input
              class="input"
              type="text"
              value="{{$last_name}}"
              placeholder="Ex. Doe"
              disabled
            />
            <span class="icon is-small left"
              ><i class="mdi mdi-account"></i
            ></span>
          </div>
        </div>

        <div class="field spaced">
          <label class="label">Email</label>
          <div class="control icons-left">
            <input
              class="input"
              type="text"
              name="email"
              value="{{$email}}"
              placeholder="Ex: jhondoe@mail.com"
              disabled
            />
            <span class="icon is-small left"
              ><i class="mdi mdi-email-outline"></i
            ></span>
          </div>
        </div>

        <div class="field spaced">
          <label class="label">Active Status</label>
          <div class="field-body">
            <div class="field">
              <label class="switch">
                <input type="checkbox" wire:model="active" {{ $active? "checked" : "" }} />
                <span class="check"></span>
                <span class="control-label">Set Active?</span>
              </label>
            </div>
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button type="submit" class="button" wire:loading.attr="disabled">
          Update
        </button>
        <button wire:click="closeModal" class="button red">Cancel</button>
      </footer>
    </form>
    </div>
</div>
