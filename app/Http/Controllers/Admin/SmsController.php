<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class SmsController extends Controller
{

    public function createSms()
    {
      return view('admin.sms.create');
    }


    public function sendSms(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://api.releans.com/v2/',
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImUzMGQxMGE1LTZjMzUtNDUzZC04MTQ0LWRkYzE2MjQyOTAyNCIsImlhdCI6MTY3NzQxMDA4NywiaXNzIjoxNTY4Nn0.kLn4_JzL1ysRc6pPRA1ul7_-HonKt1BXhHS48BccK_g',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $response = $client->post('message', [
            RequestOptions::FORM_PARAMS => [
                'sender' => 'NDRTRANS',
                'mobile' => $request->input('to'),
                'content' => $request->input('message'),
            ],
        ]);

        return redirect()->back()->with('success', 'SMS sent successfully');
    }
}
