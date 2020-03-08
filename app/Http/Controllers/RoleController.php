<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{

    private $roleRepository;

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function get() {

        $response = $this->roleRepository->get();

        return response()->json($response);

    }

    public function insert(RoleRequest $request) {

        $response = $this->roleRepository->insert($request);

        return response()->json($response);
    }

    public function update(Request $request) {
        $response = $this->roleRepository->update($request);

        return response()->json($response);
    }

    public function delete(Request $request) {

        $response = $this->roleRepository->delete($request);

        return response()->json($response);
    }

}
