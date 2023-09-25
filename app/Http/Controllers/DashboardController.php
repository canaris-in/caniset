<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\Chatbot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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


        $assets=Asset::all();
        // return $assets;
        $assets = Asset::select('assets.*', 'categories.name as category_name')
        ->join('models', 'assets.model_id', '=', 'models.id')
        ->join('categories', 'models.category_id', '=', 'categories.id')
        ->get()
        ->map(function ($asset) {
            $warrantyEndDate = Carbon::parse($asset->purchase_date)
                ->addMonths($asset->warranty_months);
            
            $oneMonthBeforeExpiry = Carbon::now()->addMonths(1);
    
            if ($warrantyEndDate > Carbon::now() && $warrantyEndDate <= $oneMonthBeforeExpiry) {
                $asset->warranty_status = 'Due for Renewal';
            } elseif ($warrantyEndDate >= Carbon::now()) {
                $asset->warranty_status = 'Within Warranty';
            } else {
                $asset->warranty_status = 'Warranty Expired';
            }
    
            return $asset;
        });

        $data = json_decode($assets);
        $uniqueCategoryNames = [];
        $categoryCounts = [];
        foreach ($data as $item) {
             $categoryName = $item->category_name;
        if (!in_array($categoryName, $uniqueCategoryNames)) {
        $uniqueCategoryNames[] = $categoryName;
        }

        if (isset($categoryCounts[$categoryName])) {
            $categoryCounts[$categoryName]++;
        } else {
            $categoryCounts[$categoryName] = 1;
        }
        }
        
        // return $categoryCounts;

        $expiredWarrantyCount = $assets->where('warranty_status', 'Warranty Expired')->count();
        $withinWarrantyCount = $assets->where('warranty_status', 'Within Warranty')->count();
        $dueforrenewal=$assets->where('warranty_status', 'Due for Renewal')->count();
        $chatbot =Chatbot::all();
        $urls = $chatbot->pluck('url');
        $url = $urls->first();
        $final_url = "var FreeScoutW={s:{\"color\":\"#0068bd\",\"position\":\"bl\",\"id\":3427502676}};(function(d,e,s){if(d.getElementById(\"freescout-w\"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id=\"freescout-w\";a.src=s;m.parentNode.insertBefore(a, m)})(document,\"script\",\"https://$url/modules/enduserportal/js/widget.js?v=7516\")";

        if (Auth::user()->hasAccess('admin')) {
            $asset_stats = null;

            $counts['asset'] = \App\Models\Asset::count();
            $counts['accessory'] = \App\Models\Accessory::assetcount();
            $counts['license'] = \App\Models\License::assetcount();
            $counts['consumable'] = \App\Models\Consumable::assetcount();
            $counts['component'] = \App\Models\Component::assetcount();
            $counts['user'] = \App\Models\Company::scopeCompanyables(Auth::user())->count();
            $counts['grand_total'] = $counts['asset'] + $counts['accessory'] + $counts['license'] + $counts['consumable'];

            if ((! file_exists(storage_path().'/oauth-private.key')) || (! file_exists(storage_path().'/oauth-public.key'))) {
                Artisan::call('migrate', ['--force' => true]);
                \Artisan::call('passport:install');
            }

            $assetcount = $assets->count();
            return view('dashboard')->with(compact('asset_stats', 'assetcount', 'counts', 'final_url', 'expiredWarrantyCount', 'withinWarrantyCount', 'dueforrenewal','uniqueCategoryNames','categoryCounts'));

            // return view('dashboard')->with('asset_stats', $asset_stats)->with('assetcount', $assets->count())->with('counts', $counts)->with('final_url', $final_url)->with('expiredWarrantyCount', $expiredWarrantyCount)->with('withinWarrantyCount', $withinWarrantyCount)->with('dueforrenewal', $dueforrenewal);
        } else {
            // Redirect to the profile page
            return redirect()->intended('account/view-assets');
        }
    }
}
