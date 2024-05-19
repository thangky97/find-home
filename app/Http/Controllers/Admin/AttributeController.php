<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $name = $request->get('name');
        if($name){
            $attributes = Attribute::where('name','like','%'.$name.'%')
        ->paginate(10);
        } else{
            $attributes = Attribute::orderBy('id','desc')
        ->paginate(10);
        }   

        return view('admin.attribute.list', compact('attributes'));
    }

    public function create(Request $request) {
        $method_route = "route_BackEnd_Attribute_Create";

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
            ], [
                'name.required' => 'Tên bắt buộc nhập!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset( $params['cols']['_token']);

            $modelTes = new Attribute();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success','Thêm mới thành công!');
                return redirect()->route('route_BackEnd_Attribute_List');
            } else {
                Session::flash('error','Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.attribute.create');
    }

    public function edit($id, Request $request) {
        $modelAttribute = new Attribute();
        $services = $modelAttribute->loadOne($id);
        $this->v['services'] = $services;
        return view('admin.attribute.edit', $this->v);
    }

    public function update($id, AttributeRequest $request) {

        $method_route = 'route_BackEnd_Attribute_Edit';
        $params = [];

        $params['cols'] = $request->post();

        unset( $params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelUser = new Attribute();
        $res = $modelUser->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_Attribute_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route,['id'=>$id]);
        }
    }
}
