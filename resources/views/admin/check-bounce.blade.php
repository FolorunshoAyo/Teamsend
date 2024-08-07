@extends('layouts.admin')

@section('content')
    <section class="section main-section">
        <div class="bg-white p-6 rounded-sm shadow-sm">
            <form id="mail-checker" class="flex gap-2 my-6">
                <div>
                    <label class="label">Email Address</label>
                    <div class="field-body flex items-center">
                        <div class="field">
                            <div class="control icons-left">
                                <input class="input" type="text" placeholder="Email Address" />
                                <span class="icon left"><i class="mdi mdi-email"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="self-end button">Check</button>
            </form>
            <div id="mail-checker-result" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-left mt-6"
                role="alert">
                <p>testemail@gmail.com is verified</p>
            </div>
        </div>
    </section>
@endsection
