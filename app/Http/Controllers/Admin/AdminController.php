<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Cloudder;
use App\Repositories\User\UserRepositoryInterface;

class AdminController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $users = $this->userRepository->all();

        return view('admin.user.index', compact('users'));
    }

    public function profile($id)
    {
        try {
            $admin = $this->userRepository->find($id);
        } catch (Exception $ex) {
            return redirect()->route('admin.profile')->withError($ex->getMessage());
        }

        return view('admin.profile', compact('admin'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $admin = $this->userRepository->find($id);
        } catch (Exception $ex) {
            return redirect()->route('admin.profile')->withError($ex->getMessage());
        }

        if ($request->hasFile('avatar')) {
            $filename = $request->avatar;
            Cloudder::upload($filename, config('common.path_cloud_avatar')."$admin->name");
            $admin->avatar = Cloudder::getResult()['url'];
        }

        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->phone = $request->phone;
        $admin->email = $request->email;

        $admin->save();

        return redirect('admin');
    }
}
