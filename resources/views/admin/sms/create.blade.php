@extends('layouts.admin')
@section('title')
SMS
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Send New SMS   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.sms.store') }}" method="post" enctype='multipart/form-data'>
        <div class="row">
        @csrf







            <div class="col-md-6">
                <div class="form-group">
                    <label for="to">To:</label>
                    <input type="text" name="to" id="to" class="form-control">
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                </div>




            <div class="col-md-6">
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" class="form-control">Your tracking Number is </textarea>
                @error('message')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> submit</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-danger">cancel</a>

      </div>
    </div>

  </div>
            </form>



            </div>




        </div>







@endsection








