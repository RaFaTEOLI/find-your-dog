<?php

namespace App\Repositories\FoundDogs;

use App\Models\FoundDogs;
use App\Repositories\FoundDogs\FoundDogsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\LostDogs;

class FoundDogsRepository implements FoundDogsRepositoryInterface
{
    /*
        Get All Active Found Dogs
    */
    public function all()
    {
        return LostDogs::where("found_by", Auth::user()->id)
            ->get()
            ->map->format();
    }

    /*
        Get All Active Dogs
    */
    public function allMyDogs()
    {
        return LostDogs::where("posted_by", Auth::user()->id)
            ->get()
            ->map->format();
    }

    /*
        Get An Found Dog By Id
    */
    public function findById($id)
    {
        return FoundDogs::where("id", $id)
            ->first();
    }

    /*
        Get An Found Dog By Dog Id
    */
    public function findByDogId($id)
    {
        return FoundDogs::where("lost_dog_id", $id)
            ->first();
    }

    public function update($id, $set)
    {
        $user = FoundDogs::where("id", $id)->first();

        $user->update($set);
    }

    public function delete($id)
    {
        FoundDogs::where("id", $id)->delete();

        return true;
    }
}
