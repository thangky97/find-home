<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
            $services = Product::where('name', 'like', '%' . $name . '%')
                ->paginate(10);
        } elseif ($phone) {
            $services = Product::where('phone', 'like', '%' . $phone . '%')
                ->paginate(10);
        } elseif ($email) {
            $services = Product::where('email', 'like', '%' . $email . '%')
                ->paginate(10);
        } else {
            $services = Product::with('attribute')->orderBy('id', 'desc')->paginate(10);
            $listAttribute = DB::table('attribute')->get();
        }

        return view('admin.product.list', compact('services', 'listAttribute'));
    }

    public function create(Request $request)
    {
        $method_route = "route_BackEnd_Products_Create";
        $listAttribute = DB::table('attribute')->where('status', '=', 1)->get();

        $Attributes = new Product();

        $arrAttribute = array();
        foreach ($Attributes->loadAll() as $index => $att) {
            $dataItem = array($index => $att->attribute_id);
            $arrAttribute = $dataItem + $arrAttribute;
        }
        $list = $arrAttribute;

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'images' =>
                [
                    'image',
                    'mimes:jpeg,png,jpg',
                    'max:2048',
                ],
                'address' => 'required',
                'price' => 'required',
            ], [
                'name.required' => 'Tên bắt buộc nhập!',
                'description.required' => 'Mô tả bắt buộc nhập!',
                'images.image' => 'Bắt buộc phải là ảnh!',
                'images.max' => 'Ảnh không được lớn hơn 2MB!',
                'address' => 'Vui lòng nhập địa chỉ!',
                'price' => 'Vui lòng nhập giá!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);
            if ($request->hasFile('images') && $request->file('images')->isValid()) {
                $params['cols']['images'] = $this->uploadFile($request->file('images'));
            }

            // Chuyển mảng attribute_id thành chuỗi và gán vào $params['cols']
            if ($request->has('attribute_id')) {
                $params['cols']['attribute_id'] = implode(',', $request->input('attribute_id'));
            }

            $modelTes = new Product();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công!');
                return redirect()->route('route_BackEnd_Products_List');
            } else {
                Session::flash('error', 'Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.product.create', compact('listAttribute', 'list'));
    }

    public function edit($id, Request $request)
    {
        $modelSProduct = new Product();
        $services = $modelSProduct->loadOne($id);
        $this->v['listAttribute'] = DB::table('attribute')->get();
        $this->v['idNotSelected'] = explode(',', Product::find($id)->attribute_id);
        $this->v['services'] = $services;
        return view('admin.product.edit', $this->v);
    }

    public function update($id, ProductRequest $request)
    {

        $method_route = 'route_BackEnd_Products_Edit';
        $params = [];

        $params['cols'] = $request->post();

        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            $params['cols']['images'] = $this->uploadFile($request->file('images'));
        }

        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        // Chuyển mảng attribute_id thành chuỗi và gán vào $params['cols']
        if ($request->has('attribute_id')) {
            $params['cols']['attribute_id'] = implode(',', $request->input('attribute_id'));
        }

        $modelUser = new Product();
        $res = $modelUser->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_Products_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route, ['id' => $id]);
        }
    }

    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('products', $fileName, 'public');
    }
}
