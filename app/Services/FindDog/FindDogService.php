<?php

namespace App\Services\FindDog;

use App\Notifications\DogFound;
use App\Repositories\LostDogs\LostDogsRepository;
use Illuminate\Support\Facades\Notification;
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

            $user->notify(new DogFound($user, $lostDog));

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
