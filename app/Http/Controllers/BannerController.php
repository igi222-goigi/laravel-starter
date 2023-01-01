<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class BannerController extends Controller
{

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('banner.list');
    }

    /**
     * Show User List
     *
     * @param Request $request
     * @return mixed
     */
    public function getBannerList(Request $request): mixed
    {
        $data = Banner::get();
        $hasBannerUser = Auth::user()->can('manage_banners');

        return Datatables::of($data)
            ->addColumn('banner_image', function ($data) {
                $image = '<img src="" class="img-thumbnail"/>';
                return $image;
            })
            ->addColumn('active_status', function ($data) {
                // $roles = $data->getAllPermissions();
                $badges = '';
                if ($data->active_status == 1) {
                    $badges = '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges = '<span class="badge badge-danger m-1">Inactive</span>';
                }
                return $badges;
            })
            ->addColumn('action', function ($data) use ($hasBannerUser) {
                $output = '';
                if ($data->name == 'Super Admin') {
                    return '';
                }
                if ($hasBannerUser) {
                    $output = '<div class="table-actions">
                                <a href="' . url('banners/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('banners/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                }

                return $output;
            })
            ->rawColumns(['banner_image', 'active_status', 'action'])
            ->make(true);
    }

    /**
     * User Create
     *
     * @return mixed
     */
    public function create(): mixed
    {
        return view('banner.create');
    }

    /**
     * Store User
     *
     * @param BannerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BannerRequest $request)
    {

        try {

            $validated = $request->validated();

            // if (!$validated) {
            //     return redirect()->back()->with('error', $errors);
            // }

            $filename = 'med-' . time() . $request->file('banner_image')->getClientOriginalExtension();
            $path = $request->file('banner_image')->storeAs('public/uploads', $filename);


            $banner = Banner::create([
                'banner_name' => $request->banner_name,
                'banner_description' => $request->banner_description,
                'banner_image' => $path . '/' . $filename,
                'active_status' => $request->active_status,
            ]);


            if ($banner) {
                return redirect('banners')->with('success', 'New user created!');
            }

            return redirect('banners')->with('error', 'Failed to create new user! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Edit User
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        try {
            $user = User::with('roles', 'permissions')->find($id);

            if ($user) {
                $user_role = $user->roles->first();
                $roles = Role::pluck('name', 'id');

                return view('user-edit', compact('user', 'user_role', 'roles'));
            }

            return redirect('404');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Update User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // update user info
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required | string ',
            'email' => 'required | email',
            'role' => 'required',
        ]);

        // check validation for password match
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            if ($user = User::find($request->id)) {
                $payload = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];
                // update password if user input a new password
                if (isset($request->password) && $request->password) {
                    $payload['password'] = $request->password;
                }

                $update = $user->update($payload);
                // sync user role
                $user->syncRoles($request->role);

                return redirect()->back()->with('success', 'User information updated succesfully!');
            }

            return redirect()->back()->with('error', 'Failed to update user! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        if ($banner = Banner::find($id)) {
            $banner->delete();

            return redirect('banners')->with('success', 'Banner removed!');
        }

        return redirect('banners')->with('error', 'Banner not found');
    }
}
