@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">View Order</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-12">

                            @if(Session::has('success'))
                            <p style="color:green;">{{ Session::get('success') }}</p>
                            @endif
                            @if(Session::has('errors'))
                            <p style="color:red;">{{ Session::get('errors') }}</p>
                            @endif
                            <table class="table">
                                <tr>
                                    <th>Name Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    {{-- <th style="display: flex; justify-content: end; align-content: end">Acction</th> --}}
                                </tr>
                                @foreach ($ListOrders as $Order)
                                    <tr>
                                        <td>{{ substr($Order->accessoriesName,0,20)  }}</td>
                                        <td>
                                            @php
                                            $images = \App\Models\Images::all()->where('product_id','=',$Order->accessory_id);
                                            @endphp
                                            @foreach ($images as $image)
                                            <img src="{{ asset('images/product/'.$image->name)}}" style="width: 32px ; height: 32px ;object-fit: cover" alt="">
                                            @endforeach
                                            {{-- <img src="{{ asset('images/product/'.$images->name)}}" style="max-width: 32px ; height: 32px ;object-fit: cover" alt=""> --}}

                                        </td>
                                        <td>{{ $Order->quantity }}</td>
                                        <td>{{ $Order->price }}$</td>

                                        {{-- <td style="display: flex ; justify-content: end">
                                            <a class="btn btn-primary" style="margin-right: 5px" href="{{ route('editAccessories',['accessory'=>$accessory]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form method="POST" action="{{ route('deleteAccessories',['accessory'=>$accessory]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" value="Delete"> <i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </table>
                            {{-- <div class="row">
                                <div class="col-sm-12 col-md-12" style="display: flex; justify-content: end">
                                    {{$accessories->links('admins.custom')}}

                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
