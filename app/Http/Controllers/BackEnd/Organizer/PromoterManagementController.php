<?php

namespace App\Http\Controllers\BackEnd\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BasicSettings\Basic;
use App\Models\BasicSettings\MailTemplate;
use App\Models\Event;
use App\Models\Event\EventContent;
use App\Models\Event\EventImage;
use App\Models\Language;
use App\Models\Promoter;
use App\Models\PromoterInfo;
use App\Models\Transaction;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PHPMailer\PHPMailer\PHPMailer;

class PromoterManagementController extends Controller
{
  private $admin_user_name;
  
  public function __construct()
  {
    $admin = Admin::select('username')->first();
    $this->admin_user_name = $admin->username;
  }

  public function settings()
  {
    $setting = DB::table('basic_settings')->where('uniqid', 12345)->select('organizer_email_verification', 'organizer_admin_approval', 'admin_approval_notice')->first();
    return view('organizer.end-user.promoter.settings', compact('setting'));
  }
  
  //update_setting
  public function update_setting(Request $request)
  {
    if ($request->organizer_email_verification) {
      $organizer_email_verification = 1;
    } else {
      $organizer_email_verification = 0;
    }
    if ($request->organizer_admin_approval) {
      $organizer_admin_approval = 1;
    } else {
      $organizer_admin_approval = 0;
    }
    // finally, store the favicon into db
    DB::table('basic_settings')->updateOrInsert(
      ['uniqid' => 12345],
      [
        'organizer_email_verification' => $organizer_email_verification,
        'organizer_admin_approval' => $organizer_admin_approval,
        'admin_approval_notice' => $request->admin_approval_notice,
      ]
    );

    Session::flash('success', 'Updated Successfully');
    return back();
  }

  public function index(Request $request)
  {
    $searchKey = null;

    if ($request->filled('info')) {
      $searchKey = $request['info'];
    }

    $promoters = Promoter::when($searchKey, function ($query, $searchKey) {
      return $query->where('username', 'like', '%' . $searchKey . '%')
        ->orWhere('email', 'like', '%' . $searchKey . '%');
    })
      ->orderBy('id', 'desc')
      ->paginate(10);

    return view('organizer.end-user.promoter.index', compact('promoters'));
  }

  //add
  public function add()
  {
    $languages = Language::get();
    return view('organizer.end-user.promoter.create', compact('languages'));
  }
  
  public function create(Request $request)
  {
    $rules = [
      'email' => [
        'required',
        'unique:scanners',
      ],
      'username' => [
        'required',
        'alpha_dash',
        'unique:scanners',
        "not_in:$this->admin_user_name",
      ],
    ];

    $languages = Language::get();

    $messages = [];

    foreach ($languages as $language) {
      $rules[$language->code . '_name'] = 'required';
      $messages[$language->code . '_name'] = 'The name field is required for ' . $language->name . ' language.';
    }

    $request->validate($rules, $messages);

    $in = $request->all();
    $in['password'] = Hash::make($request->password);

    $file = $request->file('photo');
    
    if ($file) {
      $extension = $file->getClientOriginalExtension();
      $directory = public_path('assets/admin/img/promoter-photo/');
      $fileName = uniqid() . '.' . $extension;
      @mkdir($directory, 0775, true);
      $file->move($directory, $fileName);
      $in['photo'] = $fileName;
    }

    $in['status'] = 1;
    $in['organizer_id'] = Auth::guard('organizer')->user()->id;
    $in['email_verified_at'] = now();

    $promoter = Promoter::create($in);

    $languages = Language::get();
    
    foreach ($languages as $language) {
        
      $promoter_info = PromoterInfo::where('promoter_id', $promoter->id)->where('language_id', $language->id)->first();
      
      if (!$promoter_info) {
        $promoter_info = new PromoterInfo();
        $promoter_info->language_id = $language->id;
        $promoter_info->promoter_id = $promoter->id;
      }
      
      $promoter_info->name = $request[$language->code . '_name'];
      $promoter_info->designation = $request[$language->code . '_designation'];
      $promoter_info->country = $request[$language->code . '_country'];
      $promoter_info->city = $request[$language->code . '_city'];
      $promoter_info->state = $request[$language->code . '_state'];
      $promoter_info->zip_code = $request[$language->code . '_zip_code'];
      $promoter_info->address = $request[$language->code . '_address'];
      $promoter_info->details = $request[$language->code . '_details'];
      $promoter_info->save();
    }
    
    Session::flash('success', 'Added Successfully!');
    return Response::json(['status' => 'success'], 200);
  }

