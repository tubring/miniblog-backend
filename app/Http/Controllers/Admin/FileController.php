<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $folder = $request->type;
        $directories = ['avatars','articles','banners','category'];
        if(in_array($folder,$directories)){
            $path = $request->file('file')->store($folder);
            $data = [
                'path' => $path,
                'image_url' => Storage::url($path)
            ];
            return response()->json($path,201);
            // return response()->json($data,201);
        }

        return response()->json(null,204);
        
        
    }

    public function delete(Request $request){

        $file = $request->file;

        Storage::delete($file);
    }
}
