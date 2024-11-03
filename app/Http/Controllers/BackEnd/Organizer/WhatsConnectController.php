<?php

namespace App\Http\Controllers\BackEnd\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http as HttpClient;
use App\Models\WhatsConnect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WhatsConnectController extends Controller
{

  protected $user;
  protected $device;
  protected $req_device;
  
  protected $connect = [
    'device' => 'device_80',
    'appkey' => 'd6b0830c-392c-49e0-9da2-01dd109f4510',
    'authkey' => '127ArThc137RzO0vO2o2g03Z0sVx0way798ul0fpmpAbCSXpim'
  ];
  
  protected $token = '127ArThc137RzO0vO2o2g03Z0sVx0way798ul0fpmpAbCSXpim';

  //index
  public function index(HttpClient $httpClient)
  {
    $this->user = Auth::guard('organizer')->user();
    $this->device = $this->user->whatsconnect;
    
    if (!$this->device->isEmpty()) {
      $response = $httpClient::post('https://chatboty.com.br/api/device/get/info', [
        'authkey' => $this->device[0]->auth,
        'uuid' => $this->device[0]->uuid
      ]);
      
      $this->req_device = $response->object();
    }

    return view('organizer.whats_connect.index', ['device' => $this->req_device]);
  }

  public function store(HttpClient $httpClient)
  {
    $this->user = Auth::guard('organizer')->user();
    $this->device = $this->user->whatsconnect;
    
    $device = DB::transaction(function () use ($httpClient) {

        if ($this->device->isEmpty()) {
            $response = $httpClient::post('https://chatboty.com.br/api/device/create', [
                'authkey' => $this->token,
                'name' => $this->user->username
            ]);
    
            $specs = $response->object();
    
            $device_specs['organizer_id'] = Auth::guard('organizer')->user()->id;
            $device_specs['uuid'] = $specs->uuid;
            $device_specs['auth'] = $specs->auth;
            $device_specs['device'] = $specs->device;
            
            $device_create = WhatsConnect::create($device_specs);
            $device_create['qr'] = $specs->qr;
            $device_create['message'] = $specs->message;
            return $device_create;
        }
    });

    Session::flash('success', 'Added Successfully');
    return response()->json(['status' => 'success', 'device' => $device], 200);
  }

  /**
   * Update status (active/DeActive) of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function createApp(Request $request, HttpClient $httpClient)
  {
    $this->user = Auth::guard('organizer')->user();
    $this->device = $this->user->whatsconnect;
    
    if (!$this->device->isEmpty()) {

      if (Auth::guard('organizer')->user()->id != $this->device[0]->organizer_id) {
        return back();
      }else{
        $response = $httpClient::post('https://chatboty.com.br/api/device/create/app', [
            'uuid' => $this->device[0]->uuid,
            'website' => 'entradamix.com'
        ]);
  
        $device = $response->object();
  
        $this->device->update([
          'app' => $device->app,
          'auth' => $device->auth,
          'status' => $device->status,
        ]);
      }
    }

    Session::flash('success', 'Updated Successfully');

    return response()->json(['status' => 'success', 'device' => $this->device], 200);
  }

  /**
   * Update featured status of a specified resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function logoutSession(Request $request, HttpClient $httpClient)
  {
    $this->user = Auth::guard('organizer')->user();
    $this->device = $this->user->whatsconnect;
    
    if (!$this->device->isEmpty()) {

      if (Auth::guard('organizer')->user()->id != $this->device->organizer_id) {
        return back();
      }else{
        $response = $httpClient::post('https://chatboty.com.br/api/device/create/app', [
            'uuid' => $this->device[0]->uuid,
            'website' => 'entradamix.com'
        ]);
  
        $device = $response->object();
  
        $this->device->update([
          'status' => $device->status,
        ]);
      }
    }

    return response()->json(['status' => 'success', 'device' => $this->device], 200);
  }
  
  /**
   * @return Response
   */
  public function send($phone, $message, $device = null, $url = null)
  {
    if($device != null){
        $device = $device[0]->device;
    }else{
        $device = $this->connect['device'];
    }
    
    $phone = preg_replace('/[^0-9]/', '', $phone);

    $body = array(
      "receiver" => 55 . $phone,
      "delay" => 0,
      "message" => array(
        "text" => $message
      )
    );

    if ($url != null && $url != "") {
      $explode = explode('.', $url);
      $file_type = strtolower(end($explode));
      $extentions = [
        'jpg' => 'image',
        'jpeg' => 'image',
        'png' => 'image',
        'webp' => 'image',
        'pdf' => 'document',
        'docx' => 'document',
        'xlsx' => 'document',
        'csv' => 'document',
        'txt' => 'document',
        'apk' => 'document',
        'ios' => 'document'
      ];

      unset($body["message"]["text"]);

      $body["message"][$extentions[$file_type]] = ['url' => $url];
      $body["message"]["caption"] = $message;
    }

    $urlApi = "http://193.203.182.182:8000/chats/send?id={$device}";

    $response = HttpClient::post($urlApi, $body);

    $response = $response->object();

    return $response;
  }
}
