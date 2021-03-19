<?php

namespace App\Http\Controllers;
use App\Services\FindDog\FindDogService;
use App\Traits\ReturnHandler;
use Exception;
use Illuminate\Http\Request;

class FindDogController extends Controller
{
    use ReturnHandler;
    public function store($id, Request $request)
    {
        try {
            $input = $request->only(["found_by", "found_at"]);

            $findDogService = new FindDogService();
            $findDogService->execute($id, $input);

            return $this->success($request, "lost-dogs");
        } catch (Exception $e) {
            dd($e);
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
