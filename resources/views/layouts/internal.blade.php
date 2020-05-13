<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Portifolio</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

</head>
<body>
<div id="app" class="flex flex-col lg:flex-row font-primary">
    <nav  class="w-full  lg:w-1/5 py-4 lg:min-w-xs mx-auto lg:mx-0 max-w-2xl lg:max-w-sm ">
          <div class="hidden lg:flex flex-col items-center py-8">
              <img src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}" alt="user profile image" class="rounded-full w-24 h-24 mb-2">
              <label for="" class="text-xl text-gray-800">{{ Auth::user()->name }}</label>
          </div>
        <div class="flex lg:flex-col justify-between px-4 lg:px-12">
            <a href="/admin/posts"  class="text-lg md:text-2xl   lg:mb-6 hover:text-gray-900 hover:font-bold  transition-sm {{ Route::currentRouteName()  === 'posts.index' ?  'text-gray-900  font-bold ' :  'text-gray-700 ' }}">Blog</a>
            <a href="/admin/media"  class="text-lg md:text-2xl   lg:mb-6 hover:text-gray-900 hover:font-bold transition-sm {{ Route::currentRouteName()  === 'media.index' ?  'text-gray-900  font-bold ' :  'text-gray-700 ' }}">Media</a>
            <a href="/admin/profile" class="text-lg md:text-2xl  lg:mb-6 hover:text-gray-900 hover:font-bold transition-sm {{ Route::currentRouteName()  === 'profile' ?  'text-gray-900  font-bold ' :  'text-gray-700 ' }}">Profile</a>
            <a  href="{{ route('logout') }}" class="text-lg md:text-2xl text-gray-700 md:mb-6 hover:text-gray-900 hover:font-bold transition-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>
    <main class=" bg-gray-100 min-h-screen  w-full lg:w-4/5 py-8">
        @yield('content')
    </main>
</div>
<script>
   
</script>

</body>
</html>
