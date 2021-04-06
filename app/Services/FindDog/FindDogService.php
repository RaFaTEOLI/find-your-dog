<?php

namespace App\Services\FindDog;

use App\Models\FoundDogs;
use App\Notifications\DogFound;
use App\Repositories\LostDogs\LostDogsRepository;
use App\Models\User;
use Exception;

class FindDogService
{
    public function execute($id, array $request)
    {
        try {
            $lostDogRepository = new LostDogsRepository();

            $lostDog = $lostDogRepository->findById($id);

            $lostDogRepository->update($id, $request);

            $user = User::find($lostDog->posted_by->id);

            FoundDogs::create(["photo_found" => $request["photo_found"], "lost_dog_id" => $id]);

            $user->notify(new DogFound($user, $lostDog));

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
