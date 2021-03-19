<?php

namespace App\Services\Photo;

use App\Models\DogsGallery;
use Carbon\Carbon;
use Exception;

class StorePhotosService
{
    public function execute($lostDogId, $request)
    {
        try {
            if ($request->hasFile('photos')) {
                $images = $request->file('photos');

                foreach($images as $image) {
                    $name = Carbon::now()->timestamp . $image->getClientOriginalName();
                    $path = $image->storeAs('uploads', $name);

                    DogsGallery::create([
                        'photo_url' => env("APP_URL").'/storage/'.$path,
                        'lost_dog_id' => $lostDogId
                    ]);
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
