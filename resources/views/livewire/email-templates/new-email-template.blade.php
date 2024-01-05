<section class="section main-section">
    <div class="bg-white rounded-sm p-6 shadow-sm">
        <form wire:submit.prevent="createTemplate">
            <div class="field spaced">
                <label class="label">Template Title <span class="text-red-600">*</span></label>
                <div class="field-body">
                    <div class="field">
                      <div class="control icons-left">
                        <input class="input" type="text" wire:model="template_title" placeholder="Template Title">
                        <span class="icon left"><i class="mdi mdi-home-outline"></i></span>
                      </div>
                    </div>
                    @error('template_title') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="field spaced">
                {{-- <label class="label">Template Preview Image</label>
                <div class="mb-6 text-center">
                    <input type="file" name="template-preview" />
                </div>
            </div> --}}
            <div class="field spaced">
                <label class="label">Select a deisgn template</label>
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/blank-layout.svg')}}" style="width: 100%; height:100%;" alt="Blank" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">Blank</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="blank">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/pricing-table-layout.svg')}}" style="width: 100%; height:100%;" alt="Pricing Table" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">Pricing Table</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="pricing-table">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/listing-and-tables-layout.svg')}}" style="width: 100%; height:100%;" alt="Listing & Tables" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">Listing & Tables</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="listing-and-tables">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/1-2-1-column-layout.svg')}}" style="width: 100%; height:100%;" alt="1-2-1 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">1-2-1 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="1-2-1-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <input type="radio" wire:model="selected_design_template" value="1-2-column-layout">
                        <div class="w-full h-64">
                            <img src="{{asset('images/1-2-column-layout.svg')}}" style="width: 100%; height:100%;" alt="1-2 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">1-2 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="1-2-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/1-3-1-column-layout.svg')}}" style="width: 100%; height:100%;" alt="1-3-1 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">1-3-1 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="1-3-1-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/1-3-2-column-layout.svg')}}" style="width: 100%; height:100%;" alt="1-3-2 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">1-3-2 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="1-3-2-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/1-3-column-layout.svg')}}" style="width: 100%; height:100%;" alt="1-3 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">1-3 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="1-3-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/one-column-layout.svg')}}" style="width: 100%; height:100%;" alt="One column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">One column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="one-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/2-1-2-column-layout.svg')}}" style="width: 100%; height:100%;" alt="2-1-2 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">2-1-2 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="2-1-2-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/2-1-column-layout.svg')}}" style="width: 100%; height:100%;" alt="2-1 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">2-1 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="2-1-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/two-column-layout.svg')}}" style="width: 100%; height:100%;" alt="Two columns layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">Two columns layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="two-columns-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/3-1-3-column-layout.svg')}}" style="width: 100%; height:100%;" alt="3-1-3 column layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">3-1-3 column layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="3-1-3-column-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                    <label class="card form-card">
                        <div class="w-full h-64">
                            <img src="{{asset('images/three-column-layout.svg')}}" style="width: 100%; height:100%;" alt="Three columns layout" class="hover:opacity-80 transition duration-300">
                        </div>
                        <div class="card-content">
                            <h5 class="text-lg">Three columns layout</h5>
                            <div class="mb-4">
                                <i> by </i>
                                <a class="hover:underline hover:text-green-500" href="javascript:;">teamsource.net</a>
                            </div>
                            <div class="flex align-center justify-end">
                                <span class="mr-2 text-green-500">Select:</span>
                                <input type="radio" wire:model="selected_design_template" value="three-columns-layout">
                                <span class="check"></span>
                            </div>
                        </div>
                    </label>
                </div>
                @error('selected_design_template') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="button">Start Editor</button>
            </div>
        </form>
    </div>
</section>