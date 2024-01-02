<div class="card w-full sm:w-1/2">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-import"></i></span>
            Bulk Import
        </p>
    </header>
    <div class="card-content">
        <img src="{{asset('images/import.jpg')}}" class="mx-auto" style="width: 250px; height: 250px;"/>
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="my-4 flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <i class="mdi mdi-information-outline font-medium"></i> {{ $error }}
                </div>
            @endforeach
        @endif

        @if (session('error'))
            <div class="my-4 flex items-center gap-2 p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <i class="mdi mdi-information-outline font-medium"></i> {{ session('error') }}
            </div>
        @endif

        @if ($contactsUploaded > 0 || $duplicateContacts > 0)
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-2" role="alert">
                <p>
                    Contacts Uploaded: {{ $contactsUploaded }}
                </p>
                <p>
                    Duplicate Contacts Found: {{ $duplicateContacts }}
                </p>
                <a class="button" href="{{ route('org-admin.contacts', ['organisation' => "$org_name"]) }}">View Contacts</a>
            </div>
        @endif

        @if ($isGroupCreated)
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-2" role="alert">
                <p>
                    {{$groupName}} Created successfully
                </p>
                <a class="button" href="{{ route('org-admin.groups', ['organisation' => "$org_name"]) }}">View Groups</a>
            </div>
        @endif

        <form class="mt-6">
            <div class="mb-6 text-center">
                <input type="file" wire:model.blur="csvFile" />
            </div>

            <div class="field text-center">
                <div class="control">
                    <label class="checkbox">
                    <input type="checkbox" wire:click="toggleCreateGroup">
                    <span class="check"></span>
                    <span class="control-label">Create Group?</span>
                    </label>
                </div>
            </div>

            <div class="m-3 {{ $createGroup? "" : "hidden" }}">
                <div class="field">
                    <label class="label">Group Name <span class="text-red-600">*</span></label>
                    <div class="field-body">
                        <div class="field">
                        <div class="control icons-left">
                            <input class="input" type="text" wire:model="groupName" placeholder="Enter Group Name...">
                            <span class="icon left"><i class="mdi mdi-account"></i></span>
                        </div>
                        </div>
                    </div>
                </div>

                
                <div class="field">
                    <label class="label">Group Description</label>
                    <div class="control">
                        <textarea class="textarea" wire:model="groupDesc" placeholder="Enter Group Description"></textarea>
                    </div>
                </div>

                {{-- <div class="field">
                    <label class="label">List Type</label>
                    <div class="field-body">
                        <div class="field grouped multiline">
                        <div class="control">
                            <label class="radio">
                            <input 
                            type="radio" 
                            wire:model="listType"
                            value="email"
                            checked>
                            <span class="check"></span>
                            <span class="control-label">Email Group</span>
                            </label>
                        </div>
                        <!-- <div class="control">
                            <label class="radio">
                            <input 
                            type="radio" 
                            name="type"
                            value="sms"
                            >
                            <span class="check"></span>
                            <span class="control-label">SMS Group</span>
                            </label>
                        </div> -->
                        </div>
                    </div>
                </div> --}}

                <div class="field">
                    <label class="label">Active Status</label>
                    <div class="field-body">
                        <div class="field">
                            <label class="switch">
                                <input type="checkbox" wire:model="groupActive"/>
                                <span class="check"></span>
                                <span class="control-label">Set Active?</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="button" wire:click="import" class="button">
                    Import
                </button>
            </div>
            <ul class="my-3 font-medium text-center leading-none">
                <li class="mt-2">File size must be smaller then 20MB</li>
                <li class="mt-2">File type must be CSV</li>
            </ul>    
        </form>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-2" role="alert">
            <p>Please upload your containing csv file compitable with CSV(Comma Delimited) unless some field
                will be truncated.</p>
        </div>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-2" role="alert">
            <p>Please be careful with the columns; Extra columns are not ideal csv for importing.</p>
        </div>
    </div>
</div>