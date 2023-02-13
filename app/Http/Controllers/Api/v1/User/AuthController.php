<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class AuthController extends Controller
{
   public function register(Request  $request){

       //sleep(3);

       $validator = Validator::make($request->all(),[
          'name'=>'required',
          'username'=>'required|unique:drivers',
          'password'=>'required',
          'image'=>'required',
          'phone'=>'required',
          'car_number'=>'required',

       ]);

       if ($validator->fails())
       {
           return response(['errors'=>$validator->errors()->all()], 422);
       }

       $user  = new Driver();
       $user->name = $request->get('name');
       $user->username = $request->get('username');
       $user->phone = $request->get('phone');

       if ($request->has('image')) {
        $request->validate([
        'image' => 'required|max:2000',
        ]);
        $the_file_path = uploadImage('assets/admin/uploads', $request->image);
        $user->image = $the_file_path;
        }

       $user->car_number = $request->get('car_number');
       $user->password = Hash::make($request->get('password'));

       if(isset($request->fcm_token)){
           $user->fcm_token = $request->fcm_token;
       }
       $user->save();

       $accessToken = $user->createToken('authToken')->accessToken;
       return response(['user'=>$user,'token'=>$accessToken]);

   }


   public function login(Request $request){

       //sleep(3);

        $data = $request->validate([
           'username'=>'required',
           'password'=>'required'
       ]);


       $driver = Driver::where('username', '=', $request->username)->first();
   if(!$driver){
       return response(['errors'=>['This username is not found']],402);
   }

   if($driver->active === 0){
       return response(['errors'=>['This user is not active']],402);
   }


       if(!Auth::guard('driver')->attempt($data, $request->remember)) {
           return response(['errors'=>['Password is not correct']],402);
       }

       $accessToken = auth()->user()->createToken('authToken')->accessToken;
       if(isset($request->fcm_token)){
           $user = Driver::find(auth()->user()->id);
           $user->fcm_token = $request->fcm_token;
           $user->save();
       }
       return response(['user'=> auth()->user(),'token'=>$accessToken],200);
   }

   public function changeStatus(Request $request)
   {

       $this->validate($request, [
           'is_offline' => 'required'
       ]);

       $deliveryBoy = Driver::find(auth()->user()->id);

       if ($request->is_offline) {
           if ($deliveryBoy->is_free) {
               $deliveryBoy->is_offline = $request->is_offline;
           } else {
               return response(['errors' => ['Please delivered current order then you can goes to offline']], 402);
           }
       } else {
           $deliveryBoy->is_offline = $request->is_offline;
       }

       if($deliveryBoy->save()){
           return response(['message' => ['Your status has been changed'],'delivery_boy'=>$deliveryBoy], 200);
       }else{
           return response(['errors' => ['Something went wrong']], 402);
       }
   }
   public function updateProfile(Request $request){

//       return response(['errors' => ['This is demo version' ]], 403);
       $user =  auth()->user();

       if(isset($request->password)){
           $user->password = Hash::make($request->password);
       }

       if(isset($request->avatar_image)){
           $url = "user_avatars/".Str::random(10).".jpg";
           $oldImage = $user->avatar_url;
           $data = base64_decode($request->avatar_image);
           Storage::disk('public')->put($url, $data);
           Storage::disk('public')->delete($oldImage);
           $user->avatar_url = $url;
       }

       if($user->save()){
           return response(['message'=>['Your setting has been changed'],'user'=>$user]);
       }else{
           return response(['errors'=>['There is something wrong']],402);
       }
   }

   public function verifyMobileNumber(Request $request){

       $validator = Validator::make($request->all(),[
           'mobile'=>'required',

       ]);

       if ($validator->fails())
       {
           return response(['errors'=>$validator->errors()->all()], 422);
       }

       if(Driver::where('mobile',$request->mobile)->exists()){
           return response(['errors'=>['Mobile number already exists']],402);

       }else{
           return response(['message'=>['You can verify with this mobile']]);
       }
   }

   public function mobileVerified(Request $request){

       $validator = Validator::make($request->all(),[
           'mobile'=>'required',

       ]);

       if ($validator->fails())
       {
           return response(['errors'=>$validator->errors()->all()], 422);
       }


       $user =  auth()->user();


       $user->mobile=$request->get('mobile');
       $user->mobile_verified=true;


       if($user->save()){
           return response(['message'=>['Your setting has been changed'],'user'=>$user],200);
       }else{
           return response(['errors'=>['There is something wrong']],402);
       }
   }
}

