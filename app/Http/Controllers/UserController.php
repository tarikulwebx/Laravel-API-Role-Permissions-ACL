<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function user()
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    // create user
    public function create(UserRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        if ($request->has('permissions')) {
            $user->givePermissionTo($request->permissions);
        }

        $userResource = new UserResource($user);

        return Helper::successResponse("User created successfully", $userResource);
    }

    // user list
    public function list()
    {
        $users = User::with(['roles:name', 'permissions:name'])->get();
        return response()->json($users, 200);
    }

    // user view
    public function view($id)
    {
        $user = User::findOrFail($id);

        $userResource = new UserResource($user);
        return Helper::successResponse("User found successfully", $userResource);
    }
}
