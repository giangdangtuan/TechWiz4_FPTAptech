@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">List Order</div>
                <div class="card-body">

<h2 class="mb-4">Orders</h2>
    <h4 class="text-dange">Total Orders:
        {{ $countorders }}
    </h4>
                        @if(Session::has('success'))
                        <p style="color:green;">{{ Session::get('success') }}</p>
                        @endif
                        @if(Session::has('errors'))
                        <p style="color:red;">{{ Session::get('errors') }}</p>
                        @endif
    <table class="table">
        <tr>

            <th>Id</th>
            <th>Customer Name</th>
            <th>Bill</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->userName }}</td>
                <td>${{ $order->bill }}</td>
                <td>{{ $order->Address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    @php
                        $statusS='';
                        if($order->status ==0){
                            $statusS='Pending';
                        }else{
                            $statusS='Solved';
                        }
                    @endphp
                    <div class="
                    @php
                        if($order->status==0){
                            echo 'badge bg-warning rounded-pill';
                        }else{
                            echo 'badge bg-success rounded-pill';
                        }
                    @endphp
                    ">{{

                        $statusS

                        }}</div>
                </td>
                <td style="display: flex ; justify-content: end">
                    <a class="btn btn-primary" style="margin-right: 5px" href="
                    {{ route('viewOrder',['order'=>$order]) }}
                    "><i class="fa-solid fa-eye"></i></a>
                    @if($order->status==0)
                        <a class="btn btn-success" style="margin-right: 5px" href="
                        @php
                        route('changeStatus',['order'=>$order])
                        @endphp
                        "><i class="fa-solid fa-check"></i></a>

                    @endif

                    {{-- <form method="GET" action="
                    {{ route('changeStatus',['order'=>$order]) }}
                    ">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-success" value="changeStatus"> <i class="fa-solid fa-check"></i></button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </table>

</div>
</div>
</div>
</div>
</div>

@endsection
