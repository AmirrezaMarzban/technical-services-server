@extends('admin.master')
@section('container-header')
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
            <a class="btn btn-primary" href="{{ route('workinghours.create') }}" role="button">ایجاد دسته بندی</a>
        </ol>
    </div>
@endsection
@section('content')
    <div class="card table-responsive">
    <div class="card-header">
        <h3 class="card-title">دسته بندی ساعت کاری</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>نام</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($workingHours as $workingHour)
                <tr>
                <td>
                    <span>{{ $workingHour->title }}</span>
                </td>
                <td>
                    <span onclick="deleteWorkingExperiences(this, {{ $workingHour->id }})" class="fa fa-trash" title="حذف"></span>
                    <a href="{{ route('workinghours.edit', $workingHour->id) }}" class="fa fa-edit" title="ویرایش"></a>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function deleteWorkingExperiences(sender, id) {
            swal({
                title: "این رنگ حذف شود؟!",
                text: "با کلیک روی بله کلیه اطلاعات درباره این دسته بندی پاک خواهد شد!",
                icon: 'warning',
                buttons: ['خیر', 'بله'],
                dangerMode: true,
                closeOnCancel: false
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "/admin/workinghours/" + id,
                        data: {
                            "id": id,
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            $(sender).parents('tr').remove();
                            swal('پیام موفقیت', ' دسته بندی مورد نظر با موفقیت پاک شد', 'success');
                        }
                    });
                }
            });
        }
    </script>
@endsection
