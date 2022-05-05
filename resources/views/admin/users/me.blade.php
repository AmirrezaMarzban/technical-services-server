@extends('admin.master')
@section('content')
@include('admin.section.errors')
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle mb-3"
                 src="{{ route('user.profile', auth()->user()->hash) }}"
                 alt="User profile picture">
        </div>

        <form action="{{ route('users.update', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="نام و نام خانوادگی"
                       value="{{ auth()->user()->name }}">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="ایمیل"
                       value="{{ auth()->user()->email }}">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="شماره موبایل"
                       value="{{ auth()->user()->phone }}">
            </div>
            <div class="form-group">
{{--                <input type="text" class="form-control" placeholder="کدپستی"--}}
{{--                       value="{{ $user->zipcode }}">--}}
                <input type="password" class="form-control" name="password" placeholder="رمز عبور جدید">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="تکرار رمز عبور جدید">
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control" name="address"
                          placeholder="آدرس">{{ auth()->user()->address }}</textarea>
            </div>
            <button class="btn btn-primary btn-block">ویرایش کاربر</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
