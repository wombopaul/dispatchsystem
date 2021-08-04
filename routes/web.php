<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});


/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetCodeEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify.code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.form');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });

     Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('branch-manager/{id}', 'AdminController@branchManager')->name('manager.branch');
        Route::get('branch/courier/list/{id}', 'AdminController@branchCourierList')->name('branch.courier.list');
        Route::get('branch/courier/delivery/list/{id}', 'AdminController@branchCourierDelivery')->name('branch.courier.delivery.list');

        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        //Notification
        Route::get('notifications','AdminController@notifications')->name('notifications');
        Route::get('notification/read/{id}','AdminController@notificationRead')->name('notification.read');
        Route::get('notifications/read-all','AdminController@readAll')->name('notifications.readAll');

        //Report Bugs
        Route::get('request-report','AdminController@requestReport')->name('request.report');
        Route::post('request-report','AdminController@reportSubmit');
        Route::get('system-info','AdminController@systemInfo')->name('system.info');

        // Branch
        Route::get('branch/list', 'BranchController@index')->name('branch.index');
        Route::post('branch/store', 'BranchController@store')->name('branch.store');
        Route::post('branch/update', 'BranchController@update')->name('branch.update');

        //Branch Manager 
        Route::get('branch/manager/list', 'BranchManagerController@index')->name('branch.manager.index');
        Route::get('branch/manager/create', 'BranchManagerController@create')->name('branch.manager.create');
        Route::post('branch/manager/store', 'BranchManagerController@store')->name('branch.manager.store');
        Route::get('branch/manager/edit/{id}', 'BranchManagerController@edit')->name('branch.manager.edit');
        Route::post('branch/manager/update/{id}', 'BranchManagerController@update')->name('branch.manager.update');
        Route::get('branch/manager/staff/{id}', 'BranchManagerController@staffList')->name('branch.manager.staff.list');

        // Couier Setting
        Route::get('manage/unit/', 'CourierSettingController@unitIndex')->name('unit.index');
        Route::post('manage/unit/store', 'CourierSettingController@unitStore')->name('unit.store');
        Route::post('manage/unit/update', 'CourierSettingController@unitUpdate')->name('unit.update');
        Route::get('manage/type', 'CourierSettingController@typeIndex')->name('unit.type.index');
        Route::post('manage/type/store', 'CourierSettingController@typeStore')->name('unit.type.store');
        Route::post('manage/type/update', 'CourierSettingController@typeUpdate')->name('unit.type.update');

        Route::get('courier/list', 'CourierSettingController@courierInfo')->name('courier.info.index');
        Route::get('courier/details/{id}', 'CourierSettingController@courierDetail')->name('courier.info.details');
        Route::get('courier/invoice/{id}', 'CourierSettingController@invoice')->name('courier.invoice');
        Route::get('courier/date/search', 'CourierSettingController@courierDateSearch')->name('courier.date.search');
        Route::get('branch/income', 'CourierSettingController@branchIncome')->name('branch.income');
        Route::get('branch/income/date/search', 'CourierSettingController@branchIncomeDateSearch')->name('branch.income.date.search');
       

        // Report
        Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');
        Route::get('report/email/history', 'ReportController@emailHistory')->name('report.email.history');
        Route::get('report/email/details/{id}', 'ReportController@emailDetails')->name('report.email.details');

        // Admin Support
        Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
        Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
        Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
        Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
        Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
        Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');

        // Language Manager
        Route::get('/language', 'LanguageController@langManage')->name('language.manage');
        Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
        Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
        Route::post('/language/update/{id}', 'LanguageController@langUpdate')->name('language.manage.update');
        Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
        Route::post('/language/import', 'LanguageController@langImport')->name('language.importLang');

        Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
        Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
        Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');

        // General Setting
        Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
        Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');
        Route::get('optimize', 'GeneralSettingController@optimize')->name('setting.optimize');

        // Logo-Icon
        Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo.icon');
        Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo.icon');

        //Custom CSS
        Route::get('custom-css','GeneralSettingController@customCss')->name('setting.custom.css');
        Route::post('custom-css','GeneralSettingController@customCssSubmit');

        //Cookie
        Route::get('cookie','GeneralSettingController@cookie')->name('setting.cookie');
        Route::post('cookie','GeneralSettingController@cookieSubmit');

        // Plugin
        Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
        Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
        Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
        Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');

        // Email Setting
        Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
        Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
        Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
        Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
        Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
        Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
        Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
        Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.test.mail');

        // SMS Setting
        Route::get('sms-template/global', 'SmsTemplateController@smsTemplate')->name('sms.template.global');
        Route::post('sms-template/global', 'SmsTemplateController@smsTemplateUpdate')->name('sms.template.global');
        Route::get('sms-template/setting','SmsTemplateController@smsSetting')->name('sms.templates.setting');
        Route::post('sms-template/setting', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.setting');
        Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
        Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
        Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
        Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.test.sms');
        // SEO
        Route::get('seo', 'FrontendController@seoEdit')->name('seo');

        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {
            Route::get('templates', 'FrontendController@templates')->name('templates');
            Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');
            Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
            Route::post('remove', 'FrontendController@remove')->name('remove');

            // Page Builder
            Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
            Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
        });
     });
});

/*
|--------------------------------------------------------------------------
| Start Manager Area
|--------------------------------------------------------------------------
*/

