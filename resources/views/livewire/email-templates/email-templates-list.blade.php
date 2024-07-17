<section class="section main-section">
    <div class="bg-white shadow-sm rounded-sm p-6">
        @if ($templates->isEmpty())
            <div class="card empty">
                <div class="card-content">
                    <div>
                        <span class="icon large text-green-500"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                    </div>
                    <p>Nothing's here…</p>
                </div>
                <hr />
                <div class="text-end p-4">
                    <a href="{{ route('org-admin.new-email-template', ['organisation' => $org_name]) }}" class="button w-1/4 md:w-1/2">Add New Template</a>
                </div>
            </div>
        @else
            <div class="mb-4 flex items-center justify-between">
                <a href="{{ route('org-admin.new-email-template', ['organisation' => $org_name]) }}" class="button flex gap-2 items-center justify-center bg-green-500 text-white">
                    <i class="mdi mdi-open-in-new mdi-24px"></i> Add New Email Template
                </a>
                <span class="text-green-600 font-semi-bold">
                    Email Templates ({{ $totalTemplates }})
                </span>
            </div>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $user = Auth::user();
                @endphp
                @foreach ($templates as $template)
                    <div class="card">
                        <header class="card-header">
                            <div class="card-header-title">
                            <span class="icon"><i class="mdi mdi-xml mr-4"></i></span>
                            <div class="leading-tight text-xs">
                                {{ $template->template_name }} created by <span class="text-green-500">{{ $template->userOrganisation->user->id !== $user->id ? $template->userOrganisation->user->first_name . ' ' . $template->userOrganisation->user->last_name : 'me'  }}</span> 
                                <p><span>created:</span> <span class=""></span>{{ $template->created_at->diffForHumans() }}</p>
                                @if ($template->updated_at > $template->created_at)
                                <p>updated: <span class="text-green-500">{{ $template->updated_at->diffForHumans() }}</span></p>
                                @endif
                            </div>
                            </div>
                            <div class="flex relative">
                                <a href="javasript:void(0)" class="flex-1 card-header-icon --jb-navbar-menu-toggle" data-target="template-menu-{{$loop->iteration}}">
                                    <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
                                </a>
                                <div class="template-menu absolute w-max top-12 right-0 shadow bg-white rounded-sm" id="template-menu-{{$loop->iteration}}">
                                    <a href="{{ url(($template->template_file_destination? "$template->template_file_destination" : "email-builder/templates/default/" . $template->design_template . "/index.html")) }}" target="_blank" class="navbar-item gap-1">
                                        <i class="mdi mdi-eye-outline"></i> Preview
                                    </a>
                                    <button wire:click="duplicateTemplate({{ $template->id }})" class="navbar-item gap-1">
                                        <i class="mdi mdi-content-duplicate"></i> Duplicate
                                    </button>
                                    <a href="{{ route('org-admin.edit-email-template', [
                                        'organisation' => $org_name,
                                        'id' => $template->id 
                                    ]) }}" class="navbar-item gap-1">
                                        <i class="mdi mdi-pencil-outline"></i> Edit
                                    </a>
                                    {{-- <a href="#" class="navbar-item gap-1">
                                        <i class="mdi mdi-image-outline"></i> Edit Thumbnail
                                    </a> --}}
                                    <button wire:click="confirmTemplateDelete({{ $template->id }})" class="navbar-item gap-1">
                                        <i class="mdi mdi-trash-can-outline"></i> Delete Template
                                    </button>
                                </div>
                            </div>
                        </header>
                        <div class="card-content">
                            <div class="w-full h-40 bg-no-repeat bg-contain bg-center mb-2" style="background-image: url('https://fullaccess.maildoll.com/not_found/no-preview.png');"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Table pagination -->
            {{ $templates->links('livewire.custom-pagination') }}
        @endif

        @if ($confirmingTemplateId)
            <div class="modal active">
                <div class="modal-background --jb-modal-close"></div>
                <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Delete Template</p>
                </header>
                <section class="modal-card-body">
                    <p><b>Are you sure you want to delete this template?</b></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" wire:click="deleteTemplate">Confirm</button>
                    <button class="button red" wire:click="$set('confirmingTemplateId', null)">Cancel</button>
                </footer>
                </div>
            </div>
        @endif
    </div>
</section>
@script
    <script>
        $wire.on('success', (event) => {
            console.log(event);
            toastr.success(event.message, "Success");
        });
        $wire.on('error', (event) => {
            toastr.error(event.message, "Error");
        });
    </script>
@endscript