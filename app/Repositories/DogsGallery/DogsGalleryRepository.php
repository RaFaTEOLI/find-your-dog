<?php

namespace App\Repositories\DogsGallery;

use App\Repositories\DogsGallery\DogsGalleryRepositoryInterface;
use App\Models\DogsGallery;

class DogsGalleryRepository implements DogsGalleryRepositoryInterface
{
    /*
        Get All Active DogGallery
    */
    public function all()
    {
        return DogsGallery::where("found_by", null)
            ->get()
            ->map->format();
    }

    /*
        Get An DogGallery By Id
    */
    public function findById($id)
    {
        return DogsGallery::where("id", $id)
            ->first()
            ->format();
    }

    /*
        Get An DogGallery By Id
    */
    public function findByLostDogId($id)
    {
        return DogsGallery::where("lost_dog_id", $id)
            ->get()
            ->map
            ->format();
    }

    public function update($id, $set)
    {
        $user = DogsGallery::where("id", $id)->first();

        $user->update($set);
    }

    public function delete($id)
    {
        DogsGallery::where("id", $id)->delete();

        return true;
    }
}
