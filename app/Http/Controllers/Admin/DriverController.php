<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


use App\Http\Requests\CustomerRequest;
use App\Models\Driver;

class DriverController extends Controller
{

  public function index()
  {

    $data = Driver::paginate(PAGINATION_COUNT);

    return view('admin.drivers.index', ['data' => $data]);
  }

  public function create()
  {
    return view('admin.drivers.create');
  }



  public function store(Request $request)
  {

        $driver = new Driver();
        $driver->name = $request->get('name');
        $driver->username = $request->get('username');
        $driver->phone = $request->get('phone');
        $driver->car_number = $request->get('car_number');

        if ($request->has('image')) {
            $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path = uploadImage('assets/admin/uploads', $request->image);

            $driver->image = $the_file_path;

            }

        $driver->password = Hash::make($request->password);
        $driver->active = $request->active;

        if($driver->save()){
            return redirect()->route('admin.driver.index')->with(['success' => 'drivers created']);

        }else{
            return redirect()->back()->with(['error' => 'Something wrong']);
        }



  }

  public function edit($id)
  {
    $data=Driver::findorFail($id);
    return view('admin.drivers.edit',compact('data'));
  }

  public function update(Request $request,$id)
  {
    $driver=Driver::findorFail($id);
    try{
        $driver->name = $request->get('name');
        $driver->username = $request->get('username');
        $driver->phone = $request->get('phone');
        $driver->car_number = $request->get('car_number');
        if ($request->has('image')) {
            $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path = uploadImage('assets/admin/uploads', $request->image);
            $driver->image = $the_file_path;
            }
        $driver->password = Hash::make($request->password);
        $driver->active = $request->active;
        if($driver->save()){
            return redirect()->route('admin.driver.index')->with(['success' => 'Customer update']);

        }else{
            return redirect()->back()->with(['error' => 'Something wrong']);
        }

    }catch(\Exception $ex){
        return redirect()->back()
        ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
        ->withInput();
    }

  }

  public function delete($id)
    {
        try {

            $item_row = Driver::select("name")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = Driver::where('id','=',$id)->delete();;

        if ($flag) {
            return redirect()->back()
            ->with(['success' => '   Delete Succefully   ']);
            } else {
            return redirect()->back()
            ->with(['error' => '   Something Wrong']);
            }

            } else {
            return redirect()->back()
            ->with(['error' => '   cant reach fo this data   ']);
            }

       } catch (\Exception $ex) {

            return redirect()->back()
            ->with(['error' => ' Something Wrong   ' . $ex->getMessage()]);
            }
    }

  public function ajax_search(Request $request)
  {
      if ($request->ajax()) {


      $search_by_text = $request->search_by_text;
      $searchbyradio = $request->searchbyradio;

      if ($search_by_text != '') {
      if ($searchbyradio == 'customer_code') {
      $field1 = "customer_code";
      $operator1 = "=";
      $value1 = $search_by_text;
      } else {
      $field1 = "name";
      $operator1 = "like";
      $value1 = "%{$search_by_text}%";
      }
      } else {
      //true
      $field1 = "id";
      $operator1 = ">";
      $value1 = 0;
      }


      $data = Driver::where($field1, $operator1, $value1)->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

      return view('admin.drivers.ajax_search', ['data' => $data]);
      }
      }



}
