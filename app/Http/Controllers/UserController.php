<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models\User;
use Response;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use App\Http\Requests\UserRequest;
use Cloudder;
use Mail;

class UserController extends Controller
{
    private $userRepository;
    private $orderRepository;
    private $lineItemRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        LineItemRepositoryInterface $lineItemRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->lineItemRepository = $lineItemRepository;
    }

    public function login(LoginRequest $request)
    {
        if ($request->ajax()) {
            $auth = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($auth)) {
                return Response::json(['success' => true, 'url' => route(Auth::user()->isAdmin() ? 'admin' : 'home')]);
            }

            return Response::json(['success' => false, 'messages' => trans('settings.login_error')]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register(RegisterRequest $request)
    {
        if ($request->ajax()) {
            $userRegister = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => config('common.user.role.customer'),
                'avatar' => config('common.user.avatar_default'),
            ];

            $authUser = User::create($userRegister);
            Auth::login($authUser);

            return Response::json(['success' => true, 'url' => route('home')]);
        }
    }

    public function updateAddress(Request $request)
    {
        $address = $request->address;
        $this->userRepository->updateAddress($address, Auth::user()->id);

        return redirect()->route('checkout');
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->find($id);
        } catch (Exception $ex) {
            return redirect()->route('user.profile')->withError($ex->getMessage());
        }

        return view('user.profile', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
        } catch (Exception $ex) {
            return redirect()->route('user.profile')->withError($ex->getMessage());
        }

        if ($request->hasFile('avatar')) {
            $filename = $request->avatar;
            Cloudder::upload($filename, config('common.path_cloud_avatar') . $user->email);
            $user->avatar = Cloudder::getResult()['url'];
        }

        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        return view('user.profile', compact('user'));
    }

    public function orderInformation($id)
    {
        $orders = $this->orderRepository->findBy('user_id', $id);

        return view('user.order_information', compact('orders'));
    }

    public function checkoutSuccess($orderId)
    {
        $order = $this->orderRepository->find($orderId);

        return view('product.checkout_success', compact('order'));
    }

    public function orderDetails($id, $orderId)
    {
        $order = $this->orderRepository->find($orderId);

        $lineItems = $this->lineItemRepository->findBy('order_id', intval($orderId));

        return view('user.show_order', compact('order', 'lineItems'));
    }

    public function showResetForm()
    {
        return view('auth.passwords.email');
    }
}
