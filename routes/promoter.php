<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Interface Routes
|--------------------------------------------------------------------------
*/

Route::post('promoter/check-qrcode/', 'BackEnd\Promoter\PromoterController@check_qrcode')->name('check-qrcode');

Route::get('promoters/email/verify', 'BackEnd\Promoter\PromoterController@confirm_email');

Route::prefix('/promoter')->group(function () {
  Route::middleware('guest:promoter', 'change.lang', 'adminLang')->group(function () {
    Route::get('/login', 'BackEnd\Promoter\PromoterController@login')->name('promoter.login');
    Route::get('/signup', 'BackEnd\Promoter\PromoterController@signup')->name('promoter.signup');
    Route::post('/create', 'BackEnd\Promoter\PromoterController@create')->name('promoter.create');
    Route::post('/store', 'BackEnd\Promoter\PromoterController@authentication')->name('promoter.authentication');
    Route::get('/forget-password', 'BackEnd\Promoter\PromoterController@forget_passord')->name('promoter.forget.password');
    Route::post('/send-forget-mail', 'BackEnd\Promoter\PromoterController@forget_mail')->name('promoter.forget.mail');
    Route::get('/reset-password', 'BackEnd\Promoter\PromoterController@reset_password')->name('promoter.reset.password');
    Route::post('/update-forget-password', 'BackEnd\Promoter\PromoterController@update_password')->name('promoter.update-forget-password');
  });

  Route::get('/logout', 'BackEnd\Promoter\PromoterController@logout')->name('promoter.logout');
  Route::get('/change-password', 'BackEnd\Promoter\PromoterController@change_password')->name('promoter.change.password');
  Route::post('/update-password', 'BackEnd\Promoter\PromoterController@updated_password')->name('promoter.update_password');
});

Route::prefix('/promoter')->middleware('auth:promoter', 'Deactive:promoter', 'EmailStatus:promoter', 'adminLang')->group(function () {
  Route::get('/dashboard', 'BackEnd\Promoter\PromoterController@index')->name('promoter.dashboard');
  Route::get('monthly-income', 'BackEnd\Promoter\PromoterController@monthly_income')->name('promoter.monthly_income');
  Route::get('/transaction', 'BackEnd\Promoter\PromoterController@transaction')->name('promoter.transcation');
  Route::post('/transcation/delete', 'BackEnd\Promoter\PromoterController@destroy')->name('promoter.transcation.delete');
  Route::post('/transcation/bulk-delete', 'BackEnd\Promoter\PromoterController@bulk_destroy')->name('promoter.transcation.bulk_delete');

  // change admin-panel theme (dark/light) route
  Route::post('/change-theme', 'BackEnd\Promoter\PromoterController@changeTheme')->name('promoter.change_theme');

  Route::get('/edit-profile', 'BackEnd\Promoter\PromoterController@edit_profile')->name('promoter.edit.profile');
  Route::post('/promoter-update-profile', 'BackEnd\Promoter\PromoterController@update_profile')->name('promoter.update_profile');

  Route::get('/verify/email', 'BackEnd\Promoter\PromoterController@verify_email')->name('promoter.verify.email');
  Route::post('/send-verify/link', 'BackEnd\Promoter\PromoterController@send_link')->name('promoter.send.verify.link');
  Route::get('/email/verify', 'BackEnd\Promoter\PromoterController@confirm_email');

  Route::get('event-booking', 'BackEnd\Promoter\EventBookingController@index')->name('promoter.event.booking');
  Route::post('event-booking/update/payment-status/{id}', 'BackEnd\Promoter\EventBookingController@updatePaymentStatus')->name('promoter.event_booking.update_payment_status');
  Route::get('event-booking/details/{id}', 'BackEnd\Promoter\EventBookingController@show')->name('promoter.event_booking.details');
  Route::post('/{id}/delete', 'BackEnd\Promoter\EventBookingController@destroy')->name('promoter.event_booking.delete');
  Route::post('/event-booking/bulk-delete', 'BackEnd\Promoter\EventBookingController@bulkDestroy')->name('promoter.event_booking.bulk_delete');
  Route::get('/event-booking/report', 'BackEnd\Promoter\EventBookingController@report')->name('promoter.event_booking.report');
  Route::get('/event-booking/export', 'BackEnd\Promoter\EventBookingController@export')->name('promoter.event_bookings.export');

  /*
  |---------------------------------------------
  |support ticket
  |---------------------------------------------
  */

  Route::prefix('support-tikcet')->group(function () {
    Route::get('create', 'BackEnd\Promoter\SupportTicketController@create')->name('promoter.support_ticket.create');
    Route::post('/store', 'BackEnd\Promoter\SupportTicketController@store')->name('promoter.support_ticket.store');
    Route::get('tickets', 'BackEnd\Promoter\SupportTicketController@index')->name('promoter.support_tickets');
    Route::get('/message/{id}', 'BackEnd\Promoter\SupportTicketController@message')->name('promoter.support_tickets.message');
    Route::post('/zip-upload', 'BackEnd\Promoter\SupportTicketController@zip_file_upload')->name('promoter.support_ticket.zip_file.upload');
    Route::post('/reply/{id}', 'BackEnd\Promoter\SupportTicketController@ticketreply')->name('promoter.support_ticket.reply');

    Route::post('/delete/{id}', 'BackEnd\Promoter\SupportTicketController@delete')->name('promoter.support_tickets.delete');
    Route::post('/bulk/delete/', 'BackEnd\Promoter\SupportTicketController@bulk_delete')->name('promoter.support_tickets.bulk_delete');
  });
});
