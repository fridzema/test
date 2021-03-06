<?php

namespace App\Http\Controllers;

use App\Photo;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();

        return response()->view('frontend.photos.index', ['photos' => $photos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($photo_id)
    {
        $photo = Photo::find($photo_id);

        return response()->view('frontend.photos.show', ['photo' =>  $photo]);
    }
}
