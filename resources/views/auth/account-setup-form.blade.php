@extends('layouts.form')

@section('form-screen-class', 'form-screen')

@section('content')
<div class="container mx-auto">
    <section class="section">
        <div class="max-w-screen-md mx-auto my-10 sm:my-20">
          <a href="./" class="-intro-x flex items-center mx-auto pt-5 w-48 mb-5">
            <img alt="TeamSource" src="{{asset('images/teamsource-logo.png')}}">
          </a>
          <header class="text-center mb-8">
            <h1 class="font-bold text-2xl md:text-5xl text-green-600 mb-2">Tell Us About Yourself</h1>
            <p>This information would help us serve you better</p>
          </header>
          <livewire:account-setup-form />
        </div>
      </section>
  </div>
@endsection
  