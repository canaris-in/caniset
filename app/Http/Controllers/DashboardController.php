<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\Chatbot;


/**
 * This controller handles all actions related to the Admin Dashboard
 * for the Snipe-IT Asset Management application.
 *
 * @author A. Gianotto <snipe@snipe.net>
 * @version v1.0
 */
class DashboardController extends Controller
{
    /**
     * Check authorization and display admin dashboard, otherwise display
     * the user's checked-out assets.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since [v1.0]
     * @return View
     */
    public function index()
    {
        // Show the page
        $chatbot =Chatbot::all();
        $urls = $chatbot->pluck('url');
        $url = $urls->first();
        $final_url = "var FreeScoutW={s:{\"color\":\"#0068bd\",\"position\":\"bl\",\"id\":3427502676}};(function(d,e,s){if(d.getElementById(\"freescout-w\"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id=\"freescout-w\";a.src=s;m.parentNode.insertBefore(a, m)})(document,\"script\",\"https://$url/modules/enduserportal/js/widget.js?v=7516\")";

        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $counts['asset'] = \App\Models\Asset::count();
            $counts['accessory'] = \App\Models\Accessory::count();
            $counts['license'] = \App\Models\License::assetcount();
            $counts['consumable'] = \App\Models\Consumable::count();
            $counts['component'] = \App\Models\Component::count();
            $counts['user'] = \App\Models\Company::scopeCompanyables(Auth::user())->count();
            $counts['grand_total'] = $counts['asset'] + $counts['accessory'] + $counts['license'] + $counts['consumable'];

            if ((! file_exists(storage_path().'/oauth-private.key')) || (! file_exists(storage_path().'/oauth-public.key'))) {
                Artisan::call('migrate', ['--force' => true]);
                \Artisan::call('passport:install');
            }

            return view('dashboard')->with('asset_stats', $asset_stats)->with('counts', $counts)->with('final_url', $final_url);
        } else {
            // Redirect to the profile page
            return redirect()->intended('account/view-assets');
        }
    }
}
