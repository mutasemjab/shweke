@extends('layouts.admin')
@section('title')
Driver
@endsection


@section('contentheaderactive')
show
@endsection



@section('content')



      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Driver </h3>
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('admin.driver.ajax_search') }}">

          <a href="{{ route('admin.driver.create') }}" class="btn btn-sm btn-success" > New Driver</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
          <div class="col-md-4">

            <input  type="radio" name="searchbyradio" id="searchbyradio" value="name"> name

            <input autofocus style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder=" name" class="form-control"> <br>

                      </div>

                          </div>
               <div class="clearfix"></div>

        <div id="ajax_responce_serarchDiv" class="col-md-12">

          @if (@isset($data) && !@empty($data) && count($data)>0)

          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">

           <th>name </th>
           <th> username </th>
           <th> Car Number </th>
           <th>  phone </th>
           <th>  Image </th>

           <th>active</th>
          <th></th>

            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>

             <td>{{ $info->name }}</td>
             <td>{{ $info->username }}</td>
             <td>{{ $info->car_number }}</td>


             <td>{{ $info->phone }}</td>
             <td>
             <div class="image">
                <img class="custom_img" src="{{ asset('assets/admin/uploads').'/'.$info->image }}"  >

                      </div>
             </td>
             <td>@if($info->active==true) active @else disactive @endif</td>

         <td>

        <a href="{{ route('admin.driver.edit',$info->id) }}" class="btn btn-sm  btn-primary">edit</a>
        <a href="{{ route('admin.driver.delete',$info->id) }}" class="btn btn-sm are_you_shue  btn-danger">delete</a>

         </td>


           </tr>

         @endforeach



            </tbody>
             </table>
      <br>
           {{ $data->links() }}

           @else
           <div class="alert alert-danger">
there is no data found !!           </div>
                 @endif

        </div>



      </div>

        </div>

</div>

@endsection

@section('script')
<script src="{{ asset('assets/admin/js/Drivers.js') }}"></script>

@endsection


