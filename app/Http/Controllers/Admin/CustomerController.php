<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        if ($name) {
            $customers = Customer::where('name', 'like', '%' . $name . '%')
                ->paginate(10);
        } elseif ($phone) {
            $customers = Customer::where('phone', 'like', '%' . $phone . '%')
                ->paginate(10);
        } elseif ($email) {
            $customers = Customer::where('email', 'like', '%' . $email . '%')
                ->paginate(10);
        } else {
            $customers = Customer::orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('admin.customer.list', compact('customers'));
    }

    public function create(Request $request)
    {
        $method_route = "route_BackEnd_Customers_Create";

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|max:50|unique:users',
                'password' => 'required|min:6',
            ], [
                'name.required' => 'Tên bắt buộc nhập!',
                'name.min' => 'Tên tối thiểu 3 ký tự!',
                'email.required' => 'Email bắt buộc nhập!',
                'email.unique' => 'Email đã tồn tại!',
                'email.email' => 'Email không đúng định dạng!',
                'email.max' => 'Email tối đa 50 ký tự!',
                'password.required' => 'Mật khẩu bắt buộc nhập!',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);

            $modelTes = new Customer();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công!');
                return redirect()->route('route_BackEnd_Customers_List');
            } else {
                Session::flash('error', 'Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.customer.create');
    }

    public function edit($id, Request $request)
    {
        $modelCustomer = new Customer();
        $customer = $modelCustomer->loadOne($id);
        $this->v['customer'] = $customer;
        return view('admin.customer.edit', $this->v);
    }

    public function update($id, CustomerRequest $request)
    {

        $method_route = 'route_BackEnd_Customers_Edit';
        $params = [];

        $params['cols'] = $request->post();

        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        if (!is_null($params['cols']['password'])) {
            $params['cols']['password'] = Hash::make($params['cols']['password']);
        }

        $modelCustomer = new Customer();
        $res = $modelCustomer->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_Customers_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route, ['id' => $id]);
        }
    }
}
