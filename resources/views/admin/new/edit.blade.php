@extends('layouts.admin.master')

@section('title', 'Sửa bài viết')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg-box">
                            <?php //Hiển thị thông báo thành công
                            ?>
                            @if (Session::has('success'))
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <span><i class="mdi mdi-check"></i></span>
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title mb-4">Sửa bài viết</h4>

                                <form class="custom-validation"
                                    action="{{ route('route_BackEnd_News_Update', ['id' => request()->route('id')]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $news->name }}">
                                            @error('name')
                                                <div>
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Danh mục bài viết <span
                                                    class="text-danger">*</span></label>
                                            <select name="cate_new_id" id="" class="form-control">
                                                @foreach ($cate_new_id as $a)
                                                    <option value="{{ $a->id }}"
                                                        {{ isset($news) && $news->cate_new_id === $a->id ? 'selected' : '' }}>
                                                        {{ $a->name }}</option>
                                                @endforeach
                                                @error('cate_new_id')
                                                    <div>
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </div>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nội dung ngắn</label>
                                        <div>
                                            <textarea name="short_description" data-parsley-type="text" id="summernote_sort_content" class="form-control"
                                                rows="3">{{ $news->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nội dung</label>
                                        <div>
                                            <textarea name="description" data-parsley-type="text" id="summernote" class="form-control" rows="5">{!! $news->description !!}</textarea>
                                            @error('description')
                                                <div>
                                                    <p class="text-danger">{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ảnh <span class="text-danger">*</span></label>
                                        <div>
                                            <div class="form-file">
                                                <input type="file" name="images" class="form-file-input form-control">
                                                @if (isset($news) && $news->images)
                                                    <img src="{{ asset($news->images ? '' . Storage::url($news->images) : $news->name) }}"
                                                        alt="{{ $news->name }}" width="100">
                                                @endif
                                                @error('images')
                                                    <div>
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select" id="validationCustom04">
                                            <option selected value="">Chọn trạng thái</option>
                                            <option value="1"
                                                {{ isset($news) && $news->status === 1 ? 'selected' : '' }}>
                                                Hoạt động</option>
                                            <option value="2"
                                                {{ isset($news) && $news->status === 2 ? 'selected' : '' }}>
                                                Không hoạt động</option>
                                            <option value="0"
                                                {{ isset($news) && $news->status === 0 ? 'selected' : '' }}>
                                                Khóa</option>
                                        </select>
                                        @error('status')
                                            <div>
                                                <p class="text-danger">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>
                                    <input type="text" name="updated_at" id="updated_at"
                                        value="{{ date('Y-m-d H:i:s', strtotime('now')) }}" hidden>
                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Cập nhật
                                            </button>
                                            <a href="{{ route('route_BackEnd_News_List') }}"
                                                class="btn btn-secondary waves-effect">Quay lại</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- end form -->
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#summernote').summernote({
            placeholder: 'Nội dung',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#summernote_sort_content').summernote({
            placeholder: 'Nội dung ngắn',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
            ]
        });
    </script>
@endsection
