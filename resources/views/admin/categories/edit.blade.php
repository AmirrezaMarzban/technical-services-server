@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ویرایش دسته بندی</h3>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>نام دسته بندی</label>
                        <input type="text" id="cat_name" name="name" placeholder="نام دسته بندی"
                               class="form-control"
                               value="{{ $category->title }}">
                    </div>
                    <div class="form-group">
                        <label>آپلود آیکون</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="icon"
                                   id="inputGroupFile01" lang="fa">
                            <label class="custom-file-label"
                                   for="inputGroupFile01">{{ is_null($category->icon) ? "انتخاب تصویر" : url($category->icon)}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>آپلود تصویر پس زمینه</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="background"
                                   id="inputGroupFile02">
                            <label class="custom-file-label"
                                   for="inputGroupFile02">{{ is_null($category->background) ? "انتخاب تصویر" : url($category->background)}}</label>
                        </div>
                    </div>
                    <button id="mainBtn" type="submit" class="btn btn-primary">ویرایش کردن</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $("#inputGroupFile01").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $("#inputGroupFile02").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
