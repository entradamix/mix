<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Interface Routes
|--------------------------------------------------------------------------
*/

Route::get('scanner/pwa/', 'BackEnd\Scanner\ScannerController@pwa')->name('scanner.pwa');
Route::post('scanner/check-qrcode/', 'BackEnd\Scanner\ScannerController@check_qrcode')->name('check-qrcode');

Route::get('scanners/email/verify', 'BackEnd\Scanner\ScannerController@confirm_email');

Route::prefix('/scanner')->group(function () {
  Route::middleware('guest:scanner', 'change.lang', 'adminLang')->group(function () {
    Route::get('/login', 'BackEnd\Scanner\ScannerController@login')->name('scanner.login');
    Route::get('/signup', 'BackEnd\Scanner\ScannerController@signup')->name('scanner.signup');
    Route::post('/create', 'BackEnd\Scanner\ScannerController@create')->name('scanner.create');
    Route::post('/store', 'BackEnd\Scanner\ScannerController@authentication')->name('scanner.authentication');
    Route::get('/forget-password', 'BackEnd\Scanner\ScannerController@forget_passord')->name('scanner.forget.password');
    Route::post('/send-forget-mail', 'BackEnd\Scanner\ScannerController@forget_mail')->name('scanner.forget.mail');
    Route::get('/reset-password', 'BackEnd\Scanner\ScannerController@reset_password')->name('scanner.reset.password');
    Route::post('/update-forget-password', 'BackEnd\Scanner\ScannerController@update_password')->name('scanner.update-forget-password');
  });

  Route::get('/logout', 'BackEnd\Scanner\ScannerController@logout')->name('scanner.logout');
  Route::get('/change-password', 'BackEnd\Scanner\ScannerController@change_password')->name('scanner.change.password');
  Route::post('/update-password', 'BackEnd\Scanner\ScannerController@updated_password')->name('scanner.update_password');
});

Route::prefix('/scanner')->middleware('auth:scanner', 'Deactive:scanner', 'EmailStatus:scanner', 'adminLang')->group(function () {
  Route::get('/dashboard', 'BackEnd\Scanner\ScannerController@index')->name('scanner.dashboard');
  Route::get('monthly-income', 'BackEnd\Scanner\ScannerController@monthly_income')->name('scanner.monthly_income');
  Route::get('/transaction', 'BackEnd\Scanner\ScannerController@transaction')->name('scanner.transcation');
  Route::post('/transcation/delete', 'BackEnd\Scanner\ScannerController@destroy')->name('scanner.transcation.delete');
  Route::post('/transcation/bulk-delete', 'BackEnd\Scanner\ScannerController@bulk_destroy')->name('scanner.transcation.bulk_delete');

  // change admin-panel theme (dark/light) route
  Route::post('/change-theme', 'BackEnd\Scanner\ScannerController@changeTheme')->name('scanner.change_theme');

  Route::get('/edit-profile', 'BackEnd\Scanner\ScannerController@edit_profile')->name('scanner.edit.profile');
  Route::post('/scanner-update-profile', 'BackEnd\Scanner\ScannerController@update_profile')->name('scanner.update_profile');

  Route::get('/verify/email', 'BackEnd\Scanner\ScannerController@verify_email')->name('scanner.verify.email');
  Route::post('/send-verify/link', 'BackEnd\Scanner\ScannerController@send_link')->name('scanner.send.verify.link');
  Route::get('/email/verify', 'BackEnd\Scanner\ScannerController@confirm_email');

  Route::get('event-booking', 'BackEnd\Scanner\EventBookingController@index')->name('scanner.event.booking');
  Route::post('event-booking/update/payment-status/{id}', 'BackEnd\Scanner\EventBookingController@updatePaymentStatus')->name('scanner.event_booking.update_payment_status');
  Route::get('event-booking/details/{id}', 'BackEnd\Scanner\EventBookingController@show')->name('scanner.event_booking.details');
  Route::post('/{id}/delete', 'BackEnd\Scanner\EventBookingController@destroy')->name('scanner.event_booking.delete');
  Route::post('/event-booking/bulk-delete', 'BackEnd\Scanner\EventBookingController@bulkDestroy')->name('scanner.event_booking.bulk_delete');
  Route::get('/event-booking/report', 'BackEnd\Scanner\EventBookingController@report')->name('scanner.event_booking.report');
  Route::get('/event-booking/export', 'BackEnd\Scanner\EventBookingController@export')->name('scanner.event_bookings.export');

  /*
  |---------------------------------------------
  |support ticket
  |---------------------------------------------
  */

  Route::prefix('support-tikcet')->group(function () {
    Route::get('create', 'BackEnd\Scanner\SupportTicketController@create')->name('scanner.support_ticket.create');
    Route::post('/store', 'BackEnd\Scanner\SupportTicketController@store')->name('scanner.support_ticket.store');
    Route::get('tickets', 'BackEnd\Scanner\SupportTicketController@index')->name('scanner.support_tickets');
    Route::get('/message/{id}', 'BackEnd\Scanner\SupportTicketController@message')->name('scanner.support_tickets.message');
    Route::post('/zip-upload', 'BackEnd\Scanner\SupportTicketController@zip_file_upload')->name('scanner.support_ticket.zip_file.upload');
    Route::post('/reply/{id}', 'BackEnd\Scanner\SupportTicketController@ticketreply')->name('scanner.support_ticket.reply');

    Route::post('/delete/{id}', 'BackEnd\Scanner\SupportTicketController@delete')->name('scanner.support_tickets.delete');
    Route::post('/bulk/delete/', 'BackEnd\Scanner\SupportTicketController@bulk_delete')->name('scanner.support_tickets.bulk_delete');
  });
});
