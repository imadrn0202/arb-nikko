<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;
use App\Repositories\UserRoleRepository;

class UserRoleController extends Controller
{

    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function get() {
        
        return response()->json($this->userRoleRepository->get());
    
    }

    public function insert(Request $request) {

        return response()->json($this->userRoleRepository->insert($request));
    }
    
    public function update(Request $request) {

        return response()->json($this->userRoleRepository->update($request));

    }

    public function delete(Request $request) {

        return response()->json($this->userRoleRepository->delete($request));

    }
}
