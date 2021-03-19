<?php

namespace App\Repositories\LostDogs;

use App\Repositories\LostDogs\LostDogsRepositoryInterface;
use App\Models\LostDogs;

class LostDogsRepository implements LostDogsRepositoryInterface
{
    /*
        Get All Active Lost Dogs
    */
    public function all()
    {
        return LostDogs::where("found_by", null)
            ->get()
            ->map->format();
    }

    /*
        Get An LostDog By Id
    */
    public function findById($id)
    {
        return LostDogs::where("id", $id)
            ->first()
            ->format();
    }

    public function update($id, $set)
    {
        $user = LostDogs::where("id", $id)->first();

        $user->update($set);
    }

    public function delete($id)
    {
        LostDogs::where("id", $id)->delete();

        return true;
    }
}
