<?php

/**
 * Authentication
 */

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

// Allow registration routes only if registration is enabled.
if (settings('reg_enabled')) {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('register/confirmation/{token}', [
        'as' => 'register.confirm-email',
        'uses' => 'Auth\AuthController@confirmEmail'
    ]);
}

// Register password reset routes only if it is enabled inside website settings.
if (settings('forgot_password')) {
    Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
}

/**
 * Two-Factor Authentication
 */
if (settings('2fa.enabled')) {
    Route::get('auth/two-factor-authentication', [
        'as' => 'auth.token',
        'uses' => 'Auth\AuthController@getToken'
    ]);

    Route::post('auth/two-factor-authentication', [
        'as' => 'auth.token.validate',
        'uses' => 'Auth\AuthController@postToken'
    ]);
}

/**
 * Social Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

Route::group(['middleware' => 'auth'], function () {

    /**
     * Dashboard
     */

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    /**
     * User Profile
     */

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);

    Route::get('profile/activity', [
        'as' => 'profile.activity',
        'uses' => 'ProfileController@activity'
    ]);

    Route::put('profile/details/update', [
        'as' => 'profile.update.details',
        'uses' => 'ProfileController@updateDetails'
    ]);

    Route::post('profile/avatar/update', [
        'as' => 'profile.update.avatar',
        'uses' => 'ProfileController@updateAvatar'
    ]);

    Route::post('profile/avatar/update/external', [
        'as' => 'profile.update.avatar-external',
        'uses' => 'ProfileController@updateAvatarExternal'
    ]);

    Route::put('profile/login-details/update', [
        'as' => 'profile.update.login-details',
        'uses' => 'ProfileController@updateLoginDetails'
    ]);

    Route::post('profile/two-factor/enable', [
        'as' => 'profile.two-factor.enable',
        'uses' => 'ProfileController@enableTwoFactorAuth'
    ]);

    Route::post('profile/two-factor/disable', [
        'as' => 'profile.two-factor.disable',
        'uses' => 'ProfileController@disableTwoFactorAuth'
    ]);

    Route::get('profile/sessions', [
        'as' => 'profile.sessions',
        'uses' => 'ProfileController@sessions'
    ]);

    Route::delete('profile/sessions/{session}/invalidate', [
        'as' => 'profile.sessions.invalidate',
        'uses' => 'ProfileController@invalidateSession'
    ]);

    /**
     * User Management
     */
    Route::get('user', [
        'as' => 'user.list',
        'uses' => 'UsersController@index'
    ]);

    Route::get('user/create', [
        'as' => 'user.create',
        'uses' => 'UsersController@create'
    ]);

    Route::post('user/create', [
        'as' => 'user.store',
        'uses' => 'UsersController@store'
    ]);

    Route::get('user/{user}/show', [
        'as' => 'user.show',
        'uses' => 'UsersController@view'
    ]);

    Route::get('user/{user}/edit', [
        'as' => 'user.edit',
        'uses' => 'UsersController@edit'
    ]);

    Route::put('user/{user}/update/details', [
        'as' => 'user.update.details',
        'uses' => 'UsersController@updateDetails'
    ]);

    Route::put('user/{user}/update/login-details', [
        'as' => 'user.update.login-details',
        'uses' => 'UsersController@updateLoginDetails'
    ]);

    Route::delete('user/{user}/delete', [
        'as' => 'user.delete',
        'uses' => 'UsersController@delete'
    ]);

    Route::post('user/{user}/update/avatar', [
        'as' => 'user.update.avatar',
        'uses' => 'UsersController@updateAvatar'
    ]);

    Route::post('user/{user}/update/avatar/external', [
        'as' => 'user.update.avatar.external',
        'uses' => 'UsersController@updateAvatarExternal'
    ]);

    Route::get('user/{user}/sessions', [
        'as' => 'user.sessions',
        'uses' => 'UsersController@sessions'
    ]);

    Route::delete('user/{user}/sessions/{session}/invalidate', [
        'as' => 'user.sessions.invalidate',
        'uses' => 'UsersController@invalidateSession'
    ]);

    Route::post('user/{user}/two-factor/enable', [
        'as' => 'user.two-factor.enable',
        'uses' => 'UsersController@enableTwoFactorAuth'
    ]);

    Route::post('user/{user}/two-factor/disable', [
        'as' => 'user.two-factor.disable',
        'uses' => 'UsersController@disableTwoFactorAuth'
    ]);

    /**
     * Roles & Permissions
     */

    Route::get('role', [
        'as' => 'role.index',
        'uses' => 'RolesController@index'
    ]);

    Route::get('role/create', [
        'as' => 'role.create',
        'uses' => 'RolesController@create'
    ]);

    Route::post('role/store', [
        'as' => 'role.store',
        'uses' => 'RolesController@store'
    ]);

    Route::get('role/{role}/edit', [
        'as' => 'role.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('role/{role}/update', [
        'as' => 'role.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('role/{role}/delete', [
        'as' => 'role.delete',
        'uses' => 'RolesController@delete'
    ]);


    Route::post('permission/save', [
        'as' => 'permission.save',
        'uses' => 'PermissionsController@saveRolePermissions'
    ]);

    Route::resource('permission', 'PermissionsController');

    /**
     * Settings
     */

    Route::get('settings', [
        'as' => 'settings.general',
        'uses' => 'SettingsController@general',
        'middleware' => 'permission:settings.general'
    ]);

    Route::post('settings/general', [
        'as' => 'settings.general.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.general'
    ]);

    Route::get('settings/auth', [
        'as' => 'settings.auth',
        'uses' => 'SettingsController@auth',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth', [
        'as' => 'settings.auth.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.auth'
    ]);

