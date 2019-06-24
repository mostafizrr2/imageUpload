<?php

namespace App\Http\Controllers;

// use Faker\Provider\Image;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Filters\DemoFilter;

class HomeController extends Controller
{
    
    function upload(Request $request)
    {
        // dd(public_path().'\img\watermark.png');
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();

        $imageName = time().'.'.$ext;

        if(!Storage::disk('public')->exists('images'))
        {
           Storage::disk('public')->makeDirectory('images');
        }

        $waterMark = Image::make(public_path().'\img\watermark.png')->resize(550,100); 

        $newImage = Image::make( $file )
        ->resize(500,200)
        // ->fit(500)
        ->save($imageName,80);

        // dd($newImage);

        Storage::disk('public')->put('images/'.$imageName,  $newImage);

        // Storage::putFileAs('public/posts/', $newImage, $imageName);

        return $imageName;
        // dd( $ext );
    }
}
