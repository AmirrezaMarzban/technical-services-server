@extends('admin.master')
@section('admincontent')
{{--                <a href="{{ route('level.index') }}" class="btn btn-sm btn-success">کاربران مدیریت</a>--}}
{{--                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-info">سطوح دسترسی</a>--}}
<div class="table__box">
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item" href="{{route('users.index')}}">کاربران عادی</a>
            <a class="tab__item is-active" href="{{ route('users.manager') }}">مدیران</a>
        </div>
    </div>
    <table class="table">
        <thead role="rowgroup">
        <tr role="row" class="title-row">
            <th>تصویر کاربر</th>
            <th>نام</th>
            <th>پست الکترونیک</th>
            <th>شماره همراه</th>
            <th>سطح دسترسی</th>
            <th>استان/شهر</th>
            <th>کدپستی</th>
            <th>آدرس</th>
            <th>تاریخ ثبت نام</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>

        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی کاربر">
                    <button class="btn btn-mrbell">جستجو</button>
                </form>
            </div>
        </div>
        <tr role="row" >
        @foreach($users->where('level', 'admin') as $user)
            <tr>
                <td><img src="{{route('user.profile', $user->hash)}}" style="width: 90px;height: 80px"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone, 150}}</td>
                <td class="{{$user->level == 'user' ? '' : 'text-success'}}">{{$user->level == 'user' ? "کاربر عادی" : "مدیر"}}</td>
                <td>{{'اراک'}}</td>
                <td>{{$user->zipcode}}</td>
                <td>{{$user->address}}</td>
                <td>{{jdate($user->created_at)->format('%d %B، %Y')}}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <a href="{{ route('users.destroy', $user->id) }}" class="item-delete mlg-15" title="حذف"></a>
                        <a href="{{ route('users.edit', $user->id) }}" class="item-edit " title="ویرایش"></a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
