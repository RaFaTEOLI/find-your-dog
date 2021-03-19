<?php

namespace App\Repositories\DogsGallery;

interface DogsGalleryRepositoryInterface
{
    public function all();
    public function findById($id);
    public function findByLostDogId($id);
    public function update($id, $set);
    public function delete($id);
}
