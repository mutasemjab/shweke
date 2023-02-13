<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //TODO : validation in authentication order
    public function index($id)
    {

        $orders=Order::where('driver_id',$id)->get();
        return $orders;
    }

    public function getOrders(Request $request){

        $validator = Validator::make($request->all(),[
            'tracking_number'=>'required',


         ]);
         if ($validator->fails())
         {
             return response(['errors'=>$validator->errors()->all()], 422);
         }

         if($orders=Order::where('tracking_number', '=', $request->tracking_number)->get()){
            return response(['orders'=>$orders]);
        }else{
                return response(['errors'=>['This Tracking Number is not found']],402);
            }


    }


    public function changeOrderStatus($id,Request $request)
   {

       $this->validate($request, [
           'status' => 'required'
       ]);

       $order = Order::findOrFail($id);

       if ($request->status) {
           if ($request->status == 1) {
               $order->status = $request->status;
               $order->save();
               return response(['message' => ['pending'],'order'=>$order], 200);
           }elseif($request->status ==2) {
            $order->status = $request->status;
            $order->save();
            return response(['message' => ['on the way'],'order'=>$order], 200);
        }elseif($request->status ==3) {
            $order->status = $request->status;
            $order->save();
            return response(['message' => ['Deliverd'],'order'=>$order], 200);
        }else {
               return response(['errors' => ['Something went wrong']], 402);
           }
       }else{
        return response(['errors' => ['Something went wrong']], 402);
    }


   }

    public function create()
    {

    }


    public function store(Request $request)
    {


    }

    public function show($id)
    {


    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id)
    {

    }




}
