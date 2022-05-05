@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">اضافه کردن دسته بندی تجربه کاری</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('workingexperiences.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label>نام دسته بندی</label>
                    <input type="text" name="name" placeholder="نام دسته بندی"
                           class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">اضافه کردن</button>
            </form>
        </div>
    </div>
@endsection
