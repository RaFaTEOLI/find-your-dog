<?php

namespace App\Services\Photo;

use Carbon\Carbon;
use Exception;

class StorePhotoService
{
    public function execute($request)
    {
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');

                $name = Carbon::now()->timestamp . $image->getClientOriginalName();
                $path = $image->storeAs('uploads', $name);

                return env("APP_URL").'/storage/'.$path;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
