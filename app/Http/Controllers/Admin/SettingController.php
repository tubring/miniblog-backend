<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\UserAdmin;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getConfig();
        return response()->json($settings,200);
    }

    public function save(Request $request)
    {
        $setting = Setting::where('key',$request->key)->first();
        $setting->value = $request->value;
        $setting->save();

        return response()->json($setting,201);
    }
}
