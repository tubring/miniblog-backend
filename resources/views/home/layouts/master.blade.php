<!--
Template Name: Laung
Version: 1.0.0
Theme URL: https://angrystudio.com/themes/laung-free-tailwind-css-personal-blog-template
Author: AngryStudio
License: AngryStudio License 
License URI: https://angrystudio.com/license/
-->
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="robots" content="noindex,nofollow"> 
      <title>{{ $site_info['app.name'] }}</title>
      <link href="{{ asset('css/tailwind/tailwind.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/tailwind/typography.min.css') }}"/>
   </head>
   <body class="bg-gray-50 font-sans">
      <nav class="md:hidden shadow bg-white px-4 py-4">
         <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">
                <a href="{{ route('home.index') }}" class="inline-block align-middle">
                    <!--<img class="w-28" src="home/images/logo.png">-->
                    <h1>
                        <span class="text-white text-4xl text-blue-600 font-mono font-bold border border-1 border-blue-600 rounded p-1">日思录</span>
                        <p class="text-yellow-500 inline-block text-sm italic">{{ $site_info['app.slogan'] }}</p>

                    </h1>
                </a>
            </div>
            <div class="col-span-6">
               <div class="text-right">
                  <a class="inline-block align-middle" href="#" onclick="openSidebar()"><img class="w-6" src="{{ asset('home/images/menu.svg') }}"></a>
               </div>
            </div>
         </div>
      </nav>
      <div class="xl:container mx-auto">
         <div class="grid grid-cols-12 gap-0">
            <div class="col-span-12 md:col-span-4 lg:col-span-3">
               @include('home.layouts.sidebar')
            </div>
            <div class="col-span-12 md:col-span-8 lg:col-span-9">
               @yield('navbar')
               <main class="p-4 md:p-5">
                 @yield('content')
               </main>
            </div>
         </div>
      </div>
      <script src="{{ asset('home/js/core.js') }}"></script>
      @yield('scripts')
   </body>
</html>