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
        return response()->view('admin.photos.index');
    }

}
