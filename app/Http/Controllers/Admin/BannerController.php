<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return response()->json($banners,200);
    }

    public function show(Banner $banner){
        return response()->json($banner,200);
    }

    public function store(Request $request)
    {
        $banner = Banner::create($request->only(['name','image','copy','link','sort_order','active']));
        return response()->json($banner,201);
    }

    public function update(Request $request, Banner $banner)
    {
        $banner->update($request->only(['name','image','copy','link','sort_order','active']));
        return response()->json($banner,201);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return response()->json(null,204);
    }

    public function active(Banner $banner){
        $banner->active = !($banner->active);
        $banner->save();
        return response()->json(null,204);
    }
}
