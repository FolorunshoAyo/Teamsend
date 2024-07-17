<section class="main main-section">
    <div class="p-4 bg-white shadow-sm rounded-sm">
        <ol
            class="progress my-6 mx-auto mt-6 mb-10 items-center justify-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
            <li
                class="{{ $currentStep == 1 ? 'active' : '' }} flex items-center text-green-600 space-x-2.5 rtl:space-x-reverse">
                <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 dark:border-blue-500">
                    1
                </span>
                <span>
                    <h3 class="font-medium leading-tight">New Campaign</h3>
                    <p class="text-sm">Enter Basic Campaign Info</p>
                </span>
            </li>
            <li
                class="{{ $currentStep == 2 ? 'active' : '' }} flex items-center text-gray-500 space-x-2.5 rtl:space-x-reverse">
                <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 dark:border-gray-400">
                    2
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Select Email Template</h3>
                    <p class="text-sm">Choose from created templates</p>
                </span>
            </li>
            <li
                class="{{ $currentStep == 3 ? 'active' : '' }} flex items-center text-gray-500 space-x-2.5 rtl:space-x-reverse">
                <span
                    class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0 dark:border-gray-400">
                    3
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Select Email Group/Segment(Audience)</h3>
                    <p class="text-sm">Select from created email groups</p>
                </span>
            </li>
        </ol>
        <div id="new-campaign-form"
            class="p-2 max-w-5xl mx-auto flex gap-2 overflow-x-hidden transition-all duration-500">
            <!-- Step 1 -->
            <div class="step {{ $currentStep == 1 ? 'active' : '' }}">
                <livewire:email-campaigns.new-email-campaign-step1 :formData="$formData['step1'] ?? []" />
            </div>
            <!-- Step 2 -->
            <div class="step {{ $currentStep == 2 ? 'active' : '' }}">
                <livewire:email-campaigns.new-email-campaign-step2 :formData="$formData['step2'] ?? []" :orgId="$orgId" />
            </div>
            <!-- Step 3 -->
            <div class="step {{ $currentStep == 3 ? 'active' : '' }}">
              <livewire:email-campaigns.new-email-campaign-step3 :formData="$formData['step3'] ?? []" :orgId="$orgId" :orgName="$orgName" />
            </div>
        </div>
    </div>
</section>
