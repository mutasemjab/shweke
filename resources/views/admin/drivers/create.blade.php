@extends('layouts.admin')
@section('title')
Driver
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Add New Driver   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.driver.store') }}" method="post" enctype='multipart/form-data'>
        <div class="row">
        @csrf

<div class="col-md-6">
<div class="form-group">
  <label>  Name</label>
  <input name="name" id="name" class="form-control" value="{{ old('name') }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>




          <div class="col-md-6">
            <div class="form-group">
              <label>   username </label>
              <input name="username" id="name" class="form-control" value="{{ old('username') }}"    >
              @error('username')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label>   password </label>
                  <input name="password" id="password" class="form-control" value="{{ old('password') }}"    >
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>   phone</label>
              <input name="phone" id="notes" class="form-control" value="{{ old('phone') }}"    >
              @error('phone')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
              <label>   Car Number</label>
              <input name="car_number" id="car_number" class="form-control" value="{{ old('car_number') }}"    >
              @error('car_number')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>


            <div class="upload-btn-wrapper">
                <div class="form-group">
                    <img src="" id="image-preview" alt="Selected Image" height="50px" width="50px" style="display: none;">
                  <button class="btn"> image</button>
                 <input  type="file" id="Item_img" name="image" class="form-control" onchange="previewImage()">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
            </div>

<div class="col-md-6">
      <div class="form-group">
        <label>  activate</label>
        <select name="active" id="active" class="form-control">
         <option value=""> select</option>
        <option   @if(old('active')==1  || old('active')=="" ) selected="selected"  @endif value="1"> active</option>
         <option @if( (old('active')==0 and old('active')!="")) selected="selected"  @endif   value="0"> disactive</option>
        </select>
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> submit</button>
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
<script>
    function previewImage() {
      var preview = document.getElementById('image-preview');
      var input = document.getElementById('Item_img');
      var file = input.files[0];
      if (file) {
      preview.style.display = "block";
      var reader = new FileReader();
      reader.onload = function() {
        preview.src = reader.result;
      }
      reader.readAsDataURL(file);
    }else{
        preview.style.display = "none";
    }
    }
  </script>
@endsection






