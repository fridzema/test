<?php

namespace App\Http\Controllers;

use App\Photo;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();

        // $test = Photo::find(2);
        // dd(Storage::disk('photos_private')->exists($test->storage_path));
        // dd($this->photo_private_disk->get($test->storage_path));
        // $image = Image::make($this->photo_private_disk->path($test->storage_path));

        // dd($image->encode());
        // Storage::put($path, (string) $image->encode());

        return response()->view('admin.photos.index', ['photos' => $photos]);
    }

}
