<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Interface Routes
|--------------------------------------------------------------------------
*/

Route::get('organizer/pwa/', 'BackEnd\Organizer\OrganizerController@pwa')->name('organizer.pwa');
Route::post('organizer/check-qrcode/', 'BackEnd\Organizer\OrganizerController@check_qrcode')->name('check-qrcode');

Route::get('organizers/email/verify', 'BackEnd\Organizer\OrganizerController@confirm_email');

Route::prefix('/organizer')->group(function () {
  Route::middleware('guest:organizer', 'change.lang', 'adminLang')->group(function () {
    Route::get('/login', 'BackEnd\Organizer\OrganizerController@login')->name('organizer.login');
    Route::get('/signup', 'BackEnd\Organizer\OrganizerController@signup')->name('organizer.signup');
    Route::post('/create', 'BackEnd\Organizer\OrganizerController@create')->name('organizer.create');
    Route::post('/store', 'BackEnd\Organizer\OrganizerController@authentication')->name('organizer.authentication');
    Route::get('/forget-password', 'BackEnd\Organizer\OrganizerController@forget_passord')->name('organizer.forget.password');
    Route::post('/send-forget-mail', 'BackEnd\Organizer\OrganizerController@forget_mail')->name('organizer.forget.mail');
    Route::get('/reset-password', 'BackEnd\Organizer\OrganizerController@reset_password')->name('organizer.reset.password');
    Route::post('/update-forget-password', 'BackEnd\Organizer\OrganizerController@update_password')->name('organizer.update-forget-password');
  });

  Route::get('/logout', 'BackEnd\Organizer\OrganizerController@logout')->name('organizer.logout');
  Route::get('/change-password', 'BackEnd\Organizer\OrganizerController@change_password')->name('organizer.change.password');
  Route::post('/update-password', 'BackEnd\Organizer\OrganizerController@updated_password')->name('organizer.update_password');
});

