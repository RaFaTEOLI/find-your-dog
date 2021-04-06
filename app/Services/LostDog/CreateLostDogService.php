<?php

namespace App\Services\LostDog;

use App\Models\LostDogs;
use Exception;

class CreateLostDogService
{
    public function execute(array $request)
    {
        try {
            // Saves the Lost Dog
            $request["reward"] = str_replace(",", ".", $request["reward"]);
            $request["reward"] = str_replace("R$ ", "", $request["reward"]);

            $lostDog = LostDogs::create($request);

            return $lostDog;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
