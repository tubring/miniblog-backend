@extends('home.layouts.master')

@section('content')
    <div class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
        @include('home.layouts._alert')

        <div class="w-full border-b boder-dotted border-gray-300 pb-5 my-5 text-xl font-bold">留言板</div>

        <form id="message-form" action="{{ route('home.message.store') }}" method="post">

            @csrf

            <div class="flex align-middle mt-2">
                <label for="topic" class="w-1/5 mr-5">主题</label>
                <input type="text" name="topic" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-3/5" placeholder="主题" value="{{old('topic')}}" />
            </div>

            <div class="flex align-middle mt-2">
                <label for="name" class="w-1/5 mr-5">昵称</label>
                <input type="text" name="name" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-1/5" placeholder="名字或者昵称" value="{{old('name')}}" />
            </div>

            <div class="flex align-middle mt-2">
                <label for="contact" class="w-1/5 mr-5">联系方式</label>
                <input type="text" name="contact" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-1/5" placeholder="邮箱、电话等" value="{{old('contact')}}" />
            </div>

            <div class="flex align-middle mt-2">
                <label for="content" class="w-1/5 mr-5">内容</label>
                <textarea name="content" class="px-2 py-1 border border-blue-500 rounded-sm focus:border-gray-500 w-3/5" rows="10" placeholder="留言内容">{{old('content')}}</textarea>
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