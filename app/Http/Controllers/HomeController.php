<?php

namespace App\Http\Controllers;

// use Faker\Provider\Image;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    
    function upload(Request $request)
    {
        // dd($request->all());
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();

        $imageName = time().'.'.$ext;

        if(!Storage::disk('public')->exists('images'))
        {
           Storage::disk('public')->makeDirectory('images');
        }

        $newImage = Image::make( $file )->resize(300, 200)->save($imageName);

        // dd($newImage);

        Storage::disk('public')->put('images/'.$imageName,  $newImage);

        // Storage::putFileAs('public/posts/', $newImage, $imageName);

        return $imageName;
        // dd( $ext );
    }
}
