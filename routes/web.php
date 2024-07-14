<?php

use Illuminate\Support\Facades\Route;
$adminurl = config('app.admin_path');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('clear_cache', function () {
    \Artisan::call('optimize:clear');
    echo "Compiled views cleared!<br>Application cache cleared!<br>Route cache cleared!<br>Configuration cache cleared!<br>Caches cleared successfully!";
});


//==== admin route==//
Route::group(['prefix'=>$adminurl,'namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::post('unlock-screen', ['uses' => 'AdminController@postUnlockScreen', 'as' => 'postUnlockScreen']);
    Route::get('lock-screen', ['uses' => 'AdminController@getLockscreen', 'as' => 'getLockScreen']);
    Route::post('forgot', ['uses' => 'AdminController@postForgot', 'as' => 'postForgot']);
    Route::get('forgot', ['uses' => 'AdminController@getForgot', 'as' => 'getForgot']);
    Route::post('register', ['uses' => 'AdminController@postRegister', 'as' => 'postRegister']);
    Route::get('register', ['uses' => 'AdminController@getRegister', 'as' => 'getRegister']);
    Route::get('logout', ['uses' => 'AdminController@getLogout', 'as' => 'getLogout']);
    Route::post('login', ['uses' => 'AdminController@postLogin', 'as' => 'postLogin']);
    Route::get('login', ['uses' => 'AdminController@getLogin', 'as' => 'getLogin']);   
});