Route::prefix('/organizer')->middleware('auth:organizer', 'Deactive:organizer', 'EmailStatus:organizer', 'adminLang')->group(function () {
  Route::get('/dashboard', 'BackEnd\Organizer\OrganizerController@index')->name('organizer.dashboard');
  Route::get('monthly-income', 'BackEnd\Organizer\OrganizerController@monthly_income')->name('organizer.monthly_income');
  Route::get('/transaction', 'BackEnd\Organizer\OrganizerController@transaction')->name('organizer.transcation');
  Route::post('/transcation/delete', 'BackEnd\Organizer\OrganizerController@destroy')->name('organizer.transcation.delete');
  Route::post('/transcation/bulk-delete', 'BackEnd\Organizer\OrganizerController@bulk_destroy')->name('organizer.transcation.bulk_delete');
  
  // Whats Connect Routes
  Route::get('/whats-connect', 'BackEnd\Organizer\WhatsConnectController@index')->name('organizer.device.dashboard');
  Route::post('/whats-connect/device/create', 'BackEnd\Organizer\WhatsConnectController@store')->name('organizer.create.device');
  Route::post('/whats-connect/device/create/app', 'BackEnd\Organizer\WhatsConnectController@createApp')->name('organizer.create.app');
  Route::post('/whats-connect/device/logout/session', 'BackEnd\Organizer\WhatsConnectController@logoutSession')->name('organizer.logout.device');

  // change admin-panel theme (dark/light) route
  Route::post('/change-theme', 'BackEnd\Organizer\OrganizerController@changeTheme')->name('organizer.change_theme');

  Route::get('/edit-profile', 'BackEnd\Organizer\OrganizerController@edit_profile')->name('organizer.edit.profile');
  Route::post('/organizer-update-profile', 'BackEnd\Organizer\OrganizerController@update_profile')->name('organizer.update_profile');

  Route::get('/verify/email', 'BackEnd\Organizer\OrganizerController@verify_email')->name('organizer.verify.email');
  Route::post('/send-verify/link', 'BackEnd\Organizer\OrganizerController@send_link')->name('organizer.send.verify.link');
  Route::get('/email/verify', 'BackEnd\Organizer\OrganizerController@confirm_email');

  Route::get('event-management/events/', 'BackEnd\Organizer\EventController@index')->name('organizer.event_management.event');
  Route::get('choose-event-type/', 'BackEnd\Organizer\EventController@choose_event_type')->name('choose-event-type');
  Route::get('add-event/', 'BackEnd\Organizer\EventController@add_event')->name('organizer.add.event.event');
  Route::post('event-imagesstore', 'BackEnd\Organizer\EventController@gallerystore')->name('organizer.event.imagesstore');
  Route::post('event-imagermv', 'BackEnd\Organizer\EventController@imagermv')->name('organizer.event.imagermv');
  Route::post('event-store', 'BackEnd\Organizer\EventController@store')->name('organizer.event_management.store_event');
  Route::post('/event/{id}/update-status', 'BackEnd\Organizer\EventController@updateStatus')->name('organizer.event_management.event.event_status');
  Route::post('/event/{id}/update-featured', 'BackEnd\Organizer\EventController@updateFeatured')->name('organizer.event_management.event.update_featured');
  Route::post('/delete-event/{id}', 'BackEnd\Organizer\EventController@destroy')->name('organizer.event_management.delete_event');
  Route::get('/edit-event/{id}', 'BackEnd\Organizer\EventController@edit')->name('organizer.event_management.edit_event');
  Route::post('/event-img-dbrmv', 'BackEnd\Organizer\EventController@imagedbrmv')->name('organizer.event.imgdbrmv');
  Route::get('/event-images/{id}', 'BackEnd\Organizer\EventController@images')->name('organizer.event.images');
  Route::post('/event-update', 'BackEnd\Organizer\EventController@update')->name('organizer.event.update');
  Route::post('bulk/delete/event', 'BackEnd\Organizer\EventController@bulk_delete')->name('organizer.event_management.bulk_delete_event');


  Route::get('event/ticket', 'BackEnd\Organizer\TicketController@index')->name('organizer.event.ticket');
  Route::get('event/add-ticket', 'BackEnd\Organizer\TicketController@create')->name('organizer.event.add.ticket');
  Route::post('event/ticket/store-ticket', 'BackEnd\Organizer\TicketController@store')->name('organizer.ticket_management.store_ticket');
  Route::get('event/edit/ticket', 'BackEnd\Organizer\TicketController@edit')->name('organizer.event.edit.ticket');
  Route::post('event/ticket/delete-ticket', 'BackEnd\Organizer\TicketController@destroy')->name('organizer.ticket_management.delete_ticket');
  Route::get('delete-variation/{id}', 'BackEnd\Organizer\TicketController@delete_variation')->name('organizer.delete.variation');
  Route::post('ticket_management/update/ticket', 'BackEnd\Organizer\TicketController@update')->name('organizer.ticket_management.update_ticket');
  Route::post('bulk/delete/bulk/event/ticket', 'BackEnd\Organizer\TicketController@bulk_delete')->name('organizer.event_management.bulk_delete_event_ticket');

  Route::get('withdraw', 'BackEnd\Organizer\OrganizerWithdrawController@index')->name('organizer.withdraw');
  Route::get('withdraw/create', 'BackEnd\Organizer\OrganizerWithdrawController@create')->name('organizer.withdraw.create');
  Route::get('/get-withdraw-method/input/{id}', 'BackEnd\Organizer\OrganizerWithdrawController@get_inputs');

  Route::get('withdraw/balance-calculation/{method}/{amount}', 'BackEnd\Organizer\OrganizerWithdrawController@balance_calculation');

  Route::post('/withdraw/send-request', 'BackEnd\Organizer\OrganizerWithdrawController@send_request')->name('organizer.withdraw.send-request');
  Route::post('/withdraw/witdraw/bulk-delete', 'BackEnd\Organizer\OrganizerWithdrawController@bulkDelete')->name('organizer.witdraw.bulk_delete_withdraw');
  Route::post('/withdraw/witdraw/delete', 'BackEnd\Organizer\OrganizerWithdrawController@Delete')->name('organizer.witdraw.delete_withdraw');

  Route::get('event-booking', 'BackEnd\Organizer\EventBookingController@index')->name('organizer.event.booking');
  Route::post('event-booking/update/payment-status/{id}', 'BackEnd\Organizer\EventBookingController@updatePaymentStatus')->name('organizer.event_booking.update_payment_status');
  Route::get('event-booking/details/{id}', 'BackEnd\Organizer\EventBookingController@show')->name('organizer.event_booking.details');
  Route::post('/{id}/delete', 'BackEnd\Organizer\EventBookingController@destroy')->name('organizer.event_booking.delete');
  Route::post('/event-booking/bulk-delete', 'BackEnd\Organizer\EventBookingController@bulkDestroy')->name('organizer.event_booking.bulk_delete');
  Route::get('/event-booking/report', 'BackEnd\Organizer\EventBookingController@report')->name('organizer.event_booking.report');
  Route::get('/event-booking/export', 'BackEnd\Organizer\EventBookingController@export')->name('organizer.event_bookings.export');
  
  /*
  |---------------------------------------------
  |scanner management
  |---------------------------------------------
  */
  
  Route::prefix('scanner-management')->group(function () {
    Route::get('/settings', 'BackEnd\Organizer\ScannerManagementController@settings')->name('organizer.scanner_management.settings');
    Route::post('/settings/update', 'BackEnd\Organizer\ScannerManagementController@update_setting')->name('organizer.scanner_management.setting.update');
    
    Route::get('/add-scanner', 'BackEnd\Organizer\ScannerManagementController@add')->name('organizer.scanner_management.add_scanner');
    Route::post('/save-scanner', 'BackEnd\Organizer\ScannerManagementController@create')->name('organizer.scanner_management.save-scanner');
    
    Route::get('/registered-scanners', 'BackEnd\Organizer\ScannerManagementController@index')->name('organizer.scanner_management.registered_scanner');

    Route::prefix('/scanner/{id}')->group(function () {
      Route::post('/update-email-status', 'BackEnd\Organizer\ScannerManagementController@updateEmailStatus')->name('organizer.scanner_management.scanner.update_email_status');
    
      Route::post('/update-account-status', 'BackEnd\Organizer\ScannerManagementController@updateAccountStatus')->name('organizer.scanner_management.scanner.update_account_status');
    
      Route::get('/details', 'BackEnd\Organizer\ScannerManagementController@show')->name('organizer.scanner_management.scanner_details');
    
      Route::get('/edit', 'BackEnd\Organizer\ScannerManagementController@edit')->name('organizer.edit_management.scanner_edit');
    
      Route::post('/update', 'BackEnd\Organizer\ScannerManagementController@update')->name('organizer.scanner_management.scanner.update_scanner');
    
      Route::get('/change-password', 'BackEnd\Organizer\ScannerManagementController@changePassword')->name('organizer.scanner_management.scanner.change_password');
    
      Route::post('/update-password', 'BackEnd\Organizer\ScannerManagementController@updatePassword')->name('organizer.organizer_management.scanner.update_password');
    
      Route::post('/delete', 'BackEnd\Organizer\ScannerManagementController@destroy')->name('organizer.scanner_management.scanner.delete');
    
      Route::get('/secret-login', 'BackEnd\Organizer\ScannerManagementController@secret_login')->name('organizer.scanner_management.scanner.secret_login');
    });
    
    Route::post('/bulk-delete-user', 'BackEnd\Organizer\ScannerManagementController@bulkDestroy')->name('organizer.scanner_management.bulk_delete_scanner');
  });
  
  /*
  |---------------------------------------------
  |promoter management
  |---------------------------------------------
  */
  
  Route::prefix('promoter-management')->group(function () {
    Route::get('/settings', 'BackEnd\Organizer\PromoterManagementController@settings')->name('organizer.promoter_management.settings');
    Route::post('/settings/update', 'BackEnd\Organizer\PromoterManagementController@update_setting')->name('organizer.promoter_management.setting.update');
    
    Route::get('/add-promoter', 'BackEnd\Organizer\PromoterManagementController@add')->name('organizer.promoter_management.add_promoter');
    Route::post('/save-promoter', 'BackEnd\Organizer\PromoterManagementController@create')->name('organizer.promoter_management.save-promoter');
    
    Route::get('/registered-promoters', 'BackEnd\Organizer\PromoterManagementController@index')->name('organizer.promoter_management.registered_promoter');

    Route::prefix('/promoter/{id}')->group(function () {
      Route::post('/update-email-status', 'BackEnd\Organizer\PromoterManagementController@updateEmailStatus')->name('organizer.promoter_management.promoter.update_email_status');
    
      Route::post('/update-account-status', 'BackEnd\Organizer\PromoterManagementController@updateAccountStatus')->name('organizer.promoter_management.promoter.update_account_status');
    
      Route::get('/details', 'BackEnd\Organizer\PromoterManagementController@show')->name('organizer.promoter_management.promoter_details');
    
      Route::get('/edit', 'BackEnd\Organizer\PromoterManagementController@edit')->name('organizer.edit_management.promoter_edit');
    
      Route::post('/update', 'BackEnd\Organizer\PromoterManagementController@update')->name('organizer.promoter_management.promoter.update_promoter');
    
      Route::get('/change-password', 'BackEnd\Organizer\PromoterManagementController@changePassword')->name('organizer.promoter_management.promoter.change_password');
    
      Route::post('/update-password', 'BackEnd\Organizer\PromoterManagementController@updatePassword')->name('organizer.organizer_management.promoter.update_password');
    
      Route::post('/delete', 'BackEnd\Organizer\PromoterManagementController@destroy')->name('organizer.promoter_management.promoter.delete');
    
      Route::get('/secret-login', 'BackEnd\Organizer\PromoterManagementController@secret_login')->name('organizer.promoter_management.promoter.secret_login');
    });
    
    Route::post('/bulk-delete-user', 'BackEnd\Organizer\PromoterManagementController@bulkDestroy')->name('organizer.promoter_management.bulk_delete_promoter');
  });
  
  /*
  |---------------------------------------------
  |shop management
  |---------------------------------------------
  */
  
  Route::prefix('shop-management')->group(function () {
    Route::get('/coupon', 'BackEnd\ShopManagement\ShopCouponController@index')->name('organizer.shop_management.coupon');
    Route::post('/coupon/store', 'BackEnd\ShopManagement\ShopCouponController@store')->name('organizer.shop_management.store_coupon');
    Route::put('/coupon/update', 'BackEnd\ShopManagement\ShopCouponController@update')->name('organizer.shop_management.update_coupon');
    Route::post('/coupon/delete', 'BackEnd\ShopManagement\ShopCouponController@destroy')->name('organizer.shop_management.delete_coupon');
    Route::post('/coupon/bulk-delete', 'BackEnd\ShopManagement\ShopCouponController@bulk_destroy')->name('organizer.shop_management.bulk_delete_coupon');

    Route::get('/category', 'BackEnd\ShopManagement\CategoryController@index')->name('organizer.shop_management.category');
    Route::post('/category/store', 'BackEnd\ShopManagement\CategoryController@store')->name('organizer.shop_management.store_category');
    Route::post('/category/update/feature/{id}', 'BackEnd\ShopManagement\CategoryController@update_featured')->name('organizer.shop_management.update_category_feature');
    Route::put('/category/update', 'BackEnd\ShopManagement\CategoryController@update')->name('organizer.shop_management.update_category');
    Route::post('/category/delete/{id}', 'BackEnd\ShopManagement\CategoryController@delete')->name('organizer.shop_management.delete_category');
    Route::post('/category/bulk-delete/', 'BackEnd\ShopManagement\CategoryController@bulk_delete')->name('organizer.shop_management.bulk_delete_category');

    Route::get('product/type', 'BackEnd\ShopManagement\ProductController@index')->name('organizer.shop_management.product_type');
    Route::get('product/create', 'BackEnd\ShopManagement\ProductController@create')->name('organizer.shop_management.product.create');
    Route::post('product/img-store', 'BackEnd\ShopManagement\ProductController@imgstore')->name('organizer.shop_management.product.imgstore');
    Route::post('product/img-remove', 'BackEnd\ShopManagement\ProductController@imgrmv')->name('organizer.shop_management.product.imgrmv');
    Route::post('product/store', 'BackEnd\ShopManagement\ProductController@store')->name('organizer.shop_management.product.store');
    Route::get('products', 'BackEnd\ShopManagement\ProductController@show')->name('organizer.shop_management.products');
    Route::post('product/status-update', 'BackEnd\ShopManagement\ProductController@status_update')->name('organizer.shop_management.product.status_update');
    Route::post('product/feature-update', 'BackEnd\ShopManagement\ProductController@feature_update')->name('organizer.shop_management.product.update_feature');
    Route::get('product/edit', 'BackEnd\ShopManagement\ProductController@edit')->name('organizer.shop_management.product.edit');
    Route::get('product/images/{id}', 'BackEnd\ShopManagement\ProductController@load_images')->name('organizer.shop_management.product.images');
    Route::post('product/destroy', 'BackEnd\ShopManagement\ProductController@destroy')->name('organizer.shop_management.product.destroy');
    Route::post('product/bulk-destroy', 'BackEnd\ShopManagement\ProductController@bulk_destroy')->name('organizer.shop_management.product.bulk_delete');

    Route::post('/product/img-dbrmv', 'BackEnd\ShopManagement\ProductController@imagedbrmv')->name('organizer.shop_management.imgdbrmv');
    Route::post('/product/update', 'BackEnd\ShopManagement\ProductController@update')->name('organizer.shop_management.product.update');

    Route::get('/orders', 'BackEnd\ShopManagement\ProductOrderController@index')->name('organizer.product.order');
    Route::post('/orders/delete/{id}', 'BackEnd\ShopManagement\ProductOrderController@delete')->name('organizer.product.order.delete');
    Route::post('/orders/bulk-delete/', 'BackEnd\ShopManagement\ProductOrderController@bulk_delete')->name('organizer.product.order.bulk_delete');
    Route::post('/orders/update-status/{id}', 'BackEnd\ShopManagement\ProductOrderController@updateStatus')->name('organizer.order.update_payment_status');

    Route::post('/orders/update-order-status/{id}', 'BackEnd\ShopManagement\ProductOrderController@updateOrderStatus')->name('organizer.order.update_order_status');

    Route::get('/order/details/{id}', 'BackEnd\ShopManagement\ProductOrderController@details')->name('organizer.product_order.details');

    Route::get('/product-order/report', 'BackEnd\ShopManagement\ProductOrderController@report')->name('organizer.product_order.report');
    Route::get('/product-order/export', 'BackEnd\ShopManagement\ProductOrderController@export')->name('organizer.product_order.export');
  });
  
  /*
  |---------------------------------------------
  |support language
  |---------------------------------------------
  */
  Route::prefix('/language-management')->group(function () {
    Route::get('/{id}/check-rtl', 'BackEnd\LanguageController@checkRTL');
  });

  /*
  |---------------------------------------------
  |support ticket
  |---------------------------------------------
  */


  Route::prefix('support-tikcet')->group(function () {
    Route::get('create', 'BackEnd\Organizer\SupportTicketController@create')->name('organizer.support_ticket.create');
    Route::post('/store', 'BackEnd\Organizer\SupportTicketController@store')->name('organizer.support_ticket.store');
    Route::get('tickets', 'BackEnd\Organizer\SupportTicketController@index')->name('organizer.support_tickets');
    Route::get('/message/{id}', 'BackEnd\Organizer\SupportTicketController@message')->name('organizer.support_tickets.message');
    Route::post('/zip-upload', 'BackEnd\Organizer\SupportTicketController@zip_file_upload')->name('organizer.support_ticket.zip_file.upload');
    Route::post('/reply/{id}', 'BackEnd\Organizer\SupportTicketController@ticketreply')->name('organizer.support_ticket.reply');

    Route::post('/delete/{id}', 'BackEnd\Organizer\SupportTicketController@delete')->name('organizer.support_tickets.delete');
    Route::post('/bulk/delete/', 'BackEnd\Organizer\SupportTicketController@bulk_delete')->name('organizer.support_tickets.bulk_delete');
  });
});
