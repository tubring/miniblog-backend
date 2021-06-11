@extends('home.layouts.master')

@section('content')
    <div class="bg-white rounded shadow p-6 md:p-7 lg:p-9">

            <div class="w-full border-b boder-dotted border-gray-300 pb-5 my-5 text-xl font-bold">About Page</div>

            <div class="prose prose-sm sm:prose lg:prose-lg mx-auto mt-4 md:mt-6">
                {!! $site_info['app.about'] !!}
            </div>
        
    </div>

    </div>
@endsection