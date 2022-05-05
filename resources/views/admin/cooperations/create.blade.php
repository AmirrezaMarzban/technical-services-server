@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">اضافه کردن دسته بندی نوع همکاری</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cooperations.store') }}" method="post">
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
