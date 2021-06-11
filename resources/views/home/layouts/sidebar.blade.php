<aside id="sidebar" class="hidden md:block bg-gray-900 h-full px-10">
    <a href="#" id="close-menu" class="inline-block md:hidden" onclick="closeSidebar()">
        <svg class="absolute top-5 right-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </a>
    <div class="sticky h-screen top-0 py-20 flex flex-wrap content-center">
        <div class="w-full">
            <a href="{{ route('home.index') }}">
                <!--<img class="w-32 md:w-36" src="home/images/logo-white.png">-->
                <h1>
                    <span class="text-4xl text-blue-300 font-mono font-bold border border-1 border-blue-300 rounded inline-block p-1">日思录</span>
                    <p class="text-yellow-300 inline-block text-sm">一只妄图语冰的夏虫</p>
                </h1>
            </a>
        </div>
        <div>
            <ul class="w-full mt-20">
                <li class="mb-5"><a href="{{ route('home.index') }}" class="text-gray-300 hover:text-white">主页</a></li>
                <li class="mb-5"><a href="#" class="text-gray-300 hover:text-white">分类</a></li>
                <li class="mb-5"><a href="{{ route('home.article.index') }}" class="text-gray-300 hover:text-white">热门</a></li>
                <li class="mb-5"><a href="{{ route('home.about.index') }}" class="text-gray-300 hover:text-white">关于</a></li>
                <li><a href="{{ route('home.message.index') }}" class="text-gray-300 hover:text-white">留言</a></li>
            </ul>
        </div>
        <div class="w-full mt-20">
            <ul>
                <li class="inline-block mr-2">
                    <a href="//www.twitter.com/#"><img class="w-5" src="{{ asset('home/images/twitter.svg') }}"></a>
                </li>
                <li class="inline-block mr-2">
                    <a href="//www.youtube.com"><img class="w-5" src="{{ asset('home/images/youtube.svg') }}"></a>
                </li>
                <li class="inline-block mr-2">
                    <a href="//www.likedin.com"><img class="w-5" src="{{ asset('home/images/linkedin.svg') }}"></a>
                </li>
                <li class="inline-block">
                    <a href="//www.facebook.com"><img class="w-5" src="{{ asset('home/images/facebook.svg') }}"></a>
                </li>
            </ul>
            <p class="text-gray-300 mt-5">&copy 2021 <a href="//www.tubring.cn">Tubring Studio</a>. 版权所有</p>
        </div>
    </div>
</aside>

<script>

</script>