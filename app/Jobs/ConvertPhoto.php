<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Photo;

use Storage;
use Image;

class ConvertPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $photo;
    public $photo_private_disk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
        $this->photo_private_disk = Storage::disk('photos_private');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $intervention_image = Image::make($this->photo_private_disk->path($this->photo->storage_path));

        $intervention_image->resize(100, 100, function ($constraint) {
          $constraint->aspectRatio();
        })->save();


        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        dd($intervention_image->encode());
    }
}
