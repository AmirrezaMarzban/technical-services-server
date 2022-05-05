@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Post::where('status', 0)->count() }}</h3>
                    <p>آگهی جدید</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\User::all()->count() }}</h3>
                    <p>کاربر ثبت شده</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <div class="card table-responsive">
            <div class="row card-header">
                <div class="col-lg-6 col-12">
                    <h3 class="card-title">آگهی های ارسالی اخیر</h3>
                </div>
                <div class="col-lg-6 col-12">
                    <a href="{{ route('posts.index') }}">نمایش همه آگهی ها</a>
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
                    @foreach(\App\Models\Post::all() as $post)
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
                            <td>{{ jdate($post->created_at)->format('%d %B-%Y') }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card table-responsive">
            <div class="row card-header">
                <div class="col-lg-6 col-12">
                    <h3 class="card-title">کاربران ثبت شده اخیر</h3>
                </div>
                <div class="col-lg-6 col-12">
                    <a href="{{ route('users.index') }}">نمایش همه کاربران</a>
                </div>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\User::all() as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->phone, 150}}</td>
                            <td>{{$user->p_c()}}</td>
                            <td>{{jdate($user->created_at)->format('%d %B-%Y')}}</td>
                            <td>{{jdate($user->phone_verified_at)->format('%d %B-%Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
