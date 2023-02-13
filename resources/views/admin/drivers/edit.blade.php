@extends('layouts.admin')
@section('title')

edit Driver
@endsection



@section('contentheaderlink')
<a href="{{ route('admin.driver.index') }}"> Driver </a>
@endsection

@section('contentheaderactive')
تعديل
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> edit Driver </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.driver.update',$data['id']) }}" method="post" enctype='multipart/form-data'>
        <div class="row">
        @csrf

<div class="col-md-6">
<div class="form-group">
  <label>name</label>
  <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>





<div class="col-md-6">
  <div class="form-group">
    <label>   username</label>
    <input name="username" id="email" class="form-control" value="{{ old('username',$data['username']) }}"    >
    @error('username')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>   phone</label>
              <input name="phone" id="phone" class="form-control" value="{{ old('phone',$data['phone']) }}"    >
              @error('phone')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>


            <div class="col-md-6">
            <div class="form-group">
              <label>   Car Number</label>
              <input name="car_number" id="car_number" class="form-control" value="{{ old('car_number',$data['car_number']) }}"    >
              @error('car_number')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>

<div class="col-md-6">
      <div class="form-group">
        <label>   active</label>
        <select name="active" id="active" class="form-control">
         <option value="">select </option>
        <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}  value="1"> active</option>
         <option {{  old('active',$data['active'])==0 ? 'selected' : ''}}   value="0"> disactive</option>
        </select>
        @error('is_archived')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> update</button>
        <a href="{{ route('admin.driver.index') }}" class="btn btn-sm btn-danger">cancel</a>

      </div>
    </div>

  </div>
            </form>



            </div>




        </div>
      </div>






@endsection


@section('script')
<script src="{{ asset('assets/admin/js/drivers.js') }}"></script>
@endsection