// Only allow managing 2FA if AUTHY_KEY is defined inside .env file
    if (env('AUTHY_KEY')) {
        Route::post('settings/auth/2fa/enable', [
            'as' => 'settings.auth.2fa.enable',
            'uses' => 'SettingsController@enableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);

        Route::post('settings/auth/2fa/disable', [
            'as' => 'settings.auth.2fa.disable',
            'uses' => 'SettingsController@disableTwoFactor',
            'middleware' => 'permission:settings.auth'
        ]);
    }

    Route::post('settings/auth/registration/captcha/enable', [
        'as' => 'settings.registration.captcha.enable',
        'uses' => 'SettingsController@enableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::post('settings/auth/registration/captcha/disable', [
        'as' => 'settings.registration.captcha.disable',
        'uses' => 'SettingsController@disableCaptcha',
        'middleware' => 'permission:settings.auth'
    ]);

    Route::get('settings/notifications', [
        'as' => 'settings.notifications',
        'uses' => 'SettingsController@notifications',
        'middleware' => 'permission:settings.notifications'
    ]);

    Route::post('settings/notifications', [
        'as' => 'settings.notifications.update',
        'uses' => 'SettingsController@update',
        'middleware' => 'permission:settings.notifications'
    ]);

    /**
     * Activity Log
     */

    Route::get('activity', [
        'as' => 'activity.index',
        'uses' => 'ActivityController@index'
    ]);

    Route::get('activity/user/{user}/log', [
        'as' => 'activity.user',
        'uses' => 'ActivityController@userActivity'
    ]);

});


/**
 * Kreiranje email templejta
 */


Route::resource('emailtemplate','TemplateController');

Route::post('update-template', [
    'as'=>'update-template',
    'uses'=>'TemplateController@update'
]);


/**
 * Kreiranje liste za izbor templejta i slanje
 */

Route::resource('selectlist','SelectListController');
//
////Route::get('selectlist', [
////    'as' => 'selectlist',
////    'uses' => 'SelectListController@index'
////]);

/**
 * Kreiranje rute za import CSVa i Kontakata
 */

Route::get('csv', [
    'as' => 'csv',
    'uses' => 'ImportCsvController@index'
]);



Route::post('import_parse', [
    'as' => 'import_parse',
    'uses' => 'ImportCsvController@parseImport'
]);

Route::post('import_process', [
    'as' => 'import_process',
    'uses' => 'ImportCsvController@processImport'
]);

/**
 * Kreiranje rute za Brisanje baze kontakata
 */

Route::delete('truncated',[

    'as'=>'truncate',
    'uses'=>'ImportCsvController@truncate'

]);

//==========================================================
// TEST GROUP CONTACT BOX ROUTE with subb routes
Route::get('testbox', [

    'as'=>'testbox',
    'uses'=>'GroupsContactsController@index'
]);

//group management

Route::resource('groups_m','GroupsController');

Route::get('group_show', [

    'as'=>'group_show',
    'uses'=>'GroupsController@show'
]);
Route::post('update-group_name', [
    'as'=>'update-group_name',
    'uses'=>'GroupsController@update'
]);

Route::get('group_contact_list', [

    'as'=>'group_contact_list',
    'uses'=>'GroupsController@show'
]);
Route::get('add_contact', [

    'as'=>'add_contact',
    'uses'=>'GroupsController@add_single_contact'
]);
Route::post('process_contact', [

    'as'=>'process_contact',
    'uses'=>'GroupsController@process_single_contact'
]);

Route::resource('edit_delete_c','EditDeleteContactController');
Route::post('update-single-contact', [
    'as'=>'update-single-contact',
    'uses'=>'EditDeleteContactController@update'
]);




//===========================================================
Route::post('create_group',[

    'as'=>'create_group',
    'uses'=>'ImportCsvController@store'

]);

// RUTA ZA SNIMANJE KAMPANJE
Route::get('campaign_index', [

    'as'=>'campaign_index',
    'uses'=>'CampaignController@index'
]);

Route::post('campaign_save', [

    'as'=>'campaign_save',
    'uses'=>'CampaignController@store'
]);
Route::resource('campaign','CampaignController');

// Rute za pokretanje kampanje
Route::get('campaign_launch', [

    'as'=>'campaign_launch',
    'uses'=>'LaunchCampaignController@index'
]);

Route::post('campaign_send', [

    'as'=>'campaign_send',
    'uses'=>'LaunchCampaignController@launch'
]);

// Ruta za pracenje statistike Kampanje
    //index strana
Route::get('campaign_stats', [

    'as'=>'campaign_stats',
    'uses'=>'CampaignStatsController@index'
]);

// ruta za pregled pojedinacne kampanje
Route::resource('campaign_show','CampaignStatsController');

// ruta za dobijanje liste POJEDINACNE kampanje svih korisnika koji su kliknuli, otvorili, submitovali formu itd
Route::get('all_list_details', [

    'as'=>'all_list_details',
    'uses'=>'CampaignStatsController@allList'
]);
Route::get('submited_details', [

    'as'=>'submited_details',
    'uses'=>'CampaignStatsController@submitedList'
]);

Route::get('opens_details', [

    'as'=>'opens_details',
    'uses'=>'CampaignStatsController@opensList'
]);
Route::get('click_details', [

    'as'=>'click_details',
    'uses'=>'CampaignStatsController@clickedList'
]);

// Ruta za detalje pojedinacne kampanje

Route::get('campaign_details', [

    'as'=>'campaign_details',
    'uses'=>'CampaignDetailsController@index'
]);

// RUTA ZA REPORT

Route::get('report', [

    'as'=>'report',
    'uses'=>'CampaignStatsController@report'
]);



/**
 * Kreiranje rute za slanje Templejta mejla
 */

Route::get('sendemailform', [

    'as'=>'sendemailform',
    'uses'=>'TestController@index'
]);


//TEST EMAIL Route in use

Route::get('testemail', [

    'as'=>'testemail',
    'uses'=>'NewTestController@index'
]);


Route::post('newsendtestemail', [

    'as'=>'newsendtestemail',
    'uses'=>'NewTestController@launch'
]);

// SLANJE EMAIL KAMPAMNJE

Route::post('send', [

    'as'=>'send',
    'uses'=>'TemplateController@sendEmail'
]);

Route::post('sendtestemail', [

    'as'=>'sendtestemail',
    'uses'=>'TestController@sendEmail'
]);



/**
 * Kreiranje rute za ucitavanje liste kontakata
 */

Route::get('contactlist', [

    'as'=>'contactlist',
    'uses'=>'ImportCsvController@show'
]);

/**
 * Kreiranje rute za validaciju CSVa
 */
Route::get('validate',[

  	'as'=>'validate',
    'uses'=>'ImportCsvController@validateFileStructure'

]);


/**
 * Kreiranje rute za import Sending Profila
 */
Route::resource('sendingprofile','SendingProfileController');

Route::post('update-sending_profile', [
    'as'=>'update-sending_p',
    'uses'=>'SendingProfileController@update'
]);



// RUTA ZA LISTU KO JE KLIKNUO NA LINK

Route::get('clicked', [

    'as'=>'clicked',
    'uses'=>'WhoClickedController@index'
]);

// RUTA ZA LISTU KO JE OTVORIO MAIL

Route::get('allopen', [

    'as'=>'allopen',
    'uses'=>'WhoClickedController@allopen'
]);


// RUTA ZA LISTU svih poslatih emailova

Route::get('allsent', [

    'as'=>'allsent',
    'uses'=>'WhoClickedController@allsent'
]);

// Ruta za stranu submit forme 3. korak

Route::get('testform',[

    'as'=> 'testform',
    'uses'=>'SubmitCatchController@index'

]);

Route::get('submited',[

    'as'=> 'submited',
    'uses'=>'\jdavidbakr\MailTracker\MailTrackerController@submited'

]);
// prikaz svih korisnika koji su submitovali formu

Route::get('allsubmited', [

    'as'=>'allsubmited',
    'uses'=>'WhoClickedController@allsubmited'
]);


/**
 * Installation
 */

$router->get('install', [
    'as' => 'install.start',
    'uses' => 'InstallController@index'
]);

$router->get('install/requirements', [
    'as' => 'install.requirements',
    'uses' => 'InstallController@requirements'
]);

$router->get('install/permissions', [
    'as' => 'install.permissions',
    'uses' => 'InstallController@permissions'
]);

$router->get('install/database', [
    'as' => 'install.database',
    'uses' => 'InstallController@databaseInfo'
]);

$router->get('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/start-installation', [
    'as' => 'install.installation',
    'uses' => 'InstallController@installation'
]);

$router->post('install/install-app', [
    'as' => 'install.install',
    'uses' => 'InstallController@install'
]);

$router->get('install/complete', [
    'as' => 'install.complete',
    'uses' => 'InstallController@complete'
]);

$router->get('install/error', [
    'as' => 'install.error',
    'uses' => 'InstallController@error'
]);
