<!DOCTYPE html>
<html lang="en" class="@yield('form-screen-class')">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $pageTitle }}</title>
  @livewireStyles
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Toaster -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <!-- JQUERY -->
  <script defer src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Toastr -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Tailwind is included -->
  <link rel="stylesheet" href="{{asset('css/main.css')}}">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Favicon.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Favicon.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="TeamSend - Email Marketing SaaS Application">

  {{-- <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="TeamSend - Email Marketing SaaS Application">
  <meta property="og:description" content="TeamSend - Email Marketing SaaS Application">
  <meta property="og:image" content="https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Logo.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="TeamSend - Email Marketing SaaS Application">
  <meta property="twitter:description" content="TeamSend - Email Marketing SaaS Application">
  <meta property="twitter:image:src" content="https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Logo.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960"> --}}

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script> -->
  <!-- <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-130795909-1');
  </script> -->

</head>
<body>
  @php
    $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)))
  @endphp
    <div id="app">
      <!-- Admin Navbar -->
      <nav id="navbar-main" class="navbar is-fixed-top">
        <div class="navbar-brand">
          <a class="navbar-item mobile-aside-button">
            <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
          </a>
          <!-- <div class="navbar-item">
            <div class="control"><input placeholder="Search everywhere..." class="input"></div>
          </div> -->
        </div>
        <div class="navbar-brand is-right">
          <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
            <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
          </a>
        </div>
        <div class="navbar-menu" id="navbar-menu">
          <div class="navbar-end">
            <div class="navbar-item dropdown has-divider">
              <a class="navbar-link relative">
                <span class="hidden absolute top-2 right-0 inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                <span class="icon"><i class="mdi mdi-bell"></i></span>
                <span>Notification</span>
                <span class="icon">
                  <i class="mdi mdi-chevron-down"></i>
                </span>
              </a>
              <div class="navbar-dropdown notifications">
                <a href="profile.html" class="navbar-item flex items-center gap-4">
                  <i class="mdi mdi-email-outline mdi-24px"></i>
                  <div>
                    <span class="font-medium md:font-sm">New Email Campaign Created</span>
                    <div class="w-full truncate text-gray-600">28 minutes ago</div>
                  </div>
                </a>
                <a href="profile.html" class="navbar-item flex items-center gap-4">
                  <i class="mdi mdi-bell-outline mdi-24px"></i>
                  <div>
                    <span class="font-medium">Your limit has been upgraded</span>
                    <div class="w-full truncate text-gray-600">28 minutes ago</div>
                  </div>
                </a>
                <hr>
                <a href="#" class="navbar-link text-center">see all notifications</a>
              </div>
            </div>
            <div class="navbar-item dropdown has-divider has-user-avatar">
              <a class="navbar-link">
                <div class="user-avatar">
                  <img src="{{asset('images/avatar.svg')}}" alt="{{ $user->first_name }}" class="rounded-full">
                </div>
                <div class="is-user-name"><span>{{ $user->first_name . " " . $user->last_name }}</span></div>
                <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
              </a>
              <div class="navbar-dropdown">
                <span class="navbar-item gap-1">
                  <span class="text-green-500">Account Type:</span>Customer
                </span>
                <a href="profile.html" class="navbar-item --set-active-profile-html">
                  <span class="icon"><i class="mdi mdi-account"></i></span>
                  <span>Profile</span>
                </a>
                <a href="change-password.html" class="navbar-item --set-change-password-html">
                  <span class="icon"><i class="mdi mdi-lock"></i></span>
                  <span>Change Password</span>
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item" href="{{ route('logout') }}">
                  <span class="icon"><i class="mdi mdi-logout"></i></span>
                  <span>Log Out</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>  
      <!-- End Admin Navbar -->
      <!-- Admin Sidebar -->
      @include('partials._admin-sidebar')     
      <!-- End Admin Sidebar -->

      <!-- Admin Titlebar -->
      <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
          <ul>
            <li>Admin</li>
            <li>{{ $pageLinkTitle }}</li>
          </ul>
        </div>
      </section>
      <!-- End Admin Titlebar -->

      <!-- Admin Herobar -->
      <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
          <h1 class="title">
            {{ $pageHeroTitle . " - " . $organisation->name }}
          </h1>
        </div>
      </section>      
      <!-- End Admin Herobar -->

      <!-- Main -->
      @yield('content')
      <!-- End Main -->

      <!-- Admin Footer -->
      <footer class="footer">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div class="flex items-center justify-start space-x-3">
            <div>
              © 2023, TeamSend - TeamSource Technologies
            </div>
          </div>
          <a href="https://teamsource.net" style="width: 100px;">
            <img src="{{asset('images/teamsource-logo.png')}}">
          </a>
        </div>
      </footer>
      <!-- End Admin Footer -->

      <!-- Necessary Modals -->
      @yield('modals')
      <!-- Necessary Modals -->
    </div>
    @livewireScripts
    <!-- Global Admin Scripts -->
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <!-- End Global Admin Herobar -->
    <!-- Page Specific Scripts -->
    @yield('page-script')
    <!-- End Page Specific Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css">
</body>
</html>