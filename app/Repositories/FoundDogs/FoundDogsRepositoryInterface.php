<?php

namespace App\Repositories\FoundDogs;

interface FoundDogsRepositoryInterface
{
    public function all();
    public function allMyDogs();
    public function findById($id);
    public function findByDogId($id);
    public function update($id, $set);
    public function delete($id);
}
