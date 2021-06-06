@if(session()->has('success'))
<div class="bg-blue-100 text-blue-500 px-4 py-2">
    {{session('success')}}
</div>
@endif

@if(session()->has('error'))
<div class="bg-yellow-100 text-yellow-500 px-4 py-3">
    {{session('error')}}
</div>
@endif

@if($errors->any())
<div class="bg-red-100 text-red-500 px-4 py-3">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif