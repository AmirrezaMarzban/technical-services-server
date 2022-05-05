@extends('admin.master')
@section('content')
<div class="card table-responsive">
    <div class="card-header">
        <h3 class="card-title">مدیریت کاربران</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>نام و نام خانوادگی</th>
                <th>تلفن همراه</th>
                <th>استان/شهر</th>
                <th>تاریخ ثبت نام</th>
                <th>آخرین تایید تلفن همراه</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone, 150}}</td>
                    <td>{{$user->p_c()}}</td>
                    <td>{{jdate($user->created_at)->format('%d %B-%Y')}}</td>
                    <td>{{jdate($user->phone_verified_at)->format('%d %B-%Y')}}</td>
                    <td>
                        <span  onclick="deleteUser(this, {{ $user->id }});"  class="fa fa-trash" title="حذف"></span>
                        <a href="{{ route('users.edit', $user->id) }}" class="fa fa-edit" title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
{{--@include('admin.section.pagination', ['paginations' => $users])--}}
</div>
<script>
    function deleteUser(sender, id) {
        swal({
            title: "این کاربر حذف شود؟!",
            text: "با کلیک روی بله کلیه اطلاعات درباره این کاربر پاک خواهد شد!",
            icon: 'warning',
            buttons: ['خیر', 'بله'],
            dangerMode: true,
            closeOnCancel: false
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "post",
                    url: "/admin/users/" + id,
                    data: {
                        "id": id,
                        _method: 'delete'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $(sender).parents('tr').remove();
                        swal('پیام موفقیت', 'کاربر موردنظر با موفقیت پاک شد', 'success');
                    }
                });
            }
        });
    }
</script>
@endsection
