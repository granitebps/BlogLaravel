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
                    <form action="{{route('message.replied', ['id'=>$message->msg_id])}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Name : </label>
                            {{$message->msg_name}}
                        </div>
                        
                        <div class="form-group">
                            <label for="">Message From User : </label>
                            {{$message->msg_body}}
                        </div>
                        
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea required name="msg" placeholder="Reply Message..." cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Send</button>
                    </form>
                    <hr>
                    <a href="{{ route('message.index') }}" class="btn btn-warning btn-block">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection