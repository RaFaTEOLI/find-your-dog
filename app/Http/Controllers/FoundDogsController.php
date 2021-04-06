<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LostDogs\LostDogsRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\DogsGallery\DogsGalleryRepository;
use App\Repositories\FoundDogs\FoundDogsRepository;
use App\Traits\ReturnHandler;
use App\Services\Photo\StorePhotoService;
use Exception;

class FoundDogsController extends Controller
{
    use ReturnHandler;
    private $lostDogsRepository;
    private $userRepository;
    private $dogsGalleryRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->lostDogsRepository = new LostDogsRepository();
        $this->foundDogsRepository = new FoundDogsRepository();
        $this->userRepository = new UserRepository();
        $this->dogsGalleryRepository = new DogsGalleryRepository();
    }

    public function index(Request $request)
    {

        $foundDogs = $this->foundDogsRepository->all();

        return $this->loaded($request, ["foundDogs" => $foundDogs], 200, "dogs/found-dogs");
    }

    public function show($id, Request $request)
    {
        $foundDog = $this->lostDogsRepository->findById($id);
        $found = $this->foundDogsRepository->findByDogId($id);
        $users = $this->userRepository->all();

        return $this->loaded($request, ["foundDog" => $foundDog, "users" => $users, "found" => $found], 200, "dogs/found-dog");
    }

    public function update($id, Request $request)
    {
        try {
            $storePhotoService = new StorePhotoService();
            $photo = $storePhotoService->execute($request);

            $this->foundDogsRepository->update($id, ["photo_received" => $photo]);

            return $this->success($request, "my-dogs");
        } catch (Exception $e) {
            dd($e);
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $this->lostDogsRepository->delete($id);

            return $this->success($request, "lost-dogs");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
