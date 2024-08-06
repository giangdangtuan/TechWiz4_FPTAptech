@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">

    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Up Images</div>
                <div class="card-body">
                    <a href="{{ route('createUsers') }}">Add Users</a>
                    <div class="panel-body">
            @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @foreach(\Session::get('image') as $imgs)
                    <img src="images/{{ $imgs }}" style="max-height: 5em; width:auto; object-fit: cover">
                @endforeach
            @endif
            <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Image:</label>
                    <input type="file" name="image[]" class="form-control @error('image.*') is-invalid @enderror" multiple>
 
                    @error('image.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
