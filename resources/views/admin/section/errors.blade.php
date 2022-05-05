@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" id="error">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5>خطا!<i class="icon fa fa-ban"></i></h5>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