Route::namespace('Manager')->name('manager.')->prefix('manager')->group(function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetCodeEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code.verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify.code');

    // Route::middleware('auth')->group(function () {
        Route::middleware(['checkStatus'])->group(function () {
            Route::middleware('manager')->group(function () {
                Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
                Route::get('profile', 'HomeController@profile')->name('profile');
                Route::post('profile/update', 'HomeController@profileUpdate')->name('profile.update');
                Route::get('password', 'HomeController@password')->name('password');
                Route::post('password/update', 'HomeController@passwordUpdate')->name('password.update.data');

                Route::get('branch/list', 'HomeController@branchList')->name('branch.index');
                Route::get('branch/search', 'HomeController@branchSearch')->name('branch.search');

                Route::get('courier/list', 'HomeController@courierInfo')->name('courier.index');
                Route::get('dispatch/courier/list', 'HomeController@sendCourier')->name('courier.dispatch');
                Route::get('upcoming/courier/list', 'HomeController@receivedCourier')->name('courier.upcoming');
                Route::get('courier/search/date/{scope}', 'HomeController@courierSearchDate')->name('courier.search.date');
                Route::get('courier/search', 'HomeController@courierSearch')->name('courier.search');
                Route::get('courier/invoice/{id}', 'HomeController@invoice')->name('courier.invoice');
                Route::get('branch/income', 'HomeController@branchIncome')->name('income.courier');
               

                //Manage Staff
                Route::get('staff/create', 'StaffController@create')->name('staff.create');
                Route::get('staff/list', 'StaffController@index')->name('staff.index');
                Route::post('staff/store', 'StaffController@store')->name('staff.store');
                Route::get('staff/edit/{id}', 'StaffController@edit')->name('staff.edit');
                Route::post('staff/update/{id}', 'StaffController@update')->name('staff.update');
                Route::get('staff/search/', 'StaffController@search')->name('staff.search');

                //2FA
                Route::get('twofactor', 'HomeController@show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'HomeController@create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'HomeController@disable2fa')->name('twofactor.disable');
            });
        });
    // });
});


Route::namespace('Staff')->name('staff.')->prefix('staff')->group(function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetCodeEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code.verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify.code');

    // Route::middleware('auth')->group(function () {
        Route::middleware(['checkStatus'])->group(function () {
            Route::middleware('staff')->group(function () {
                Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
                Route::get('profile', 'HomeController@profile')->name('profile');
                Route::post('profile/update', 'HomeController@profileUpdate')->name('profile.update');
                Route::get('password', 'HomeController@password')->name('password');
                Route::post('password/update', 'HomeController@passwordUpdate')->name('password.update.data');
                Route::get('branch/list', 'HomeController@branchList')->name('branch.index');
                Route::get('branch/search', 'HomeController@branchSearch')->name('branch.search');

                Route::get('send/courier/list', 'HomeController@sendCourierList')->name('send.courier.list');
                Route::get('received/courier/list', 'HomeController@receivedCourierList')->name('received.courier.list');

                //Courier
                Route::get('courier/send', 'CourierController@create')->name('courier.create');
                Route::post('courier/store', 'CourierController@store')->name('courier.store');
                Route::get('courier/invoice/{id}', 'CourierController@invoice')->name('courier.invoice');
                Route::get('courier/delivery/list', 'CourierController@delivery')->name('delivery.list');                
                Route::get('courier/online/list', 'CourierController@onlinedelivery')->name('online.delivery.list');
                Route::get('courier/details/{id}', 'CourierController@details')->name('courier.details');
                Route::post('courier/payment', 'CourierController@payment')->name('courier.payment');
                Route::post('courier/delivery/store', 'CourierController@deliveryStore')->name('courier.delivery');
                Route::get('courier/cash/collection', 'CourierController@cash')->name('cash.income');
                Route::get('courier/list', 'CourierController@manageCourierList')->name('courier.list');
                Route::get('courier/date/search', 'CourierController@courierDateSearch')->name('courier.date.search');
                Route::get('courier/search', 'CourierController@courierSearch')->name('courier.search');

                //2FA
                Route::get('twofactor', 'HomeController@show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'HomeController@create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'HomeController@disable2fa')->name('twofactor.disable');
            });
        });
    // });
});

Route::name('user.')->prefix('user')->group(function () {
    // Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send.verify.code');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');
    // });
});

Route::get('/menu/{slug}/{id}', 'SiteController@footerMenu')->name('footer.menu');
Route::get('/order/tracking', 'SiteController@orderTracking')->name('order.tracking');
Route::get('/order/dispatch', 'SiteController@dispatchOrders')->name('order.dispatch');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');
Route::get('/cookie/accept', 'SiteController@cookieAccept')->name('cookie.accept');
Route::get('/blog', 'SiteController@blog')->name('blog');
Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');
Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholder.image');
Route::get('/{slug}', 'SiteController@pages')->name('pages');
Route::get('/', 'SiteController@index')->name('home');
Route::get('/order/new', 'DispatchController@newDispatchOrder')->name('order.new');
Route::post('dispatch/store', 'DispatchController@storeOnline')->name('dispatch.order.store');

Route::get('dispatch/invoice/{id}', 'DispatchController@invoice')->name('dispatch.invoice');
