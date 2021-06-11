@extends('home.layouts.master')

@section('content')
    <div class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
        @include('home.layouts._alert')

        <h1 class="w-full border-b boder-dotted border-gray-300 pb-5 my-5 font-bold text-gray-300"><span>文章标题:</span><a class="ml-5 text-gray-500 hover:text-blue-500" href="{{ route('home.article.show',$article) }}">{{ $article->title }}</a></h1>

        <h5 class="text-center text-blue-500 font-bold">最新评论</h5>
        
        @if($comments->isEmpty())
        <div class="border border-gray-500 text-gray-500 mt-5 text-center py-5">
            还没有任何评论!<br/>
            请不吝赐教, 留下您的宝贵意见!
        </div>
        @else
            @foreach($comments as $comment)
            <div class="border border-blue-500 mt-5">
                <div class="p-5">
                    <img src="{{ asset('home/images/author.jpg') }}" class="rounded-full w-7 h-7 inline-block mr-2">
                    @if($comment->anonymous)
                    <a class="text-gray-300">匿名用户</a>
                    @else
                    <a class="text-gray-300">{{ $comment->user->nickname }}</a>
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
                    <pre>{{ $comment->content }}</pre>
                    <div class="w-full mt-5 text-gray-500 text-sm text-right">
                        <span class="hover:text-blue-500" onclick="replyComment()">回复</span>
                        @if($comment->user_id == auth()->id())
                        <span class="hover:text-blue-500 ml-5" onclick="deleteComment(`{{ route('home.comment.delete',[$article->id,$comment->id]) }}`)">删除</span>
                        @endif
                        @if($comment->approved == 0 )
                        <span class="text-red-500 hover:text-blue-500 ml-5">审核中...</span>
                        @endif
                    </div>
                </div>
            </div>

            @endforeach
        @endif

        <div class="border-b border-gray-300 pb-5 my-5"></div>
        
        <form id="comment-form" action="{{ route('home.comment.store',$article->id) }}" method="post">

            @csrf

            <div class="md:flex align-middle mt-2">
                <label for="content" class="md:w-1/6 mr-5 block">跟帖评论</label>
                <textarea name="content" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 sm:w-1/2" rows="5" placeholder="在这里发表您的高见！">{{old('content')}}</textarea>
            </div>

            <div class="flex align-middle mt-2">
                <label for="content" class="md:w-1/6 mr-5 block">匿名发表</label>
                <input type="checkbox" name="anonymous" class="border border-blue-500 rounded" id="">
            </div>

            <div class="flex align-middle mt-2">
                <label for="captcha" class="md:w-1/6 mr-5 block">验证码</label>
                <input name="captcha" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-1/5" placeholder="验证码" /> 
                <img src="{{captcha_src()}}" alt="" class="ml-5" onclick="this.src=this.src+'?'+Math.random()" title="点击图片刷新验证码">
            </div>
            
            <div class="w-full mt-10 text-right">
                <button class="bg-gray-500 text-white px-6 py-2 rounded mr-10">重置</button>
                <button class="bg-blue-500 text-white px-6 py-2 rounded mr-10" onclick="commentSubmit()">提交</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')

<script src="{{ asset('js/axios.min.js') }}"></script>
<script>

    function commentSubmit(){
        let commentForm = document.querySelector('#comment-form');
        commentForm.submit();
    }

    function replyComment(){
        alert('功能完善中');
    }

    function deleteComment(url){
        axios.delete(url).then((res)=>{
            console.log(res);
            if(res.status==204){
                window.location.reload();
            }
        }).catch((error)=>{
            if(error.response.status==403){
                alert(error.response.data.message)
                // handle error
            }
        })
    }

</script>
@endsection