  public function updateEmailStatus(Request $request, $id)
  {
    $promoter = Promoter::find($id);
    if ($request->email_status == 1) {
      $promoter->update(['email_verified_at' => now()]);
    } else {
      $promoter->update(['email_verified_at' => null]);
    }
    Session::flash('success', 'Update Email Verification Status Successfully!');

    return redirect()->back();
  }

  public function show($id)
  {

    $information['langs'] = Language::all();

    $language = Language::where('code', request()->input('language'))->firstOrFail();
    $information['language'] = $language;

    $event_type = request()->input('event_type');
    
    $promoter = Promoter::findOrFail($id);

    $events = Event::join('event_contents', 'event_contents.event_id', '=', 'events.id')
      ->join('event_categories', 'event_categories.id', '=', 'event_contents.event_category_id')
      ->where('event_contents.language_id', '=', $language->id)
      ->where('events.organizer_id', '=', $promoter->organizer_id)
      ->when($event_type, function ($query, $event_type) {
        return $query->where('events.event_type', $event_type);
      })
      ->select('events.*', 'event_contents.id as eventInfoId', 'event_contents.title', 'event_categories.name as category', 'event_contents.slug')
      ->orderByDesc('events.id')
      ->get();

    $information['events'] = $events;
    $information['promoter'] = $promoter;

    return view('organizer.end-user.promoter.details', $information);
  }
  
  public function updateAccountStatus(Request $request, $id)
  {

    $user = Promoter::find($id);
    if ($request->account_status == 1) {
      $user->update(['status' => 1]);
    } else {
      $user->update(['status' => 0]);
    }
    Session::flash('success', 'Updated Successfully');

    return redirect()->back();
  }
  
  public function changePassword($id)
  {
    $userInfo = Promoter::findOrFail($id);

    return view('organizer.end-user.promoter.change-password', compact('userInfo'));
  }
  
