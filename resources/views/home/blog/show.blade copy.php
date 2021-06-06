@extends('home.layouts.master')

@section('content')
 <!-- Blog Post Start-->
 <article class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
    @if(isset($carticle->category)&&$article->category->name)
    <a href="#" class="font-bold text-red-500">{{ $article->category->name }}</a>
    @endif
    <h1 class="font-black text-xl sm:text-2xl md:text-3xl lg:text-5xl mt-2">{{ $article->title }}</h1>
    <div class="mt-4 mb-3 text-sm text-gray-700 flex items-center">
        <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline mr-2">
        <a href="#" class="font-bold text-gray-600">{{ $article->author }}</a> 
        <span class="ml-3">
            <svg class="inline mr-1 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            {{ $article->created_at }}
        </span>
    </div>
    <div class="prose prose-sm sm:prose lg:prose-lg mx-auto mt-4 md:mt-6">
        {{  }}
        <p>
            Lorem ipsum <strong>dolor sit</strong> dolor sit amet, consectetur <strong><i>adipiscing</i></strong> elit. Quisque efficitur orci at ipsum pretium hendrerit. Duis <a href="#">pulvinar est</a> nibh, et commodo erat vulputate id. Quisque non lacus vitae mauris laoreet molestie. Quisque viverra nulla at fringilla mollis. Curabitur fermentum justo at feugiat aliquam. Etiam nec est sit amet ante vehicula pretium eget pretium magna. Integer a accumsan diam. Curabitur gravida eros sed leo maximus tincidunt. Aenean a leo eget felis pulvinar suscipit vel sed eros. Curabitur turpis ante, tincidunt eu vestibulum vitae, imperdiet et magna. Proin non nisi a lectus varius ultricies.
        </p>
        <img src="{{ asset('home/images/content-img.jpg') }}">
        <p>
        Nulla facilisi. <strong>Vivamus</strong> sed libero metus. <a href="#">Etiam ac quam</a> nibh. Donec et augue non orci blandit tempus. Sed sed luctus nibh. Cras vitae mattis est, id dignissim orci. Nullam quis justo nibh. Integer non urna at arcu rutrum ullamcorper eget eu dolor. Vivamus non lobortis nunc. Curabitur ut ante vitae sapien convallis dictum. Duis pretium quis diam dapibus facilisis. Suspendisse ornare ante eget quam pharetra sodales. Quisque elit sapien, rhoncus et enim ac, gravida placerat lectus. Fusce in ultrices ligula. Sed id cursus purus, id maximus massa.
        </p>
        <h1>This is sample H1 heading</h1>
        <h2>This is sample H2 heading</h2>
        <h3>This is sample H3 heading</h3>
        <h4>This is sample H4 heading</h4>
        <p>  
            Nam lobortis odio et ligula porttitor, sit amet mollis dui rhoncus. Proin porttitor quam risus, non viverra nulla porttitor at. Aliquam ultrices purus libero, vel varius nunc congue id. Nunc malesuada purus ut ipsum cursus maximus. In ultrices velit non urna dapibus, ac lobortis enim pulvinar. Mauris eget posuere massa. Aliquam pellentesque imperdiet leo, sit amet vehicula libero. Integer ut libero sodales, imperdiet purus nec, tincidunt sem. Sed mollis erat massa. Proin rhoncus a purus ut suscipit. Phasellus vitae enim sed odio euismod efficitur. Fusce diam orci, maximus in diam eget, imperdiet luctus est. Vestibulum dapibus neque tincidunt metus hendrerit varius. Aenean sit amet auctor magna, nec bibendum nibh. Sed posuere massa in nisl cursus accumsan.
        </p>
        <h3>Ordered Lists</h3>
        <ol>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
        </ol>
        <h3>Unordered Lists</h3>
        <ul>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
            <li>Quisque efficitur orci at ipsum pretium hendrerit.</li>
        </ul>
        <h3> Quotes</h3>
        <blockquote>
            Aliquam pellentesque imperdiet leo, sit amet vehicula libero. Integer ut libero sodales, imperdiet purus nec, tincidunt sem. Sed mollis erat massa. Proin rhoncus a purus ut suscipit.
        </blockquote>
        <h3>More Content</h3>
        <p>
            Nulla facilisi. Vivamus sed libero metus. Etiam ac quam nibh. Donec et augue non orci blandit tempus. Sed sed luctus nibh. Cras vitae mattis est, id dignissim orci. Nullam quis justo nibh. Integer non urna at arcu rutrum ullamcorper eget eu dolor. Vivamus non lobortis nunc. Curabitur ut ante vitae sapien convallis dictum. Duis pretium quis diam dapibus facilisis. Suspendisse ornare ante eget quam pharetra sodales. Quisque elit sapien, rhoncus et enim ac, gravida placerat lectus. Fusce in ultrices ligula. Sed id cursus purus, id maximus massa.
        </p>
    </div>
</article>
<!-- Blog Post End-->
<!-- Post Navigation Start-->
<div class="grid grid-cols-12 gap-0 mt-4 md:mt-5">
    <div class="col-span-6 text-right pr-4">
        <a href="#" class="font-bold text-gray-700 hover:text-red-500 text-base md:text-lg"><img class="inline" src="{{ asset('home/images/left.svg') }}"> Previous Post</a>
    </div>
    <div class="col-span-6 text-left pl-4">
        <a href="#" class="font-bold text-gray-700 hover:text-red-500 text-base md:text-lg">Next Post <img class="inline" src="{{ asset('home/images/right.svg') }}"></a>
    </div>
</div>
<!-- Post Navigation End-->
@endsection