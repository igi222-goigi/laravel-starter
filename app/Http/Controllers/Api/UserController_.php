<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleChangeRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Show Users List
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $id = $request->id;
        $type = $request->type;
        $perPage = $request->per_page ?? 10;

        switch ($type) {
            case "doctor":
                $users = User::where('type', $type)->get();
                return $this->successResponse($users);
                // break;
            case "patient":
                $users = User::where('type', $type)->get();
                return $this->successResponse($users);
                break;
            case "hospital":
                $users = User::where('type', $type)->get();
                return $this->successResponse($users);
                break;
            default:
                return $this->failedResponse();
        }


        // $perPage = $request->per_page ?? 10;
        // $users = User::where(['type' => $type])->paginate($perPage);

        // $users = User::paginate($perPage);

        // return $this->successResponse($users);
    }

    /**
     * Store User Information
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        echo 'hello';
    }

    /**
     * Show User Profile
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    // public function profile($id, Request $request): JsonResponse
    // {
    //     if ($user = User::find($id)) {
    //         return $this->successResponse($user);
    //     }

    //     return $this->failedResponse('Not found!');
    // }

    public function profile(Request $request): JsonResponse
    {
        $id = $request->id;
        $type = $request->type;
        if ($user = User::where(['id' => $id, 'type' => $type])->first()) {
            return $this->successResponse($user);
        }

        return $this->failedResponse('Not found!');
    }

    /**
     * Delete User
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($id, Request $request): JsonResponse
    {
        if ($user = User::find($id)) {
            $user->delete();

            return $this->successResponse([
                'message' => 'User has been deleted',
            ]);
        }

        return $this->failedResponse('Not found!');
    }

    /**
     * Change User Role
     *
     * @param int $id
     * @param RoleChangeRequest $request
     * @return JsonResponse
     */
    public function changeRole($id, RoleChangeRequest $request): JsonResponse
    {
        if ($user = User::find($id)) {
            // assign role to user
            $user->syncRoles($request->roles);

            return $this->successResponse([
                'message' => 'Users Role has been updated!',
            ]);
        }

        return $this->failedResponse();
    }
}
