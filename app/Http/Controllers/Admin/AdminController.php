<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Cloudder;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Suggest\SuggestRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;

class AdminController extends Controller
{
    private $userRepository;
    private $suggestRepository;
    private $orderRepository;
    private $productRepository;

    public function __construct(
        UserRepositoryInterface $userRepository, 
        SuggestRepositoryInterface $suggestRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->suggestRepository = $suggestRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $users = $this->userRepository->all();
        $countSuggest = $this->suggestRepository->count();

        return redirect()->route('admin.chart');
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
            Cloudder::upload($filename, config('common.path_cloud_avatar') . $admin->email);
            $admin->avatar = Cloudder::getResult()['url'];
        }

        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->phone = $request->phone;
        $admin->email = $request->email;

        $admin->save();

        return redirect('admin');
    }

    public function chart() 
    {
        //LineChart of Orders
        $orders = $this->orderRepository->groupByDate();
        $dataOrders = Lava::DataTable();

        $dataOrders->addDateColumn(trans('settings.day_of_month'))
                    ->addNumberColumn(trans('settings.orders'));

        foreach ($orders as $key_order => $value_order) {
            $dataOrders->addRow([$key_order, count($value_order)]);
        }

        Lava::LineChart('Orders', $dataOrders);

        //ColumnChart of Prices
        $dataPrices = Lava::DataTable();

        $dataPrices->addDateColumn(trans('settings.day_of_month'))
                    ->addNumberColumn(trans('settings.prices'));

        $price = 0;
        foreach ($orders as $key_order => $value_order) {
            foreach ($value_order as $key => $value) {
                $price += $value->price;
            }
            $dataPrices->addRow([$key_order, $price]);
            $price = 0;
        }

        Lava::ColumnChart(trans('settings.prices'), $dataPrices);

        //PieChart of Products
        $products = $this->productRepository->all();

        $dataProducts = Lava::DataTable();

        $dataProducts->addStringColumn(trans('settings.products'))
                ->addNumberColumn(trans('settings.percent'));

        foreach ($products as $product) {
            $dataProducts->addRow([$product->name, intval($product->quantity)]);
        }

        Lava::PieChart('Products', $dataProducts, [
            'title'  => trans('settings.products_in_stock'),
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.1],
                ['offset' => 0.2],
                ['offset' => 0.3],
                ['offset' => 0.4],
                ['offset' => 0.5],
            ]
        ]);

        return view('admin.charts');
    }
}
