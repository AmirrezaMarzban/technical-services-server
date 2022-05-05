@extends('admin.master')
@section('content')
    <div class="alert alert-danger alert-dismissible" id="error">
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card table-responsive">
                <div class="card-header">
                    <h3 class="card-title">دسته بندی آگهی ها</h3>
                </div>
                <!-- /.card-header -->
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>نام دسته بندی</th>
                        <th>آیکون</th>
                        <th>تصویر پس زمنیه</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr role="row">
                            <td id="cname">{{$category->title}}</td>
                            <td><img width="80px" src="{{url($category->icon)}}"></td>
                            <td><img width="80px" src="{{url($category->background)}}"></td>
                            <td>
                                    <span onclick="deleteCategory(this, {{ $category->id }})"
                                          class="fa fa-trash mlg-15"
                                          title="حذف"></span>
                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="fa fa-edit"
                                   title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">ایجاد دسته بندی جدید</h3>
                </div>
                <div class="card-body">
                        <form id="form" method="post" class="padding-30"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" id="cat_name" name="name"
                                       class="form-control" placeholder="نام دسته بندی">
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="icon"
                                           id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">آپلود آیکون</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="background"
                                           id="inputGroupFile02">
                                    <label class="custom-file-label" for="inputGroupFile02">آپلود تصویر پس زمینه</label>
                                </div>
                            </div>
                            <button id="mainBtn" type="submit" class="btn btn-primary">اضافه کردن
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#form').submit(function (event) {
            event.preventDefault();
            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('categories.store') }}",
                processData: false,
                contentType: false,
                data: new FormData(this),
                dataType: 'JSON',
                success: function (data) {
                    $('#error').html('').hide();
                    $('#table tbody').prepend('<tr role=row><td>' + data.name + '</td><td><img width=80px src=' + data.icon + '></td><td><img width=80px src=' + data.background + '></td><td><span onclick="deleteCategory(this, ' + data.id + ')" class="fa fa-trash" title=حذف></span><span class="fa fa-edit" title=ویرایش></span>');
                },
                error: function (xhr) {
                    $('#error').html('').show();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        var list = $('<ul>').appendTo('#error');
                        for (var i = 0; i < value.length; i++)
                            list.append('<li>' + value + '</li>');
                    });
                },
            });
        });

        function deleteCategory(sender, id) {
            swal({
                title: "این دسته بندی حذف شود؟!",
                text: "با کلیک روی بله کلیه اطلاعات این دسته بندی پاک خواهد شد!",
                icon: 'warning',
                buttons: ['خیر', 'بله'],
                dangerMode: true,
                closeOnCancel: false
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "/admin/categories/" + id,
                        data: {
                            "id": id,
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            $(sender).parents('tr').remove();
                            swal('پیام موفقیت', 'دسته بندی موردنظر با موفقیت پاک شد', 'success');
                        }
                    });
                }
            });
        }
    </script>
@endsection
