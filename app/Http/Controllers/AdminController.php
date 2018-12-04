<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use App\Jobs\ConvertPhoto;

class AdminController extends Controller
{
    protected $photo_private_disk;

    public function __construct()
    {
      $this->photo_private_disk = Storage::disk('photos_private');
    }
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->file('file') as $file) {
            // $exif_data = [];
            // $iptc_data = [];
            // $intervention_image = Image::make($file->getRealPath());
            // $exif_data = ($intervention_image->exif()) ? json_encode($intervention_image->exif()) : null;
            // $iptc_data = ($intervention_image->iptc()) ? json_encode($intervention_image->iptc()) : null;

            $photo = new Photo();
            $photo->filename = $file->getClientOriginalName();
            $photo->extension = $file->getClientOriginalExtension();
            // $photo->exif = $exif_data;
            // $photo->iptc = $iptc_data;
            $photo->save();

            $uploaded_file = $this->streamFile($file->getRealPath(), $photo->storage_path);
            // IndexPhoto::dispatchNow($photo);
            ConvertPhoto::dispatchNow($photo);
        }

        return response()->json(['success' => true]);
    }

    public function streamFile($file_path, $destination_path)
    {
      $stream = fopen($file_path, 'r+');
      $this->photo_private_disk->writeStream($destination_path, $stream);
      if (is_resource($stream)) {
        fclose($stream);
      }

      return $this->photo_private_disk->path($destination_path);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();

        return redirect()->back();
    }


    public function reorder(Request $request){
    	// http://stackoverflow.com/questions/15633341/jquery-ui-sortable-then-write-order-into-a-database/15635201#15635201
	    $i = 0;
	    foreach ($request->input('sort_order') as $value) {
	      $photo = Photo::find($value);
	      $photo->order_index = $i;
	      $photo->save();

	      $i++;
	    }

	    return response()->json(['success' => true]);
    }
}
