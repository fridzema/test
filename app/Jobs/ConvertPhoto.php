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
        $intervention_image = Image::make($this->photo_private_disk->path($this->photo->filepath));

        $sizes = ['200', '400', '600', '800', '1000'];

        foreach($sizes as $size){
          $intervention_image->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
          })->save(public_path('/photos/' . $this->photo->StoragePath . '/' . $size . '.jpg'));

          // $stream = $intervention_image->stream('jpg', 60);
          // $this->photo_private_disk->writeStream(sprintf('%s/%s', $this->photo->storage_path, $size . '.jpg'), $stream);
          // if (is_resource($stream)) {
          //   fclose($stream);
          // }

          unset($intervention_image);
          // unset($stream);
        }

        // $image->move($this->photo_private_disk->path($this->photo->FolderName), 'tiny_' . $this->photo->filename);
    }
}
