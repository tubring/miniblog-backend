@extends('home.layouts.master')

@section('navbar')
    @include('home.layouts.navbar')
@endsection

@section('content')
@foreach($articles['data'] as $article)
 <!-- Blog Post Start-->
 <div class="bg-white rounded shadow mt-5">
    <div class="p-6 md:p-7 lg:p-9">
        @if(isset($article['category'])&&$article['category']['name'])
        <a href="#" class="font-bold text-red-500">{{ $article['category']['name'] }}</a>
        @endif
        <h3 class="font-extrabold text-xl sm:text-2xl md:text-3xl lg:text-4xl mt-2"><a href="#">{{ $article['title'] }}</a></h3>
        <div class="mt-3 mb-3 text-sm text-gray-700 flex items-center">
            <img src="home/images/author.jpg" class="rounded-full w-7 h-7 inline mr-2">
            <a href="#" class="font-bold text-gray-600">{{ $article['author'] }}</a> 
            <span class="ml-3">
                <svg class="inline mr-1 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                {{ $article['created_at'] }}
            </span>
        </div>
        <div class="text-base md:text-lg text-gray-500">
            <p class="leading-7 lg:leading-8">{{ $article['description'] }}</p>
        </div>
        <a href="{{ route('home.article.show',$article['id']) }}" class="mt-4 inline-block font-bold text-red-500">Read more...</a>  
    </div>
</div>
<!-- Blog Post End-->
@endforeach
<!--Pagination Start-->
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
  <div class="flex-1 flex justify-between sm:hidden">
    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Previous
    </a>
    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Next
    </a>
  </div>
  <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">
        Showing
        <span class="font-medium">{{ $articles['from'] }}</span>
        to
        <span class="font-medium">{{ $articles['to'] }}</span>
        of
        <span class="font-medium">{{ $articles['total'] }}</span>
        results
      </p>
    </div>
    <div>
      <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <a href="{{ $articles['prev_page_url'] }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Previous</span>
          <!-- Heroicon name: solid/chevron-left -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
        @foreach($articles['links'] as $link)
            @if(is_numeric($link['label']))
            @if($link['active'])
            <a href="{{ $link['url'] }}" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
               {{ $link['label'] }}
            </a>
            @else
            <a href="{{ $link['url'] }}" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
            {{ $link['label'] }}
            </a>

            @endif
            @endif
        @endforeach
       
        <a href="{{ $articles['next_page_url'] }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Next</span>
          <!-- Heroicon name: solid/chevron-right -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      </nav>
    </div>
  </div>
</div>

<!--Pagination End-->
@endsection

