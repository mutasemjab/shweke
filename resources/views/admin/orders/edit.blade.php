@extends('layouts.admin')
@section('title')

edit code
@endsection



@section('contentheaderlink')
<a href="{{ route('admin.code.index') }}">  code </a>
@endsection

@section('contentheaderactive')
Edit
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> edit code </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.code.update',$data['id']) }}" method="post" >
        <div class="row">
        @csrf


        <div class="form-group col-md-6">
            <label for="courses">Course Name <span class="text-danger">*</span></label>
            <select class="form-control" name="course_id[]" id="course" multiple>
                <option disabled>Select Course</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="courses">Customer Name <span class="text-danger">*</span></label>
            <select class="form-control" name="customer" id="customer">
                <option disabled>Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
            </select>
        </div>

            <div class="col-md-6">
            <div class="form-group">
            <label>  the code </label>
            <input name="number" id="number" class="form-control" value="{{ old('number') }}"    >
            @error('number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            </div>




      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> update</button>
        <a href="{{ route('admin.code.index') }}" class="btn btn-sm btn-danger">cancel</a>

      </div>
    </div>

  </div>
            </form>



            </div>




        </div>
      </div>






@endsection


@section('script')
<script src="{{ asset('assets/admin/js/customers.js') }}"></script>
@endsection






