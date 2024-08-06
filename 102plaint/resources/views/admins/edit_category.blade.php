@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">

    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Update Category</div>
                <div class="card-body">

                @if($errors->any())
                @foreach($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
                @endforeach
                @endif
                @if(Session::has('success'))
                        <p style="color:green;">{{ Session::get('success') }}</p>
                        @endif
                        @if(Session::has('errors'))
                        <p style="color:red;">{{ Session::get('errors') }}</p>
                        @endif
                <form action="{{route('updateCategory',['category'=>$category])}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                <input  class="form-control" type="text" name="name" placeholder="Enter Name" value="{{$category->name}}">
                <input  type="submit" class="btn btn-primary btn-sm mt-3" value="Update">
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
