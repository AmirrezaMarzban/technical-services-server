@extends('admin.master')
@section('content')
    @include('admin.section.errors')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ویرایش دسته بندی شیوه پرداخت</h3>
        </div>
            <div class="card-body">
                <form action="{{ route('pmethods.update', $pmethod->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>نام دسته بندی</label>
                        <input type="text" name="name" placeholder="نام دسته بندی"
                               class="form-control"
                               value="{{ $pmethod->title }}">
                    </div>
                    <button type="submit" class="btn btn-primary">ویرایش کردن</button>
                </form>
            </div>
        </div>
@endsection
