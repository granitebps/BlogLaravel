@extends('layouts.admin')

@section('content')
    <h1 class="page-heading">
        Message
    </h1>
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading">Reply Message</div>
            <div class="panel-body">
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
                        <textarea required name="msg" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection