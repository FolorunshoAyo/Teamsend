<section class="section main-section">
    <div class="p-4 bg-white shadow-sm rounded-sm">
        <ol
            class="progress my-6 mx-auto mt-6 mb-10 items-center justify-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
            <li class="{{$currentStep == 1? 'active' : ''}} flex items-center text-green-600 space-x-2.5 rtl:space-x-reverse">
                <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 dark:border-blue-500">
                    1
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Edit Group</h3>
                    <p class="text-sm">Edit Basic Group Info</p>
                </span>
            </li>
            <li class="{{$currentStep == 2? 'active' : ''}} flex items-center text-gray-500 space-x-2.5 rtl:space-x-reverse">
                <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 dark:border-gray-400">
                    2
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Select Audience</h3>
                    <p class="text-sm">Choose from listed contacts</p>
                </span>
            </li>
        </ol>
        <div id="new-group-form"
            class="p-2 max-w-3xl mx-auto xs:flex gap-2 overflow-x-hidden transition-all duration-500">

            <!-- Step 1 -->
            <div class="step {{$currentStep == 1? 'active' : ''}}">
                <livewire:groups.edit-group-step1 :formData="$formData['step1'] ?? []" />
            </div>

            <!-- Step 2 -->
            <div class="step {{$currentStep == 2? 'active' : ''}}">
                <livewire:groups.edit-group-step2 :orgId="$orgId" :formData="$formData['step2'] ?? []"/>
            </div>
            
        </div>
    </div>
</section>
@script
    <script>
        $wire.on('tableSuccess', (event) => {
            console.log(event);
            toastr.success(event.message, "Success");
        });
        $wire.on('tableRefreshed', () => {
            toastr.success("Table refreshed successfully", "Success");
        });

        $wire.on('tableError', (event) => {
            toastr.error(event.message, "Error");
        });
    </script>
@endscript

