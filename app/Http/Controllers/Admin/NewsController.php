<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category_News;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
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
            $news = News::where('name', 'like', '%' . $name . '%')
                ->paginate(10);
        } elseif ($phone) {
            $news = News::where('phone', 'like', '%' . $phone . '%')
                ->paginate(10);
        } elseif ($email) {
            $news = News::where('email', 'like', '%' . $email . '%')
                ->paginate(10);
        } else {
            $news = News::with('category')->orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.new.list', compact('news'));
    }

    public function create(Request $request)
    {
        $method_route = "route_BackEnd_News_Create";
        $categoryNew = Category_News::where('status', 1)->get();

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'cate_new_id' => 'required',
                'images' =>
                [
                    'image',
                    'max:2048',
                ],
            ], [
                'name.required' => 'Tên bắt buộc nhập!',
                'description.required' => 'Mô tả bắt buộc nhập!',
                'cate_new_id.required' => 'Vui lòng chọn danh mục bài biết!',
                'images.image' => 'Bắt buộc phải là ảnh!',
                'images.max' => 'Ảnh không được lớn hơn 2MB!',
            ], []);

            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);
            if ($request->hasFile('images') && $request->file('images')->isValid()) {
                $params['cols']['images'] = $this->uploadFile($request->file('images'));
            }

            $modelTes = new News();
            $res = $modelTes->saveNew($params);

            if ($res == null) {
                return  redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công!');
                return redirect()->route('route_BackEnd_News_List');
            } else {
                Session::flash('error', 'Thêm mới không thành công!');
                return redirect()->route($method_route);
            }
        }
        return view('admin.new.create', compact('categoryNew'));
    }

    public function edit($id, Request $request)
    {
        $modelNews = new News();
        $news = $modelNews->loadOne($id);
        $this->v['cate_new_id'] = DB::table('category_news')->get();
        $this->v['news'] = $news;
        return view('admin.new.edit', $this->v);
    }

    public function update($id, NewsRequest $request)
    {
        $method_route = 'route_BackEnd_News_Edit';
        $params = [];

        $params['cols'] = $request->post();

        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            $params['cols']['images'] = $this->uploadFile($request->file('images'));
        }

        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelNews = new News();
        $res = $modelNews->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật thành công!');
            return redirect()->route('route_BackEnd_News_List');
        } else {
            Session::flash('error', 'Cập nhật không thành công!');
            return redirect()->route($method_route, ['id' => $id]);
        }
    }

    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('news', $fileName, 'public');
    }
}
