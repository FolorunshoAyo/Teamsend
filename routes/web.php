<?php

use App\Livewire\Logout;
use App\Models\Lists;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail-sent', function () {
    return view('auth.recovery-mail-sent',
    [
        "title" => "Recovery Mail Sent | TeamSend",
    ]
    );
});

/* 
-------
Auth Routes
------
*/
Route::name('auth.')->group(function () {
    Route::group(['middleware' => 'guest:web'], function () {
        Route::get('/login', function () {
            return view('auth.login', [
                "title" => "Login | TeamSend"
            ]);
        })
        ->name("login");

        Route::get('/register', function () {
            return view('auth.register', [
                "title" => "Register | TeamSend"
            ]);
        })
        ->name("register");

        Route::get('/forgot-password', function () {
            return view('auth.forgot-password', [
                "title" => "Forgot Password | TeamSend"
            ]);
        })
        ->name("forgot-password");

        Route::get('/account/setup', function () {
            return view('auth.account-setup-form', [
                "title" => "Account Setup | TeamSend"
            ]);
        })
        ->name("account-setup");
    });
});
/* 
-------
Login/Register Routes
------
*/

/* 
-------
Email Verification Routes
------
*/
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');
/* 
-------
Email Verification Routes
------
*/

/* 
-------
Password Reset Routes
------
*/
Route::get('reset-password/{token}/{email}', function (string $token, string $email){
    return view("auth.reset-password", [
        "token" => $token,
        "email" => $email
    ]);
})->name('reset.password');

/* 
-------
Password Reset Routes
------
*/

Route::name('super-admin.')->group(function () {
    // The SuperAdmin middleware should check if the user is a superadmin
    Route::group(['middleware' => 'SuperAdminCheck'], function () {
        Route::get('admin/dashboard', function(Request $request){
            $organisation = $request->get('organization');

            return view('superadmin.index', [
                "page-title" => "Admin Page Title | Teamsend",
                "page-hero-title" => "Home",
                "page-link-title" => "Dashboard",
                "organisation" => $organisation
            ]);
        })
        ->name('dashboard');
        
    });
});

Route::name('org-admin.')->group(function () {
    // This middleware should check if a user belongs to the organisation and is an admin
    Route::group(['middleware' => 'AdminOrganisationCheck'], function () {

        Route::get('{organisation}/admin/dashboard', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.index', [
                "pageTitle" => "Admin Page - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Home",
                "pageLinkTitle" => "Dashboard",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('dashboard');

        Route::get('{organisation}/admin/agents', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.agents', [
                "pageTitle" => "Agents - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Agents",
                "pageLinkTitle" => "Agents",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('agents');

        Route::get('{organisation}/admin/contacts', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.contacts', [
                "pageTitle" => "Contacts - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Contacts",
                "pageLinkTitle" => "Contacts",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('contacts');

        Route::get('{organisation}/admin/contacts/bulk-import-export', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.bulk-import-export', [
                "pageTitle" => "Bulk Import/Export - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Bulk Import/Export",
                "pageLinkTitle" => "Bulk Import/Export",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('bulk-import-export');

        Route::get('{organisation}/admin/groups', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.groups', [
                "pageTitle" => "Contact Groups - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Contact Groups",
                "pageLinkTitle" => "Contact Groups",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('groups');

        Route::get('{organisation}/admin/group/new', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.new-group', [
                "pageTitle" => "New Contact Group - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "New Contact Group",
                "pageLinkTitle" => "New Contact Group",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('new-group');

    
        Route::get('{organisation}/admin/group/{id}', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');
            $urlOrgName = $request->route("organisation");
            $groupId = $request->route('id');

            // Check if user is allowed to edit this group
            $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
                $query->where('user_id', $currUser->id);
            })->first();                

            $orgId = $organisation->id;

            $list = Lists::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })->where('id', $groupId)->first();

            $organisation_name = $organisation->name;

            if($list){
                return view('admin.view-group', [
                    "pageTitle" => "Group Details - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "Group Details",
                    "pageLinkTitle" => "Group Details",
                    "organisation" => $organisation,
                    "user" => $currUser,
                    "selectedGroup" => $list
                ]);
            }else{
                // redirect to groups
                return redirect("/$urlOrgName/admin/groups");
            }
        })
        ->name('view-group');

        Route::get('{organisation}/admin/group/edit/{id}', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');
            $urlOrgName = $request->route("organisation");
            $groupId = $request->route('id');

            // Check if user is allowed to edit this group
            $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
                $query->where('user_id', $currUser->id);
            })->first();                

            $orgId = $organisation->id;

            $hasList = Lists::whereHas('userOrganisation', function ($query) use ($orgId) {
                $query->where('org_id', $orgId);
            })->where('id', $groupId)->exists();

            $organisation_name = $organisation->name;

            if($hasList){
                $list = Lists::find($groupId);

                return view('admin.edit-group', [
                    "pageTitle" => "Edit Contact Group - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "Edit Contact Group",
                    "pageLinkTitle" => "Edit Contact Group",
                    "organisation" => $organisation,
                    "user" => $currUser,
                    "groupDetails" => $list,
                ]);
            }else{
                // redirect to groups
                return redirect("/$urlOrgName/admin/groups");
            }
        })
        ->name('edit-group');

    });
});

Route::name('org-agent.')->group(function () {
    // This middleware should check if a user belongs to the organisation and is an agent
    Route::group(['middleware' => 'AgentOrganisationCheck'], function () {
        Route::get('{organisation}/agent/dashboard', function(Request $request){
            $organisation = $request->get('organization');
            $currUser = $request->get('activeUser');

            return view('agent.index', [
                "pageTitle" => "Agent Page Title | Teamsend",
                "pageHeroTitle" => "Home",
                "pageLinkTitle" => "Dashboard",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('dashboard');
    });
});


/* 
-------
Logout
------
*/
    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route("auth.login");
    })->name('logout');
/* 
-------
Logout
------
*/
