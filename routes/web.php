<?php

use App\Models\Lists;
use App\Models\Campaign;
use App\Models\Template;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\EmailTemplateHtmlController;
use App\Http\Controllers\EmailTemplateImageController;

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
    // return view('welcome');
    return redirect('/register');
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
        /*
        ==============================
           Dashboard Route
        ==============================
        */
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
        
        /*
        ==============================
           End Dashboard Route
        ==============================
        */

        /*
        ==============================
            View Agents Route
        ==============================
        */
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
        /*
        ==============================
           End View Agents Route
        ==============================
        */

        /*
        ==============================
        Contacts Overview Route
        ==============================
        */
        Route::get('{organisation}/admin/contacts/overview', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.contacts-overview', [
                "pageTitle" => "Contacts Overview - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Contacts Overview",
                "pageLinkTitle" => "Contacts Overview",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('contacts-overview');
        /*
        ==============================
        End Contacts Overview Route
        ==============================
        */

        /*
        ==============================
        View Contacts Route
        ==============================
        */
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
        /*
        ==============================
        End View Contacts Route
        ==============================
        */

        /*
        ==============================
           Bulk Import/Export Routes
        ==============================
        */
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
        /*
        ==============================
           End Bulk Import/Export Routes
        ==============================
        */

        /*
        ==============================
            Group Routes
        ==============================
        */
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
                return redirect()->route('org-admin.groups', ['organisation' => $urlOrgName]);
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
                return redirect()->route('org-admin.groups', ['organisation' => $urlOrgName]);
            }
        })
        ->name('edit-group');

        /*
        ==============================
           End Group Routes
        ==============================
        */

        /*
        ==============================
           Subscription Routes
        ==============================
        */

        Route::get('{organisation}/admin/subscription-plans', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.subscription-plans', [
                "pageTitle" => "Subscription Plans - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Subscription Plans",
                "pageLinkTitle" => "Subscription Plans",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('plans');

        /*
        ==============================
           End Subscription Routes
        ==============================
        */

        /*
        ==============================
           Email Routes
        ==============================
        */

        Route::get('{organisation}/admin/email/check-bounce', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.check-bounce', [
                "pageTitle" => "Bounce Checker - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Bounce Checker",
                "pageLinkTitle" => "Bounce Checker",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('check-bounce');

        Route::get('{organisation}/admin/email/bounced', function(Request $request){
            $organisation = $request->get('organisation');
            $currUser = $request->get('activeUser');

            $organisation_name = $organisation->name;

            return view('admin.bounced-emails', [
                "pageTitle" => "Bounced Emails - ($organisation_name) | Teamsend",
                "pageHeroTitle" => "Bounced Emails",
                "pageLinkTitle" => "Bounced Emails",
                "organisation" => $organisation,
                "user" => $currUser
            ]);
        })
        ->name('bounced-emails');

        /*
        ==============================
           End Email Routes
        ==============================
        */

        /*
        ==============================
            Email Builder Routes
        ==============================
        */
            Route::get('{organisation}/admin/email-templates', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.email-templates', [
                    "pageTitle" => "All Email Templates - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "All Email Templates",
                    "pageLinkTitle" => "Email Templates",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('email-templates');

            Route::get('{organisation}/admin/email-template/new', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');
    
                $organisation_name = $organisation->name;
    
                return view('admin.new-email-template', [
                    "pageTitle" => "New Email Template - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "New Email Template",
                    "pageLinkTitle" => "New Email Template",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('new-email-template');

            Route::get('{organisation}/admin/email-template/edit/{id}', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');
                $urlOrgName = $request->route("organisation");
                $templateId = $request->route('id');

                // Check if user is allowed to edit this group
                $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
                    $query->where('user_id', $currUser->id);
                })->first();                

                $orgId = $organisation->id;
    
                $hasTemplate = Template::whereHas('userOrganisation', function ($query) use ($orgId) {
                    $query->where('org_id', $orgId);
                })->where('id', $templateId)->exists();
    
                $organisation_name = $organisation->name;
    
                if($hasTemplate){
                    $template = Template::find($templateId);
    
                    return view('admin.edit-email-template', [
                        "pageTitle" => "Editing Email Template ($template->template_name) - ($organisation_name) | Teamsend",
                        "organisation" => $organisation,
                        "user" => $currUser,
                        "templateDetails" => $template
                    ]);
                }else{
                    // redirect to all email templates
                    return redirect()->route('org-admin.email-templates', ['organisation' => $urlOrgName]);
                }
            })
            ->name('edit-email-template');

            Route::post('{organisation}/admin/email-template/upload-image', [EmailTemplateImageController::class, 'upload'])->name('upload-template-image');
            Route::post('{organisation}/admin/email-template/upload-template', [EmailTemplateHtmlController::class, 'store'])->name('upload-template');
        /*
        ==============================
           End Email Builder Routes
        ==============================
        */

         /*
        ==============================
            Campaign Routes
        ==============================
        */

            Route::get('{organisation}/admin/campaigns', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.email-campaigns', [
                    "pageTitle" => "All Email Campaigns - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "All Email Campaigns",
                    "pageLinkTitle" => "Email Campaigns",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('email-campaigns');

            Route::get('{organisation}/admin/campaign/view/{id}', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');
                $urlOrgName = $request->route("organisation");
                $campaignId = $request->route('id');

                // Check if user is allowed to edit this group
                $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
                    $query->where('user_id', $currUser->id);
                })->first();                

                $orgId = $organisation->id;

                $hasCampaign = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
                    $query->where('org_id', $orgId);
                })->where('id', $campaignId)->exists();

                $organisation_name = $organisation->name;

                if($hasCampaign){
                    $campaign = Campaign::find($campaignId);

                    return view('admin.view-email-campaign', [
                        "pageTitle" => "View Email Campaign ($campaign->campaign_name) - ($organisation_name) | Teamsend",
                        "organisation" => $organisation,
                        "user" => $currUser,
                        "campaignDetails" => $campaign
                    ]);
                }else{
                    // redirect to all campaigns
                    return redirect()->route('org-admin.email-campaigns', ['organisation' => $urlOrgName]);
                }
            })
            ->name('view-email-campaign');


            Route::get('{organisation}/admin/campaign/new', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.new-email-campaign', [
                    "pageTitle" => "New Email Campaign - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "New Email Campaign",
                    "pageLinkTitle" => "New Email Campaign",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('new-email-campaign');

            Route::get('{organisation}/admin/campaign/edit/{id}', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');
                $urlOrgName = $request->route("organisation");
                $campaignId = $request->route('id');

                // Check if user is allowed to edit this group
                $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
                    $query->where('user_id', $currUser->id);
                })->first();                

                $orgId = $organisation->id;

                $hasCampaign = Campaign::whereHas('userOrganisation', function ($query) use ($orgId) {
                    $query->where('org_id', $orgId);
                })->where('id', $campaignId)->exists();

                $organisation_name = $organisation->name;

                if($hasCampaign){
                    $campaign = Campaign::find($campaignId);

                    return view('admin.edit-email-campaign', [
                        "pageTitle" => "Editing Email Template ($campaign->campaign_name) - ($organisation_name) | Teamsend",
                        "organisation" => $organisation,
                        "user" => $currUser,
                        "campaignDetails" => $campaign
                    ]);
                }else{
                    // redirect to groups
                    return redirect()->route('org-admin.email-campaigns', ['organisation' => $urlOrgName]);
                }
            })
            ->name('edit-email-campaign');

            Route::get('{organisation}/admin/campaign/schedules', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.campaign-schedule', [
                    "pageTitle" => "All Schedules - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "All Schedules",
                    "pageLinkTitle" => "All Schedules",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('campaign-schedules');

            Route::get('{organisation}/admin/campaign/tracker', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.campaign-tracker', [
                    "pageTitle" => "Campaign Tracker - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "Campaign Tracker",
                    "pageLinkTitle" => "Campaign Tracker",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('campaign-tracker');

            Route::get('{organisation}/admin/mail-logs', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.mail-logs', [
                    "pageTitle" => "Mail Logs - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "Mail Logs",
                    "pageLinkTitle" => "Mail Logs",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('mail-logs');

            Route::get('{organisation}/admin/campaign/logs', function(Request $request){
                $organisation = $request->get('organisation');
                $currUser = $request->get('activeUser');

                $organisation_name = $organisation->name;

                return view('admin.campaign-logs', [
                    "pageTitle" => "Campaign Logs - ($organisation_name) | Teamsend",
                    "pageHeroTitle" => "Campaign Logs",
                    "pageLinkTitle" => "Campaign Logs",
                    "organisation" => $organisation,
                    "user" => $currUser
                ]);
            })
            ->name('campaign-logs');

         /*
        ==============================
            End Campaign Routes
        ==============================
        */
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
