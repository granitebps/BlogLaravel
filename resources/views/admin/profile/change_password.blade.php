@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
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
</div>

@endsection