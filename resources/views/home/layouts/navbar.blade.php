<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-gradient-to-r from-gray-900 to-gray-700">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="sm:ml-6">
          <div class="flex space-x-4">
            <!-- Current: "bg-indigo-500 text-white", Default: "text-gray-300 hover:bg-gray-600 hover:text-white" -->
            <a href="?" class="text-gray-300 hover:bg-gray-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium nav-item" aria-current="page" id="nav-item-0">全部</a>

            @foreach($categories as $category)
            <a href="{{ '?category_id='.$category->id }}" class="text-gray-300 hover:bg-gray-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium nav-item" id="nav-item-{{ $category->id }}"> {{ $category->name }}</a>
            @endforeach

          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

        @if(auth()->user())
        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button>
          </div>

          <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
          </div>
        </div>
        @else
        <a class="bg-blue-500 text-white px-4 py-2 rounded-md" href="">用户登录</a>
        @endif
      </div>
    </div>
  </div>

  
</nav>

<script>


  //获取URL参数
  function getQuerys(){
    let queryString = location.search.substring(1)
    let params = queryString.split('&')
    let querys = {};
    params.forEach((item)=>{
      let items = item.split("=")
      if(items[1] != undefined){
        querys[items[0]] = items[1]
      }
    })
    return querys;
  }


  function getQuery(param){
    
    let querys = getQuerys()
    return querys[param]

  }

  function initNavbar(){
    let currentId = getQuery('category_id')?getQuery('category_id'):0
    let current = document.querySelector('#nav-item-'+currentId)

    //active : "bg-indigo-500 text-white px-3 py-2 rounded-md text-sm font-medium"
    //inactive : "text-gray-300 hover:bg-gray-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"

    current.classList.remove("text-gray-300","hover:bg-gray-600","hover:text-white")
    current.classList.add("bg-indigo-500","text-white")
  }

  window.onload = function (){

    initNavbar()
   
  }
 
</script>