@extends("layouts.form")

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
            <span class="font-bold text-lg">Recovery Mail Sent!!</span><br />
            Please check your email inbox or spam to retrieve your new password
          </div>
        </div>
      </section>
      <section class="section flex h-screen items-center justify-center">
        <div class="w-full mx-4 md:w-3/4 md:mx-0 bg-white rounded shadow-lg">
          <a href="./" class="-intro-x md:hidden flex items-center pt-5 w-48 m-auto mb-5">
            <img alt="TeamSource" src="{{asset('images/teamsource-logo.png')}}">
          </a>
          <div class="p-4 text-center">
            <span class="text-9xl text-green-500"><i class="mdi mdi-check-circle-outline"></i></span>
            <p class="text-2xl md:text-4xl my-4 md:my-0 font-bold text-green-600">Mail Sent</p>
            <p class="my-4"> Please check your email inbox or spam to retrieve your new password.</p>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection

@section('action-scripts')
  <script>
    setTimeout(() => {
      window.location = "/login";
    }, 5000);
  </script>
@endsection