Route::group(['prefix'=>$adminurl,'middleware' => ['admin.auth'], 'namespace' => '\App\Http\Controllers\Admin'], function () {
    Route::get('/', ['uses' => 'AdminController@getIndex', 'as' => 'getIndex']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminDashboard']);
    Route::get('/dashboard', ['uses' => 'AdminController@getIndex', 'as' => 'getAdminProfile']);
     //Menu Management
     Route::get('menu-management', ['uses'=>'MenusController@getIndex', 'as'=>'getMenus']);
     Route::post('menu-management/add-save-menu', ['uses'=>'MenusController@postAddSave', 'as' => 'postAddMenu']);
     Route::get('menu-management/edit/{id}', ['uses'=>'MenusController@editMenu', 'as' => 'getEditMenu']);
     Route::get('menu-management/delete/{id}', ['uses'=>'MenusController@deleteMenu', 'as' => 'deleteMenu']);
     Route::post('menu-management/edit-save-menu/{id}', ['uses'=>'MenusController@postUpdateSave', 'as' => 'postUpdateMenu']);

     //Admin Users
    Route::get('admin-users', ['uses'=>'AdminUsersController@getIndex', 'as'=>'getAdminUsers']);
    Route::get('admin-users/add', ['uses'=>'AdminUsersController@getAdd', 'as'=>'getAddAdminUser']);    
    Route::post('admin-users/add-save', ['uses'=>'AdminUsersController@postAddSave', 'as'=>'postAddSaveAdminUser']);    
    Route::get('admin-users/edit/{id}', ['uses'=>'AdminUsersController@getEdit', 'as'=>'getEditAdminUser']);
    Route::post('admin-users/update-save/{id}', ['uses'=>'AdminUsersController@postUpdateSave', 'as'=>'postUpdateSaveAdminUser']);
    Route::get('admin-users/delete/{id}', ['uses'=>'AdminUsersController@getDelete', 'as'=>'getDeleteAdminUser']);
    
     //Privileges
     Route::get('privileges', ['uses'=>'MenusController@getPrivilege', 'as'=>'getPrivilege']);
     Route::get('privileges/add', ['uses'=>'MenusController@getAddPrivilege', 'as'=>'getAddPrivilege']);
     Route::post('privileges/add-save-privilege', ['uses'=>'MenusController@postAddPrivilege', 'as'=>'postAddPrivilege']);
     Route::get('privileges/edit/{id}', ['uses'=>'MenusController@getEditPrivilege', 'as'=>'getEditPrivilege']);
     Route::get('privileges/delete/{id}', ['uses'=>'MenusController@getDeletePrivilege', 'as'=>'getDeletePrivilege']);
     Route::post('privileges/edit-save-privilege/{id}', ['uses'=>'MenusController@postUpdatePrivilege', 'as'=>'postUpdatePrivilege']);

     //Settings
    Route::get('general-settings', ['uses' => 'SettingsController@getGeneralSettings', 'as' => 'getGeneralSettings']);
    Route::post('general-settings/save-general-settings', ['uses' => 'SettingsController@postSaveGeneralSettings', 'as' => 'postSaveGeneralSettings']);
    Route::get('email-settings', ['uses' => 'SettingsController@getEmailSettings', 'as' => 'getEmailSettings']);
    Route::post('email-settings/save', ['uses' => 'SettingsController@postSaveEmailSettings', 'as' => 'postSaveEmailSettings']);
    Route::get('homepage-settings', ['uses'=>'SettingsController@getHomeSettings', 'as'=>'getHomeSettings']);
    Route::post('homepage-settings/save', ['uses'=>'SettingsController@postSaveHomeSettings', 'as'=>'postSaveHomeSettings']);

    //Download & Delete File
    Route::get('download-file', 'AdminController@download_file');
    Route::get('delete-image', 'AdminController@delete_file');

    //admin profile
    Route::get('profile', ['uses' => 'ProfileController@getProfileData', 'as' => 'getProfileData']);
    Route::post('save-profile', ['uses' => 'ProfileController@postSaveProfile', 'as' => 'postSaveProfile']);

     //Notification
    Route::get('notifications', ['uses'=>'NotificationController@getIndex'])->name('admin.notification');
    Route::get('notifications/read/{id}', ['uses'=>'NotificationController@readNotification'])->name('admin.read_notification');
    Route::get('notifications/delete/{id}', ['uses'=>'NotificationController@deleteNotification'])->name('admin.delete_notification');
    Route::post('notifications/action-selected', ['uses'=>'NotificationController@postActionSelected'])->name('admin.action_selected_notification');

    //CMS Management
    Route::get('manage-cms', ['uses' => 'ManageCMSController@getIndex', 'as' => 'getManageCMS']);
    Route::get('manage-cms/add', ['uses' => 'ManageCMSController@getAdd', 'as' => 'getAddCms']);
    Route::post('manage-cms/add-save-cms', ['uses' => 'ManageCMSController@postAddSave', 'as' => 'postAddCms']);
    Route::get('manage-cms/detail/{id}', ['uses' => 'ManageCMSController@getDetail', 'as' => 'getDetailCms']);
    Route::get('manage-cms/edit/{id}', ['uses' => 'ManageCMSController@getEdit', 'as' => 'getEditCms']);
    Route::post('manage-cms/edit-save-cms/{id}', ['uses' => 'ManageCMSController@postUpdateSave', 'as' => 'postUpdateCms']);
    Route::get('manage-cms/delete/{id}', ['uses' => 'ManageCMSController@getDelete', 'as' => 'deleteCms']);
    Route::post('manage-cms/action-selected', ['uses' => 'ManageCMSController@postActionSelected', 'as' => 'actionSelectedCms']);
    //Category Management
    Route::get('manage-category', ['uses' => 'CategoryController@getIndex', 'as' => 'getManageCategory']);
    Route::get('manage-cat/add', ['uses' => 'CategoryController@getAdd', 'as' => 'getAddCat']);
    Route::post('manage-cat/add-save-cat', ['uses' => 'CategoryController@postAddSave', 'as' => 'postAddCat']);
    Route::get('manage-category/detail/{id}', ['uses' => 'CategoryController@getDetail', 'as' => 'getDetailCat']);
    Route::get('manage-category/edit/{id}', ['uses' => 'CategoryController@getEdit', 'as' => 'getEditCat']);
    Route::post('manage-category/edit-save-cms/{id}', ['uses' => 'CategoryController@postUpdateSave', 'as' => 'postUpdateCat']);
    Route::get('manage-category/delete/{id}', ['uses' => 'CategoryController@getDelete', 'as' => 'deleteCat']);
    Route::post('manage-category/action-selected', ['uses' => 'CategoryController@postActionSelected', 'as' => 'actionSelectedCat']);

    //Advertisement Management
    Route::get('manage-advertisement', ['uses' => 'AdvertisementController@getIndex', 'as' => 'getManageAdv']);
    Route::get('manage-advertisement/add', ['uses' => 'AdvertisementController@getAdd', 'as' => 'getAddAdv']);
    Route::post('manage-advertisement/add-save-cat', ['uses' => 'AdvertisementController@postAddSave', 'as' => 'postAddAdv']);
    Route::get('manage-advertisement/detail/{id}', ['uses' => 'AdvertisementController@getDetail', 'as' => 'getDetailAdv']);
    Route::get('manage-advertisement/edit/{id}', ['uses' => 'AdvertisementController@getEdit', 'as' => 'getEditAdv']);
    Route::post('manage-advertisement/edit-save-cms/{id}', ['uses' => 'AdvertisementController@postUpdateSave', 'as' => 'postUpdateAdv']);
    Route::get('manage-advertisement/delete/{id}', ['uses' => 'AdvertisementController@getDelete', 'as' => 'deleteAdv']);
    Route::post('manage-advertisement/action-selected', ['uses' => 'AdvertisementController@postActionSelected', 'as' => 'actionSelectedAdv']);

    //Member Management
    Route::get('manage-member', ['uses' => 'MemberController@getIndex', 'as' => 'getManageMem']);
    Route::get('manage-member/add', ['uses' => 'MemberController@getAdd', 'as' => 'getAddMem']);
    Route::post('manage-member/add-save-cat', ['uses' => 'MemberController@postAddSave', 'as' => 'postAddMem']);
    Route::get('manage-member/detail/{id}', ['uses' => 'MemberController@getDetail', 'as' => 'getDetailMem']);
    Route::get('manage-member/edit/{id}', ['uses' => 'MemberController@getEdit', 'as' => 'getEditMem']);
    Route::post('manage-member/edit-save-cms/{id}', ['uses' => 'MemberController@postUpdateSave', 'as' => 'postUpdateMem']);
    Route::get('manage-member/delete/{id}', ['uses' => 'MemberController@getDelete', 'as' => 'deleteMem']);
    Route::post('manage-member/action-selected', ['uses' => 'MemberController@postActionSelected', 'as' => 'actionSelectedMem']);

   //Member Group Management
    Route::get('manage-group', ['uses' => 'GroupController@getIndex', 'as' => 'getManageGroup']);
    Route::get('manage-group/add', ['uses' => 'GroupController@getAdd', 'as' => 'getAddGroup']);
    Route::post('manage-group/add-save-cat', ['uses' => 'GroupController@postAddSave', 'as' => 'postAddGroup']);
    Route::get('manage-group/detail/{id}', ['uses' => 'GroupController@getDetail', 'as' => 'getDetailGroup']);
    Route::get('manage-group/edit/{id}', ['uses' => 'GroupController@getEdit', 'as' => 'getEditGroup']);
    Route::post('manage-group/edit-save-cms/{id}', ['uses' => 'GroupController@postUpdateSave', 'as' => 'postUpdateGroup']);
    Route::get('manage-group/delete/{id}', ['uses' => 'GroupController@getDelete', 'as' => 'deleteGroup']);
    Route::post('manage-group/action-selected', ['uses' => 'GroupController@postActionSelected', 'as' => 'actionSelectedGroup']);

    //Member Meeting Management
    Route::get('manage-meeting', ['uses' => 'MeetingController@getIndex', 'as' => 'getManageMeeting']);
    Route::get('manage-meeting/add', ['uses' => 'MeetingController@getAdd', 'as' => 'getAddMeeting']);
    Route::post('manage-meeting/add-save-cat', ['uses' => 'MeetingController@postAddSave', 'as' => 'postAddMeeting']);
    Route::get('manage-meeting/detail/{id}', ['uses' => 'MeetingController@getDetail', 'as' => 'getDetailMeeting']);
    Route::get('manage-meeting/edit/{id}', ['uses' => 'MeetingController@getEdit', 'as' => 'getEditMeeting']);
    Route::post('manage-meeting/edit-save-cms/{id}', ['uses' => 'MeetingController@postUpdateSave', 'as' => 'postUpdateMeeting']);
    Route::get('manage-meeting/delete/{id}', ['uses' => 'MeetingController@getDelete', 'as' => 'deleteMeeting']);
    Route::post('manage-meeting/action-selected', ['uses' => 'MeetingController@postActionSelected', 'as' => 'actionSelectedMeeting']);


     //Meeting Question Management
    Route::get('manage-question', ['uses' => 'QuestionController@getIndex', 'as' => 'getManageQuestion']);
    Route::match(array('GET','POST'),'manage-question/add', ['uses' => 'QuestionController@addQuestion', 'as' => 'getAddQuestion']);
   
    
    Route::get('manage-question/delete/{id}', ['uses' => 'QuestionController@getDelete', 'as' => 'deleteQuestion']);
    Route::post('manage-question/action-selected', ['uses' => 'QuestionController@postActionSelected', 'as' => 'actionSelectedQuestion']);



    //Member Meeting Management
    Route::get('manage-meeting-physically', ['uses' => 'MeetingPhysicallyLinkController@getIndex', 'as' => 'getManageMeetingPhysically']);

    //Manage Email templates
    Route::get('email-templates', ['uses' => 'ManageEmailTemplates@getIndex', 'as' => 'getIndexEmailTemplate']);
    Route::get('email-templates/add', ['uses' => 'ManageEmailTemplates@getAdd', 'as' => 'addEmailTemplate']);
    Route::post('add-save-email-templates', ['uses'=>'ManageEmailTemplates@postAddSave', 'as' => 'postAddEmailTemplate']);
    Route::get('email-templates/detail/{id}', ['uses' => 'ManageEmailTemplates@getDetail', 'as' => 'getDetailEmailTemplate']);
    Route::get('email-templates/edit/{id}', ['uses' => 'ManageEmailTemplates@getEdit', 'as' => 'getEditEmailTemplate']);
    Route::post('edit-save-email-templates/{id}', ['uses' => 'ManageEmailTemplates@postUpdateSave', 'as' => 'postUpdateEmailTemplate']);
    Route::get('email-templates/delete/{id}', ['uses' => 'ManageEmailTemplates@deleteDuration', 'as' => 'deleteManageEmailTemplate']);
    Route::post('email-templates/action-selected', ['uses' => 'ManageEmailTemplates@postActionSelected', 'as' => 'actionSelectedManageEmailTemplate']);
    Route::get('email-templates/action-selected', ['uses' => 'ManageEmailTemplates@postActionSelected', 'as' => 'actionSelectedManageEmailTemplate']);
});



Route::get('/', function () {
return view('welcome');
});
Route::get('/home', function () {
return view('welcome');
});

