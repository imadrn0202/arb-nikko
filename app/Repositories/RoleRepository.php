<?php

namespace App\Repositories;

use App\Repositories\Contract\RepositoryInterface;
use Illuminate\Http\Request;
use App\Role;

class RoleRepository implements RepositoryInterface{

    public function get() {

        $result = Role::get();

        return $result;

    }

    public function insert($request) {

        $result = Role::create($request->all());

        return $result;
        
    }

    public function update($request) {

        $result = Role::where('id', $request->id)->update($request->all());

        return $result;

    }
    
    public function delete($request) {

        $result = Role::where('id', $request->id)->delete();

        return $result;
        
    }

}



