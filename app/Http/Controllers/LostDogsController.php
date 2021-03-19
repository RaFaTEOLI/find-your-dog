<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LostDogs\LostDogsRepository;
use App\Services\LostDog\CreateLostDogService;
use App\Http\Requests\LostDogs\LostDogsRequest;
use App\Repositories\User\UserRepository;
use App\Repositories\DogsGallery\DogsGalleryRepository;
use App\Services\Photo\StorePhotosService;
use App\Traits\ReturnHandler;
use Exception;

class LostDogsController extends Controller
{
    use ReturnHandler;
    private $lostDogsRepository;
    private $userRepository;
    private $dogsGalleryRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->lostDogsRepository = new LostDogsRepository();
        $this->userRepository = new UserRepository();
        $this->dogsGalleryRepository = new DogsGalleryRepository();
    }

    public function index(Request $request)
    {

        $lostDogs = $this->lostDogsRepository->all();

        return $this->loaded($request, ["lostDogs" => $lostDogs], 200, "dogs/lost-dogs");
    }

    public function store(LostDogsRequest $request)
    {
        try {
            $input = $request->all();

            $createLostDogService = new CreateLostDogService();
            $lostDogId = $createLostDogService->execute($input);

            $storePhotosService = new StorePhotosService();
            $storePhotosService->execute($lostDogId->id, $request);

            return $this->success($request, "lost-dogs");
        } catch (Exception $e) {
            dd($e);
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function show($id, Request $request)
    {
        $lostDog = $this->lostDogsRepository->findById($id);
        $users = $this->userRepository->all();

        return $this->loaded($request, ["lostDog" => $lostDog, "users" => $users], 200, "dogs/lost-dog");
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->all();

            if (isset($input["found_by"]) && isset($input["found_at"])) {
                return (new FindDogController())->store($id, $request);
            }

            $input = $request->only(["name", "email"]);
            $this->lostDogsRepository->update($id, $input);

            return $this->success($request, "lost-dogs");
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
