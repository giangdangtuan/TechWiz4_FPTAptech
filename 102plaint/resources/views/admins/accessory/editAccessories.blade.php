@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">

    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Update Products</div>
                <div class="card-body">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p style="color:red;">{{ $error }}</p>
                    @endforeach
                    @endif
                    @if($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @foreach(\Session::get('image') as $imgs)
                                <img src="{{ asset('images/product/'.$imgs) }}" style="max-height: 5em; width:auto; object-fit: cover">
                            @endforeach
                        @endif
                    <form action="{{route('updateAccessories',['accessory'=>$accessory])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="row pb-3">
                                <div class="col-6">
                                    <label class="pb-1" for="name">Name:</label>
                                    <input  class="form-control" type="text" name="name" placeholder="Enter Name" value="{{$accessory->name}}">
                                </div>
                                <div class="col-6">
                                    <label class="pb-1" for="use">Use:</label>
                                    <input  class="form-control" type="text" name="use" placeholder="Enter Use" value="{{$accessory->use}}">
                                </div>
                                <div class="col-6">
                                    <label class="pb-1" for="price">Price:</label>
                                    <input  class="form-control" type="text" name="price" placeholder="Enter Price" value="{{$accessory->price}}">
                                </div>
                                <div class="col-6">
                                    <div class="col-6">
                                        <label class="pb-1" for="type_id">Choose a Type:</label>

                                        <select class="form-control" name="type_id" id="type_id">
                                            @foreach ($category as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="col-6" style="display: grid">
                                    <label class="pb-1" for="image">Images Old:</label>
                                    <div style="display: flex">
                                        @php
                                        $images = \App\Models\Images::all()->where('product_id','=',$accessory->id);
                                        @endphp
                                        @foreach ($images as $image)
                                        <img src="{{ asset('images/product/'.$image->name)}}" style="width: 32px ; height: 32px ;object-fit: cover ; margin-right: 3px" alt="">
                                    @endforeach
                                    </div>
                                     
                                </div>
                                <div class="col-6">
                                    <label  class="pb-1" for="image">Image:</label>
                                   
                                    <input type="file" name="image[]" class="form-control @error('image.*') is-invalid @enderror" multiple>
                                    @error('image.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                        <label class="pb-1" for="description">Description:</label>
                                        <textarea  class="form-control" type="description" name="description" style="height: 200px" placeholder="Enter Description" value="{{$image->description}}"></textarea>
                                    </div>
                                <div class="col-12">
                                    <input  type="submit" class="btn btn-primary btn-sm mt-3" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
