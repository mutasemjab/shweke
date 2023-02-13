<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\DistanceUtil;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\Course;
use App\Models\Lectaure;
use App\Models\ShopCoupon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $courses = Course::with('lectaures')->get();
        $userCode = Code::select('customer_id')->where('customer_id','=',$user_id)->first();

        if($userCode){
            return [
                'courses'=>$courses,

            ];
        }else{
            return [
                "success"=>false,
                "error"=>"You don't Have Any Course yet"
            ];
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


    public function destroy($id){

    }

 




}
