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
        <a href="?category_id= {{ $article->category_id }}" class="font-bold text-red-500">{{ $article->category->name }}</a>
        @endif
        <h3 class="font-extrabold text-xl sm:text-2xl md:text-3xl lg:text-4xl mt-2"><a href="{{ route('home.article.show',$article->id) }}">{{ $article->title }}</a></h3>
        <div class="mt-3 mb-3 text-sm text-gray-700 flex items-center">
            <img src="home/images/author.jpg" class="rounded-full w-7 h-7 inline mr-2">
            <a href="#" class="font-bold text-gray-600">{{ $article->author }}</a> 
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
        <a href="{{ route('home.article.show',$article->id) }}" class="mt-4 inline-block font-bold text-red-500">详情...</a> 
    </div>
</div>
<!-- Blog Post End-->
@endforeach
<!--Pagination Start-->

<div class="mt-2">
  {{ $articles->links() }}
</div>

<!--Pagination End-->
@endsection

