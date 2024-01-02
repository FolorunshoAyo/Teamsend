<div class="card w-full sm:w-1/2 self-start shadow-lg">
    <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-export"></i></span>
          Bulk Export
        </p>
    </header>
    <div class="card-content">
        <img src="https://fullaccess.maildoll.com/bulk/export.jpg"  class="mx-auto" style="width: 250px; height: 250px;"/>
        <div class="text-center mt-6">
            <button wire:click="exportContacts" class="button">Export
                Contacts</button>
        </div>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-2" role="alert">
            <p>Download the <a href="{{asset('csv/sample_contacts.csv')}}" class="text-lg font-bold underline leading-none">sample csv</a> file and override the sample data.
                Make sure each column has data as like the sample csv.</p>
        </div>
    </div>
</div>