<?php

namespace App\Repositories\LostDogs;

interface LostDogsRepositoryInterface
{
    public function all();
    public function findById($id);
    public function update($id, $set);
    public function delete($id);
}
