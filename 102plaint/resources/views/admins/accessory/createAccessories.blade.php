@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">

    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Create Products</div>
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
                    <div class="sbp-preview-content">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @foreach(\Session::get('image') as $imgs)
                                <img src="{{ asset('images/product/'.$imgs) }}" style="max-height: 5em; width:auto; object-fit: cover">
                            @endforeach
                        @endif
                        <form action="{{route('storeAccessories')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="pb-1" for="type_id">Name:</label>
                                        <input  class="form-control form-control-solid" type="text" name="name" placeholder="Enter Name" >
                                    </div>
                                    <div class="col-6">
                                        <label class="pb-1" for="type_id">Use:</label>

                                         <input  class="form-control form-control-solid" type="text" name="use" placeholder="Enter Use" >
                                    </div>
                                    <div class="col-6">
                                        <label class="pb-1" for="type_id">Price:</label>
                                         <input  class="form-control form-control-solid" type="text" name="price" placeholder="Enter Price" >
                                    </div>
                                    <div class="col-6">
                                        <label class="pb-1" for="type_id">Choose a Type:</label>

                                        <select class="form-control form-control-solid" name="type_id" id="type_id">
                                            @foreach ($category as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="pb-1" for="description">Description:</label>
                                        <textarea  class="form-control" type="description" name="description" style="height: 200px" placeholder="Enter Description"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label>Image:</label>
                                        <input type="file" name="image[]" class="form-control @error('image.*') is-invalid @enderror" multiple>
                                        @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <input  type="submit" class="btn btn-primary mt-3" value="Create">
                                    </div>
                                </div>



                                {{-- <input  class="form-control form-control-solid" type="text" name="type_id" placeholder="Enter Type Id" > --}}




                            </div>
                            </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
