<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
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
        if($name){
            $users = User::where('name','like','%'.$name.'%')
        ->paginate(10);
        } elseif ($phone){
            $users = User::where('phone','like','%'.$phone.'%')
        ->paginate(10);
        } elseif ($email){
            $users = User::where('email','like','%'.$email.'%')
        ->paginate(10);
        } else{
            $users = User::orderBy('id','desc')
        ->paginate(10);
        }   

        return view('admin.user.list', compact('users'));
    }

    public function create(Request $request) {
        $method_route = "route_BackEnd_Users_Create";

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|max:50|unique:users',
                'password' => 'required|min:6',
                'role' => 'required',
                'images' =>
                [
                    'image',
                    'max:2048',
                ],
            ], [
                'name.required' => 'Tên bắt buộc nhập!',
                'name.min' => 'Tên tối thiểu 3 ký tự!',
                'email.required' => 'Email bắt buộc nhập!',
                'email.unique' => 'Email đã tồn tại!',
                'email.email' => 'Email không đúng định dạng!',
                'email.max' => 'Email tối đa 50 ký tự!',
                'password.required' => 'Mật khẩu bắt buộc nhập!',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự!',
                'role.required' => 'Vui lòng chọn vai trò!',
                'images.image' => 'Bắt buộc phải là ảnh!',
                'images.max' => 'Ảnh không được lớn hơn 2MB!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);

            $modelTes = new User();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success','Thêm mới thành công!');
                return redirect()->route('route_BackEnd_Users_List');
            } else {
                Session::flash('error','Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.user.create');
    }

    public function edit($id, Request $request) {
        $modelUser = new User();
        $users = $modelUser->loadOne($id);
        $this->v['users'] = $users;
        return view('admin.user.edit', $this->v);
    }

    public function update($id, UserRequest $request) {

        $method_route = 'route_BackEnd_Users_Edit';
        $params = [];

        $params['cols'] = $request->post();

        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;
        if (!is_null($params['cols']['password'])) {
            $params['cols']['password'] = Hash::make($params['cols']['password']);
        }

        $modelUser = new User();
        $res = $modelUser->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_Users_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route,['id'=>$id]);
        }
    }
}
