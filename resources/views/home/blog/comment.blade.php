@extends('home.layouts.master')

@section('content')
    <div class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
        @include('home.layouts._alert')

        <h1 class="w-full border-b boder-dotted border-gray-300 pb-5 my-5 font-bold text-gray-300"><span>文章标题:</span><a class="ml-5 text-gray-500 hover:text-blue-500" href="{{ route('home.article.show',$article) }}">{{ $article->title }}</a></h1>

        <h5 class="text-center text-blue-500 font-bold">最新评论</h5>
        

        @foreach($comments as $comment)
        <div class="border border-blue-500 mt-5">
            <div class="p-5">
                <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline-block mr-2">
                @if($comment->anonymous)
                <a class="text-gray-300">匿名用户</a>
                @else
                <a class="text-gray-300">{{ $comment->user()->name }}</a>
                @endif

                <span class="ml-3">
                    <svg class="inline mr-1 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ $comment->created_at }}
                </span>
            </div>
            <div class="px-10 py-5">
               {!! $comment->content !!}
            </div>
        </div>

        @endforeach


        <div class="border border-blue-500 mt-5">
            <div class="p-5">
                <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline-block mr-2">
                <a href="#" class="text-gray-600">John Doe</a> 
            </div>
            <div class="w-4/5 px-10 py-5">
                Some Test
                Some Test
                Some Test
                Some Test
            </div>
        </div>

        <div class="border border-blue-500 mt-5">
            <div class="p-5">
                <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline-block mr-2">
                <a href="#" class="text-gray-600">John Doe</a>
                <span class="ml-3">
                    <svg class="inline mr-1 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    2021-06-05
                </span>
            </div>
            <div class="px-10 py-5">
               <p> Some Test</p>
               <p> Some Test</p>
               <p> Some Test</p>
               <p> Some Test</p>
               <p> Some Test</p>
            </div>
        </div>


        <div class="border-b border-gray-300 pb-5 my-5"></div>
        
        <form id="message-form" action="{{ route('home.message.store') }}" method="post">

            @csrf

            <div class="flex align-middle mt-2">
                <label for="content" class="w-1/5 mr-5">跟帖评论</label>
                <textarea name="content" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-3/5" rows="10" placeholder="评论">{{old('content')}}</textarea>
            </div>

            <div class="flex align-middle mt-2">
                <label for="captcha" class="w-1/5 mr-5">验证码</label>
                <input name="captcha" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-1/5" /> 
                <img src="{{captcha_src()}}" alt="" class="ml-5" onclick="this.src=this.src+'?'+Math.random()">
            </div>
            
            <div class="w-full mt-10 text-right">
                <button class="bg-gray-500 text-white px-6 py-2 rounded mr-10">重置</button>
                <button class="bg-blue-500 text-white px-6 py-2 rounded mr-10" onclick="messageSubmit()">提交</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')

<script>

    function messageSubmit(){
        let messageForm = document.querySelector('#message-form');
        messageForm.submit();
    }

</script>
@endsection