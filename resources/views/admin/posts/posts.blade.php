@extends('admin.master')
@section('content')
<div class="card table-responsive">
    <div class="card-header">
        <h3 class="card-title">آگهی های ثبت شده</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <tr>
                <th>دسته بندی</th>
                <th>نام آگهی</th>
                <th>توضیحات</th>
                <th>شهر/استان</th>
                <th>تجربه کاری</th>
                <th>نوع همکاری</th>
                <th>شیوه پرداخت</th>
                <th>ساعت کاری</th>
                <th>دورکاری</th>
                <th>سربازی</th>
                <th>تاریخ ثبت آگهی</th>
                <th>عملیات</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->category()->first()->title }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->p_c }}</td>
                    <td>{{ \App\Models\WorkingExperiences::whereId($post->working_experiences_id)->first()->title }}</td>
                    <td>{{ \App\Models\Cooperation::whereId($post->cooperation_id)->first()->title }}</td>
                    <td>{{ \App\Models\Pmethods::whereId($post->pmethod_id)->first()->title }}</td>
                    <td>{{ \App\Models\Workinghours::whereId($post->workinghours_id)->first()->title }}</td>
                    <td>{{ $post->insurance == 1 ? 'دارد' : 'ندارد' }}</td>
                    <td>{{ $post->military_service == 1 ? 'دارد' : 'ندارد' }}</td>
                    <td>{{ jdate($post->created_at)->format('%d %B-%Y') }}</td>
                    <td>
                        <span onclick="deleteProduct(this, {{$post->id}});"
                              class="fa fa-trash mlg-15"
                              title="حذف"></span>
                        <span onclick="changeVisibility(this, {{ $post->id }});"
                              class="fa {{ $post->status == 0 ? 'fa-eye' : 'fa-lock' }} mlg-15"></span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
    $("#inputGroupFile01").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $("#inputGroupFile02").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    function deleteProduct(sender, id) {
        swal({
            title: "این آگهی حذف شود؟!",
            text: "با کلیک روی بله کلیه اطلاعات این آگهی پاک خواهد شد!",
            icon: 'warning',
            buttons: ['خیر', 'بله'],
            dangerMode: true,
            closeOnCancel: false
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "post",
                    url: "/admin/posts/" + id,
                    data: {
                        "id": id,
                        _method: 'delete'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $(sender).parents('tr').remove();
                        swal('پیام موفقیت', 'آگهی موردنظر با موفقیت پاک شد.', 'success');
                    }
                });
            }
        });
    }
    function changeVisibility(sender, id) {
        $.ajax({
            type: "post",
            dataType: "JSON",
            url: "/admin/posts/exist/" + id,
            data: {
                "id": id,
                _method: 'PATCH'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if ($(sender).hasClass('fa fa-lock')) {
                    $(sender).removeClass('fa fa-lock');
                    $(sender).addClass('fa fa-eye');
                } else {
                    $(sender).removeClass('fa fa-eye');
                    $(sender).addClass('fa fa-lock');
                }
                swal('پیام موفقیت', data.data, 'success');
            }
        });
    }
</script>
@endsection
