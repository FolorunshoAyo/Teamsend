@extends('layouts.form')

@section('form-screen-class', 'form-screen')

@section('content')
<div class="sm:px-0">
    <div class="block md:grid md:grid-cols-2 md:gap-6">
      <section class="p-6 flex-col min-h-screen bg-green-600 hidden md:flex lg:flex xl:flex">
        <a href="./" class="-intro-x flex items-center inline-block pt-5 w-48 bg-white p-2">
          <img
            alt="TeamSource"
            src="{{asset('images/teamsource-logo.png')}}"
          />
        </a>
        <div class="my-auto">
          <img
            alt="Banner Illustration"
            class="-intro-x w-1/2 -mt-16"
            src="https://fullaccess.maildoll.com/auth/login/4.png"
          />
          <div
            class="-intro-x text-white font-medium text-2xl leading-tight mt-4"
          >
            <span class="font-bold text-lg">Let's get Started</span><br />
            Sign in for free, no credit care required
          </div>
        </div>
      </section>
      <section class="section flex h-screen items-center justify-center">
        <div class="w-full mx-4 md:w-3/4 md:mx-0 bg-white rounded shadow-lg">
          <a href="./" class="-intro-x md:hidden flex items-center pt-5 w-48 m-auto mb-5">
            <img alt="TeamSource" src="{{asset('images/teamsource-logo.png')}}">
          </a>
          <header class="flex items-stretch font-bold text-2xl md:text-3xl">
            <p class="flex items-center py-2 px-4">
              <span class="icon mr-2"><i class="mdi mdi-lock"></i></span>
              Sign In
            </p>
          </header>
          <livewire:login-form />
        </div>
      </section>
    </div>
  </div>  
@endsection

@section('action-scripts')
  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  @if (session('success'))
    <script>
      $(document).ready(function () {
        toastr.success("{{ session('success')}}", 'Success');
      });
    </script>
  @endif
@endsection