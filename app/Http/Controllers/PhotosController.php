<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;

use Storage;
use App\Jobs\ConvertPhoto;

use Image;

class PhotosController extends Controller
{
    protected $photo_private_disk;

    public function __construct()
    {
      $this->photo_private_disk = Storage::disk('photos_private');
    }

    public function index()
    {
      $photos = Photo::select('id', 'thumbs', 'filename')
                ->orderBy('created_at', 'desc')
                ->paginate(9);

      return response()->json($photos);
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

            $uploaded_file = $this->streamFile($file->getRealPath(), $photo->filepath);

             $intervention_image = Image::make($file->getRealPath());

            foreach(config('system.thumbnails.sizes') as $size){
              $intervention_image->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
              });

              $this->photo_private_disk->put(sprintf('%s/%s', $photo->storage_path, $size . '.jpg'), (string) $intervention_image->encode('jpg'));
            }


            // ConvertPhoto::dispatch($photo);
            // IndexPhoto::dispatchNow($photo);
        }

        return response()->json($photo);
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
        $i++;

        $photo = Photo::find($value);
        $photo->order_index = $i;
        $photo->save();

      }

      return response()->json(['success' => true]);
    }
}
