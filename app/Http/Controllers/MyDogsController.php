<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LostDogs\LostDogsRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\DogsGallery\DogsGalleryRepository;
use App\Repositories\FoundDogs\FoundDogsRepository;
use App\Traits\ReturnHandler;
use Exception;

class MyDogsController extends Controller
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

        $foundDogs = $this->foundDogsRepository->allMyDogs();

        return $this->loaded($request, ["foundDogs" => $foundDogs], 200, "dogs/found-dogs");
    }
}
