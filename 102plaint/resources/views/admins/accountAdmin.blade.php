@extends('admins.layouts.app')
@section('content')
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Update Account Admin</div>
                <div class="card-body">
                        {{ $success=''; }}
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

                <form  action="{{ route('updateAccountAdmin') }} " method="POST">
                @csrf
                @method('post')

                <div class="form-group">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="pb-1" for="name">Name:</label>
                            <input  class="form-control" type="text" name="name" placeholder="Enter Name" value="{{ $user->name }}">
                        </div>
                        <div class="col-6">
                            <label class="pb-1" for="email">Email:</label>
                            <input  class="form-control" type="email" disabled  name="email" placeholder="Enter Email" value="{{ $user->email }}">
                            <input  class="form-control" type="hidden" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="col-6">
                            <label class="pb-1" for="password">Old Password:</label>
                            <input  class="form-control" type="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="col-6">
                            <label class="pb-1" for="password">New Password:</label>
                            <input  class="form-control"  type="password" name="newPassword" placeholder="Enter Confirm Password">
                        </div>

                        <div class="col-6">
                            <label class="pb-1" for="password">New Password Confirmation:</label>
                            <input  class="form-control" type="password" name="newPassword_confirmation" placeholder="Enter Password">
                        </div>

                        <div class="col-12" style="display: flex; align-content: center;justify-content: center;">.
                            <input class="btn btn-primary mt-3"  type="submit" value="Update Infor">
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
