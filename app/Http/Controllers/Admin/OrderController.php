<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {

     $data = Order::with('driver')->get();

      return view('admin.orders.index', ['data' => $data]);
    }

    public function create()
    {
        $randomNumber = random_int(1000000, 9999999);
        $drivers=Driver::get();
      return view('admin.orders.create')->with([
        'randomNumber'=>$randomNumber,
        'drivers'=>$drivers,
      ]);
    }



    public function store(Request $request)
    {
        try{
            $order = new Order();
            $order->longitude = $request->get('longitude');
            $order->latitude = $request->get('latitude');
            $order->tracking_number = $request->get('tracking_number');
            $order->mobile = $request->get('mobile');
            $order->place = $request->get('place');
            $order->driver_id= $request->get('driver');


            if($order->save()){
                return redirect()->route('admin.order.index')->with(['success' => 'order created']);

            }else{
                return redirect()->back()->with(['error' => 'Something wrong']);
            }

        }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
            ->withInput();
        }

    }

    public function edit($id)
    {
        $data=Order::findorFail($id);

        $drivers=Driver::get();
        return view('admin.orders.edit', ['data' => $data,'drivers'=>$drivers]);
    }

    public function update(Request $request,$id)
    {
        $order=Order::findorFail($id);
        try{
            $order->longitude = $request->get('longitude');
            $order->latitude = $request->get('latitude');
            $order->tracking_number = $request->get('tracking_number');
            $order->mobile = $request->get('mobile');
            $order->place = $request->get('place');
            $order->driver_id= $request->get('driver');


            if($order->save()){


                return redirect()->route('admin.order.index')->with(['success' => 'order update']);

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

            $item_row = Order::select("*")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = Order::with('driver')->where('id','=',$id)->delete();;

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
}
