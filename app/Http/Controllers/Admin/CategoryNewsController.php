<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryNewsRequest;
use App\Models\Category_News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryNewsController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $name = $request->get('name');
        if ($name) {
            $category_new = Category_News::where('name', 'like', '%' . $name . '%')
                ->paginate(10);
        } else {
            $category_new = Category_News::orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('admin.category_new.list', compact('category_new'));
    }

    public function create(Request $request)
    {
        $method_route = "route_BackEnd_Category_News_Create";

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
            ], [
                'name.required' => 'Tên danh mục bắt buộc nhập!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);

            $modelTes = new Category_News();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công!');
                return redirect()->route('route_BackEnd_Category_News_List');
            } else {
                Session::flash('error', 'Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.category_new.create');
    }

    public function edit($id, Request $request)
    {
        $modelCategoryNews = new Category_News();
        $category_new = $modelCategoryNews->loadOne($id);
        $this->v['category_new'] = $category_new;
        return view('admin.category_new.edit', $this->v);
    }

    public function update($id, CategoryNewsRequest $request)
    {

        $method_route = 'route_BackEnd_Category_News_Edit';
        $params = [];

        $params['cols'] = $request->post();

        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelCategoryNews = new Category_News();
        $res = $modelCategoryNews->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_Category_News_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route, ['id' => $id]);
        }
    }
}