  public function updatePassword(Request $request, $id)
  {
    $rules = [
      'new_password' => 'required|confirmed',
      'new_password_confirmation' => 'required'
    ];

    $messages = [
      'new_password.confirmed' => 'Password confirmation does not match.',
      'new_password_confirmation.required' => 'The confirm new password field is required.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return Response::json([
        'errors' => $validator->getMessageBag()->toArray()
      ], 400);
    }

    $user = Promoter::find($id);

    $user->update([
      'password' => Hash::make($request->new_password)
    ]);

    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  public function edit($id)
  {
    $information = [];
    $languages = Language::get();
    $promoter = Promoter::findOrFail($id);
    $information['promoter'] = $promoter;
    $information['currencyInfo'] = $this->getCurrencyInfo();
    $information['languages'] = $languages;
    return view('organizer.end-user.promoter.edit', $information);
  }

  //update
  public function update(Request $request, $id, promoter $promoter)
  {
    try {
      $rules = [
        'email' => [
          'required',
          Rule::unique('promoter', 'username')->ignore($id)
        ],
        'username' => [
          'required',
          'alpha_dash',
          "not_in:$this->admin_user_name",
          Rule::unique('promoter', 'username')->ignore($id)
        ],
      ];

      $languages = Language::get();

      $messages = [];
      foreach ($languages as $language) {
        $rules[$language->code . '_name'] = 'required';
        $messages[$language->code . '_name'] = 'The name field is required for ' . $language->name . ' language.';
      }

      if ($request->hasFile('photo')) {
        $rules['photo']  = 'dimensions:width=300,height=300';
      }

      $validator = Validator::make($request->all(), $rules, $messages);
      
      if ($validator->fails()) {
        return Response::json(
          [
            'errors' => $validator->getMessageBag()
          ],
          400
        );
      }
      
      $in = $request->all();
      $promoter  = Promoter::where('id', $id)->first();
      $file = $request->file('photo');
      if ($file) {
        $extension = $file->getClientOriginalExtension();
        $directory = public_path('assets/admin/img/promoter-photo/');
        $fileName = uniqid() . '.' . $extension;
        @mkdir($directory, 0775, true);
        $file->move($directory, $fileName);
        
        @unlink(public_path('assets/admin/img/promoter-photo/') . $promoter->photo);
        $in['photo'] = $fileName;
      }
      
      $promoter->update($in);
      
      $languages = Language::get();
      foreach ($languages as $language) {
        
        $promoter_info = PromoterInfo::where('organizer_id', $promoter->id)->where('language_id', $language->id)->first();
        
        if (!$promoter_info) {
          $promoter_info = new PromoterInfo();
          $promoter_info->language_id = $language->id;
          $promoter_info->promoter_id = $promoter->id;
        }
        
        $promoter_info->name = $request[$language->code . '_name'];
        $promoter_info->designation = $request[$language->code . '_designation'];
        $promoter_info->country = $request[$language->code . '_country'];
        $promoter_info->city = $request[$language->code . '_city'];
        $promoter_info->state = $request[$language->code . '_state'];
        $promoter_info->zip_code = $request[$language->code . '_zip_code'];
        $promoter_info->address = $request[$language->code . '_address'];
        $promoter_info->details = $request[$language->code . '_details'];
        $promoter_info->save();
      }
    } catch (\Exception $th) {
    }
    Session::flash('success', 'Updated Successfully');

    return Response::json(['status' => 'success'], 200);
  }
 
  public function destroy($id)
  {
    $promoter = Promoter::find($id);

    $promoter->delete();

    return redirect()->back()->with('success', 'Deleted Successfully');
  }
  
  public function bulkDestroy(Request $request)
  {
    $ids = $request->ids;

    foreach ($ids as $id) {
      $promoter = Promoter::find($id);

      $withdraws = $promoter->withdraws()->get();
      foreach ($withdraws as $withdraw) {
        $withdraw->delete();
      }

      $promoter->delete();
    }

    Session::flash('success', 'Deleted Successfully');

    return Response::json(['status' => 'success'], 200);
  }

  //secrtet login
  public function secret_login($id)
  {
    Session::put('secret_login', 1);
    $promoter = Promoter::where('id', $id)->first();
    Auth::guard('promoter')->login($promoter);
    return redirect()->route('promoter.dashboard');
  }

  //update_organizer_balance
  public function send_mail_template()
  {
    //mail sending
    // get the website title & mail's smtp information from db
    $info = Basic::select('website_title', 'smtp_status', 'smtp_host', 'smtp_port', 'encryption', 'smtp_username', 'smtp_password', 'from_mail', 'from_name', 'base_currency_symbol_position', 'base_currency_symbol')
      ->first();

    //preparing mail info

    // get the website title info from db
    $website_info = Basic::select('website_title')->first();

    $websiteTitle = $website_info->website_title;

    // replacing with actual data
    $view = View::make('backend.template-view.index');
    $mailData['subject'] = 'Test Mail Tempate Subject';
    $mailData['body'] = $view;

    $mailData['recipient'] = 'fahadahmadshemul@gmail.com';
    //preparing mail info end

    // initialize a new mail
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    // if smtp status == 1, then set some value for PHPMailer
    if ($info->smtp_status == 1) {
      $mail->isSMTP();
      $mail->Host       = $info->smtp_host;
      $mail->SMTPAuth   = true;
      $mail->Username   = $info->smtp_username;
      $mail->Password   = $info->smtp_password;

      if ($info->encryption == 'TLS') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      }

      $mail->Port       = $info->smtp_port;
    }

    // add other informations and send the mail
    try {
      $mail->setFrom($info->from_mail, $info->from_name);
      $mail->addAddress($mailData['recipient']);

      $mail->isHTML(true);
      $mail->Subject = $mailData['subject'];
      $mail->Body = $mailData['body'];

      $mail->send();
      return 'mail send';
    } catch (Exception $e) {
      return $e;
    }
    //mail sending end
  }
}
