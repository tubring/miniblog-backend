@extends('home.layouts.master')

@section('navbar')
    @include('home.layouts.navbar',['show_category'=>true])
@endsection

@section('content')
@foreach($articles as $article)
 <!-- Blog Post Start-->
 <div class="bg-white rounded shadow mt-5">
    <div class="p-6 md:p-7 lg:p-9">
        @if(isset($article->category)&&$article->category->name)
        <a href="?category_id={{ $article->category_id }}" class="font-bold text-red-500">{{ $article->category->name }}</a>
        @endif
        <h3 class="font-extrabold text-xl sm:text-2xl md:text-3xl lg:text-4xl mt-2"><a href="{{ route('home.article.show',$article->id) }}">{{ $article->title }}</a></h3>
        <div class="mt-3 mb-3 text-sm text-gray-700 flex items-center">
            <img src="home/images/author.jpg" class="rounded-full w-7 h-7 inline mr-2">
            <a href="#" class="font-bold text-gray-600">{{ $article->author }}</a>
            <span class="ml-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ $article->views }}
            </span>
            <span class="ml-3">
                <svg class="inline mr-1 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                {{ $article->created_at }}
            </span>
        </div>
        <div class="text-base md:text-lg text-gray-500">
            <p class="leading-7 lg:leading-8">{{ $article->description }}</p>
        </div>
        <a href="{{ route('home.article.show',$article) }}" class="mt-4 inline-block font-bold text-red-500">Read more...</a>  
    </div>
</div>
<!-- Blog Post End-->
@endforeach

<!--Load More Button Start-->
<div class="text-center mt-4 md:mt-5">
    <a href="#" class="inline-block text-white bg-red-500 hover:bg-red-600 rounded font-bold py-3 px-7">Load more</a>
</div>
<!--Load More Button Start-->
@endsection

