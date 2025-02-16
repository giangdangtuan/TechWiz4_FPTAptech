@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">

    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account List</div>
                <div class="card-body">
                    <a class="btn btn-primary mb-3" href="{{ route('createUsers') }}">Add Users</a>
                    @if(Session::has('success'))
                        <p style="color:green;">{{ Session::get('success') }}</p>
                        @endif
                        @if(Session::has('errors'))
                        <p style="color:red;">{{ Session::get('errors') }}</p>
                        @endif
                    <h4>Total User:{{$userCount}}</h4>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Acction</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->roles == null)
                                        User
                                    @else

                                    {{ $user->roles->name }}

                                    @endif
                                </td>
                                <td style="display: flex">
                                    <a class="btn  btn-primary btn-sm" style="margin-right: 10px" href="{{ route('editUser',['user'=>$user]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('deleteUser',['user'=>$user]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" value="Delete"> <i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="row">
                                <div class="col-sm-12 col-md-12" style="display: flex; justify-content: end">
                                    {{$users->links('admins.custom')}}
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
