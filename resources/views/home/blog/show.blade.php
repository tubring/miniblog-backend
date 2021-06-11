@extends('home.layouts.master')

@section('content')
 <!-- Blog Post Start-->
 <article class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
    @if( isset($article->category) && $article->category->name)
    <a href="#" class="font-bold text-red-500">{{ $article->category->name }}</a>
    @endif
    <h1 class="font-black text-xl sm:text-2xl md:text-3xl lg:text-5xl mt-2">{{ $article->title }}</h1>
    <div class="mt-4 mb-3 text-sm text-gray-700 flex items-center">
        <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline mr-2">
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
    <div class="prose prose-sm sm:prose lg:prose-lg mx-auto mt-4 md:mt-6">
        {!! $article->content !!}
        
    </div>

    <div class="mt-10 flex justify-around">
        <a class="flex hover:text-blue-500" href="{{ route('home.article.comments',$article->id) }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <span class="hidden sm:block ml-2">评论</span>
        </a>
        <a class="flex hover:text-blue-500" onclick="handleLike()" target="{{route('home.article.like',$article)}}" id="likeBtn" value="{{ $like }}">
            <input type="hidden" name="like" value="{{ $like }}">
            @csrf
            @if($like)
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" stroke="black" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
            @else
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
            @endif
            <span class="hidden sm:block ml-2">点赞</span>
        </a>
        <!-- <a class="flex">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path></svg>
            <span class="hidden sm:block ml-2">差评</span>
        </a> -->
        <a class="flex hover:text-blue-500" onclick="alert('暂不支持此功能!')">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            <span class="hidden sm:block ml-2">分享</span>
        </a>
    </div>

</article>
<!-- Blog Post End-->

<!--Comment -->


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

@section('scripts')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    function handleLike(){
        let likeBtn = document.querySelector("#likeBtn");
        let url = likeBtn.target;
        let value = likeBtn.getAttribute("value");
        if(value=="false" || value =="0"){
            value = false;
        }

        let token = document.querySelector("input[name=_token]").value;

        let data = {
            like:!value,
            _token: token,
        }

        let likeSvg = document.querySelector("#likeBtn>svg");
        
        axios.post(url,data).then((res)=>{
            console.log('res:',res);
            if(res.status == 200){
                if(res.data.like == true){
                    likeSvg.classList.add('text-yellow-500')
                    likeSvg.setAttribute("fill","currentColor");
                    likeSvg.setAttribute("stroke","black");
                    
                }else{
                    likeSvg.classList.remove('text-yellow-500')
                    likeSvg.setAttribute("fill","none");
                    likeSvg.setAttribute("stroke","currentColor");
                }

                likeBtn.setAttribute("value",res.data.like);
            }
        }).catch((error)=>{
            if(error.response.status==403){
                //提示用户登录
            }
        })
    }

</script>
@endsection