<div>
  <span class="text-green-600 font-semi-bold">
    Email Templates ({{ $totalTemplates }})
  </span>
  <br><br>
  <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mb-3">
    @php
      $user = Auth::user();
    @endphp
    @foreach ($templates as $template)
    <label class="form-card card">
      <header class="card-header">
        <div class="card-header-title">
            <span class="icon"><i class="mdi mdi-xml mr-4"></i></span>
            <div class="leading-tight text-xs">
              {{ $template->template_name }} created by <span class="text-green-500">{{ $template->userOrganisation->user->id !== $user->id ? $template->userOrganisation->user->first_name . ' ' . $template->userOrganisation->user->last_name : 'me'  }}</span> 
                <p class="text-green-500">{{ $template->created_at->diffForHumans() }}</p>
              @if ($template->updated_at > $template->created_at)
                <p>updated: <span class="text-green-500">{{ $template->updated_at->diffForHumans() }}</span></p>
              @endif
            </div>
        </div>
        <div class="flex items-center justify-end px-2">
            <span class="mr-2 text-green-500">Select:</span>
            <input type="radio" wire:model="template" value="{{ $template->id }}" {{ $formData['selectedEmailTemplate'] == $template->id? "checked='checked'" : "" }}>
            <span class="check"></span>
        </div>
      </header>
      <div class="card-content">
        <div class="w-full h-40 bg-no-repeat bg-contain bg-center mb-2"
          style="background-image: url('https://fullaccess.maildoll.com/not_found/no-preview.png');"></div>
        <div class="text-right">
          <a href="{{ url(($template->template_file_destination? "$template->template_file_destination" : "email-builder/templates/default/" . $template->design_template . "/index.html")) }}" class="button" target="_blank">View Template</a>
        </div>
      </div>
    </label>
    @endforeach
  </div>
  @error('template') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
  <!-- Table pagination -->
  <div class="my-2">
    {{-- {{ $templates->links('livewire.custom-pagination') }} --}}
  </div>
  <div class="text-end">
    <button type="button" class="button" wire:click="prevStep">Back</button>
    <button type="button" class="button" wire:click="nextStep">Next</button>
  </div>
</div>
