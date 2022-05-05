@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ایجاد محصول</h3>
        </div>
        <div class="card card-primary">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('products.store') }}" class="padding-30" method="post"
                      enctype="multipart/form-data">
                @csrf
                @method('POST')
                <!-- text input -->
                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" class="form-control" name="name"
                               placeholder="اطلاعات را وارد کنید" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>درصد تخفیف</label>
                        <input type="text" name="price" placeholder="اطلاعات را وارد کنید"
                               class="form-control" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label>تخفیف</label>
                        <input name="discount" placeholder="اطلاعات را وارد کنید"
                               class="form-control" value="{{ old('discount') }}">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="banner_id">
                            <option value="" disabled selected>انتخاب بنر</option>
                            @foreach(\App\Banner::get() as $banner)
                                <option value="{{ $banner->id }}">{{ $banner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value="" disabled selected>انتخاب دسته بندی</option>
                            @foreach(\App\Category::get() as $category)
                                <option
                                    value="{{ $category->id }}">{{ $category->cat_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image"
                                   id="inputGroupFile01" lang="fa">
                            <label class="custom-file-label" for="inputGroupFile01">عکس
                                محصول</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="features"
                                   id="inputGroupFile02">
                            <label class="custom-file-label" for="inputGroupFile02">ویژگی
                                محصول</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea name="description" placeholder="اطلاعات را وارد کنید"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">ایجاد</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $("#inputGroupFile01").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $("#inputGroupFile02").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
