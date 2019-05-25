@extends('layouts.admin')

@section('content')
    
<h1 class="page-header">Profile</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Profile Password
            </div>
            <div class="panel-body">
                <form action="{{route('password.update')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Old Password</label>
                        <input name="old_password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input name="new_password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label><br>
                        <input name="confirm_password" type="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Edit</button>
                </form>
                <hr>
                <a href="{{ url()->previous() }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection