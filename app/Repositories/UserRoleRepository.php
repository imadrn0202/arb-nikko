<?php

namespace App\Repositories;

use App\Repositories\Contract\RepositoryInterface;
use App\User;
use App\UserRole;


class UserRoleRepository implements RepositoryInterface{

    public function get() {

        $result = User::with('roles')->get();
        return $result;
    }

    public function insert($request){

        $req = $request->all();
        $req['password'] = bcrypt('123456');

        if ($user = User::create($req)) {
                        
            $result = UserRole::create([
                'role_id' => $request->role,
                'user_id' => $user->id

            ]);
        }
        
        return $result;

    }

    public function update($request) {

        User::where('id', $request->id)->update($request->except(['roles', 'role']));

        $result = UserRole::where('user_id', $request->id)->update([
            'role_id' => $request->role,
        ]);

        return $result;

    }

    public function delete($request) {

        $result = User::where('id', $request->id)->delete();

        return $result;

    }
}