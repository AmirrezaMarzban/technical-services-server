@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <p class="text-center">  تاریخ ثبت نام{{' '.jdate($user->phone_verified_at)->format('%d %B-%Y')}}</p>
                <input type="text" name="name" class="form-control" placeholder="نام و نام خانوادگی"
                       value="{{ $user->name }}">
                </div>
                <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="تلفن همراه"
                       value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <select class="form-control" name="province_id">
                        <option value="" disabled selected>انتخاب شهر</option>
                        @foreach(\App\Models\Province::get() as $province)
                            <option value="{{ $province->id }}" {{ $user->province_id == $province->id ? 'selected' : ''}}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="city_id">
                        <option value="" disabled selected>انتخاب استان</option>
                        @foreach(\App\Models\City::get() as $city)
                            <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary btn-block">ویرایش کاربر</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="card table-responsive">
        <div class="row card-header">
            <div class="col-lg-6 col-12">
                <h3 class="card-title">آگهی های اخیر کاربر</h3>
            </div>
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
                    <th>وضعیت</th>
                    <th>تاریخ ثبت آگهی</th>
                </tr>
                @foreach($user->posts()->get() as $post)
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
                        <td class="{{$post->status == 0 ? '' : 'text-success'}}">{{$post->status == 0 ? "در انتظار تایید" : "تایید شده"}}</td>
                        <td>{{ jdate($user->created_at)->format('%d %B-%Y') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
