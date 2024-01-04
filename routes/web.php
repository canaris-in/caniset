<?php

use App\Http\Controllers\Account;
use App\Http\Controllers\ActionlogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DepreciationsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StatuslabelsController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\autoDiscovery\AutoDiscoveryController;
use App\Http\Controllers\ViewAssetsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'auth'], function () {
    /*
    * Companies
    */
    Route::resource('companies', CompaniesController::class, [
        'parameters' => ['company' => 'company_id'],
    ]);

    /*
    * Categories
    */
    Route::resource('categories', CategoriesController::class, [
        'parameters' => ['category' => 'category_id'],
    ]);

    /*
    * Locations
    */
    Route::resource('locations', LocationsController::class, [
        'parameters' => ['location' => 'location_id'],
    ]);

    Route::get(
        'locations/{locationId}/printassigned',
        [LocationsController::class, 'print_assigned']
    )->name('locations.print_assigned');

    Route::get(
        'locations/{locationId}/printallassigned',
        [LocationsController::class, 'print_all_assigned']
    )->name('locations.print_all_assigned');

    /*
    * Manufacturers
    */

    Route::group(['prefix' => 'manufacturers', 'middleware' => ['auth']], function () {
        Route::post('{manufacturers_id}/restore', [ManufacturersController::class, 'restore'] )->name('restore/manufacturer');
    });

    Route::resource('manufacturers', ManufacturersController::class, [
        'parameters' => ['manufacturer' => 'manufacturers_id'],
    ]);

    /*
    * Suppliers
    */
    Route::resource('suppliers', SuppliersController::class, [
        'parameters' => ['supplier' => 'supplier_id'],
    ]);

    /*
    * Depreciations
     */
    Route::resource('depreciations', DepreciationsController::class, [
         'parameters' => ['depreciation' => 'depreciation_id'],
     ]);

    /*
    * Status Labels
     */
    Route::resource('statuslabels', StatuslabelsController::class, [
          'parameters' => ['statuslabel' => 'statuslabel_id'],
      ]);

    /*
    * Departments
    */
    Route::resource('departments', DepartmentsController::class, [
        'parameters' => ['department' => 'department_id'],
    ]);
});

/*
|
|--------------------------------------------------------------------------
| Re-Usable Modal Dialog routes.
|--------------------------------------------------------------------------
|
| Routes for various modal dialogs to interstitially create various things
|
*/

Route::group(['middleware' => 'auth', 'prefix' => 'modals'], function () {
    Route::get('{type}/{itemId?}', [ModalController::class, 'show'] )->name('modal.show');
});

/*
|--------------------------------------------------------------------------
| Log Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get(
        'display-sig/{filename}',
        [ActionlogController::class, 'displaySig']
    )->name('log.signature.view');
    Route::get(
        'stored-eula-file/{filename}',
        [ActionlogController::class, 'getStoredEula']
    )->name('log.storedeula.download');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'authorize:superuser']], function () {
    Route::get('settings', [SettingsController::class, 'getSettings'])->name('settings.general.index');
    Route::post('settings', [SettingsController::class, 'postSettings'])->name('settings.general.save');

    Route::get('branding', [SettingsController::class, 'getBranding'])->name('settings.branding.index');
    Route::post('branding', [SettingsController::class, 'postBranding'])->name('settings.branding.save');

    Route::get('security', [SettingsController::class, 'getSecurity'])->name('settings.security.index');
    Route::post('security', [SettingsController::class, 'postSecurity'])->name('settings.security.save');

    Route::get('groups', [GroupsController::class, 'index'])->name('settings.groups.index');

    Route::get('localization', [SettingsController::class, 'getLocalization'])->name('settings.localization.index');
    Route::post('localization', [SettingsController::class, 'postLocalization'])->name('settings.localization.save');

    Route::get('notifications', [SettingsController::class, 'getAlerts'])->name('settings.alerts.index');
    Route::post('notifications', [SettingsController::class, 'postAlerts'])->name('settings.alerts.save');

    Route::get('slack', [SettingsController::class, 'getSlack'])->name('settings.slack.index');
    Route::post('slack', [SettingsController::class, 'postSlack'])->name('settings.slack.save');

    Route::get('asset_tags', [SettingsController::class, 'getAssetTags'])->name('settings.asset_tags.index');
    Route::post('asset_tags', [SettingsController::class, 'postAssetTags'])->name('settings.asset_tags.save');

    Route::get('barcodes', [SettingsController::class, 'getBarcodes'])->name('settings.barcodes.index');
    Route::post('barcodes', [SettingsController::class, 'postBarcodes'])->name('settings.barcodes.save');

    Route::get('labels', [SettingsController::class, 'getLabels'])->name('settings.labels.index');
    Route::post('labels', [SettingsController::class, 'postLabels'])->name('settings.labels.save');

    Route::get('ldap', [SettingsController::class, 'getLdapSettings'])->name('settings.ldap.index');
    Route::post('ldap', [SettingsController::class, 'postLdapSettings'])->name('settings.ldap.save');

    Route::get('phpinfo', [SettingsController::class, 'getPhpInfo'])->name('settings.phpinfo.index');

    Route::get('oauth', [SettingsController::class, 'api'])->name('settings.oauth.index');

    Route::get('purge', [SettingsController::class, 'getPurge'])->name('settings.purge.index');
    Route::post('purge', [SettingsController::class, 'postPurge'])->name('settings.purge.save');

    Route::get('login-attempts', [SettingsController::class, 'getLoginAttempts'])->name('settings.logins.index');

    // Backups
    Route::group(['prefix' => 'backups', 'middleware' => 'auth'], function () {
        Route::get('download/{filename}',
            [SettingsController::class, 'downloadFile'])->name('settings.backups.download');

        Route::delete('delete/{filename}',
            [SettingsController::class, 'deleteFile'])->name('settings.backups.destroy');

        Route::post('/', 
            [SettingsController::class, 'postBackups']
        )->name('settings.backups.create');

        Route::post('/restore/{filename}', 
            [SettingsController::class, 'postRestore']
        )->name('settings.backups.restore');

        Route::post('/upload', 
            [SettingsController::class, 'postUploadBackup']
        )->name('settings.backups.upload');

        Route::get('/', [SettingsController::class, 'getBackups'])->name('settings.backups.index');
    });

    Route::resource('groups', GroupsController::class, [
        'middleware' => ['auth'],
        'parameters' => ['group' => 'group_id'],
    ]);

    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
});

/*
|--------------------------------------------------------------------------
| Importer Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(['prefix' => 'import', 'middleware' => ['auth']], function () {
    Route::get('/', 
       [ImportsController::class, 'index']
    )->name('imports.index');
});

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(['prefix' => 'account', 'middleware' => ['auth']], function () {

    // Profile
    Route::get('profile', [ProfileController::class, 'getIndex'])->name('profile');
    Route::post('profile', [ProfileController::class, 'postIndex']);

    Route::get('menu', [ProfileController::class, 'getMenuState'])->name('account.menuprefs');

    Route::get('password', [ProfileController::class, 'password'])->name('account.password.index');
    Route::post('password', [ProfileController::class, 'passwordSave']);

    Route::get('api', [ProfileController::class, 'api'])->name('user.api');

    // View Assets
    Route::get('view-assets', [ViewAssetsController::class, 'getIndex'])->name('view-assets');

    Route::get('requested', [ViewAssetsController::class, 'getRequestedAssets'])->name('account.requested');

    // Profile
    Route::get(
        'requestable-assets',
        [ViewAssetsController::class, 'getRequestableIndex']
    )->name('requestable-assets');
    Route::post(
        'request-asset/{assetId}',
        [ViewAssetsController::class, 'getRequestAsset']
    )->name('account/request-asset');

    Route::post(
        'request/{itemType}/{itemId}',
        [ViewAssetsController::class, 'getRequestItem']
    )->name('account/request-item');

    // Account Dashboard
    Route::get('/', [ViewAssetsController::class, 'getIndex'])->name('account');

    Route::get('accept', [Account\AcceptanceController::class, 'index'])
        ->name('account.accept');

    Route::get('accept/{id}', [Account\AcceptanceController::class, 'create'])
        ->name('account.accept.item');

    Route::post('accept/{id}', [Account\AcceptanceController::class, 'store']);

    Route::get(
        'print',
        [
            ProfileController::class,
            'printInventory'
        ]
    )->name('profile.print');

    Route::post(
        'email',
        [
            ProfileController::class,
            'emailAssetList'
        ]
    )->name('profile.email_assets');

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('reports/audit', 
        [ReportsController::class, 'audit']
    )->name('reports.audit');

    Route::get(
        'reports/depreciation',
        [ReportsController::class, 'getDeprecationReport']
    )->name('reports/depreciation');
    Route::get(
        'reports/export/depreciation',
        [ReportsController::class, 'exportDeprecationReport']
    )->name('reports/export/depreciation');
    Route::get(
        'reports/asset_maintenances',
        [ReportsController::class, 'getAssetMaintenancesReport']
    )->name('reports/asset_maintenances');
    Route::get(
        'reports/export/asset_maintenances',
        [ReportsController::class, 'exportAssetMaintenancesReport']
    )->name('reports/export/asset_maintenances');
    Route::get(
        'reports/licenses',
        [ReportsController::class, 'getLicenseReport']
    )->name('reports/licenses');
    Route::get(
        'reports/export/licenses',
        [ReportsController::class, 'exportLicenseReport']
    )->name('reports/export/licenses');

    Route::get('reports/accessories', [ReportsController::class, 'getAccessoryReport'])->name('reports/accessories');
    Route::get(
        'reports/export/accessories',
        [ReportsController::class, 'exportAccessoryReport']
    )->name('reports/export/accessories');
    Route::get('reports/custom', [ReportsController::class, 'getCustomReport'])->name('reports/custom');
    Route::post('reports/custom', [ReportsController::class, 'postCustom']);

    Route::get(
        'reports/activity',
        [ReportsController::class, 'getActivityReport']
    )->name('reports.activity');

    Route::post('reports/activity', [ReportsController::class, 'postActivityReport']);

    Route::get(
        'reports/unaccepted_assets/{deleted?}',
        [ReportsController::class, 'getAssetAcceptanceReport']
    )->name('reports/unaccepted_assets');
    Route::get(
        'reports/unaccepted_assets/{acceptanceId}/sent_reminder',
        [ReportsController::class, 'sentAssetAcceptanceReminder']
    )->name('reports/unaccepted_assets_sent_reminder');
    Route::delete(
        'reports/unaccepted_assets/{acceptanceId}/delete',
        [ReportsController::class, 'deleteAssetAcceptance']
    )->name('reports/unaccepted_assets_delete');
    Route::post(
        'reports/unaccepted_assets/{deleted?}',
        [ReportsController::class, 'postAssetAcceptanceReport']
    )->name('reports/export/unaccepted_assets');
});

Route::get(
    'auth/signin',
    [LoginController::class, 'legacyAuthRedirect']
);


/*
|--------------------------------------------------------------------------
| Setup Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::group(['prefix' => 'setup', 'middleware' => 'web'], function () {
    Route::get(
        'user',
        [SettingsController::class, 'getSetupUser']
    )->name('setup.user');

    Route::post(
        'user',
        [SettingsController::class, 'postSaveFirstAdmin']
    )->name('setup.user.save');


    Route::get(
        'migrate',
        [SettingsController::class, 'getSetupMigrate']
    )->name('setup.migrate');

    Route::get(
        'done',
        [SettingsController::class, 'getSetupDone']
    )->name('setup.done');

    Route::get(
        'mailtest',
        [SettingsController::class, 'ajaxTestEmail']
    )->name('setup.mailtest');

    Route::get(
        '/',
        [SettingsController::class, 'getSetupIndex']
    )->name('setup');
});





Route::group(['middleware' => 'web'], function () {

    Route::get(
        'login',
        [LoginController::class, 'showLoginForm']
    )->name("login");

    Route::post(
        'login',
        [LoginController::class, 'login']
    );

    Route::get(
        'two-factor-enroll',
        [LoginController::class, 'getTwoFactorEnroll']
    )->name('two-factor-enroll');

    Route::get(
        'two-factor',
        [LoginController::class, 'getTwoFactorAuth']
    )->name('two-factor');

    Route::post(
        'two-factor',
        [LoginController::class, 'postTwoFactorAuth']
    );



    Route::post(
        'password/email',
        [ForgotPasswordController::class, 'sendResetLinkEmail']
    )->name('password.email')->middleware('throttle:forgotten_password');

    Route::get(
        'password/reset',
        [ForgotPasswordController::class, 'showLinkRequestForm']
    )->name('password.request')->middleware('throttle:forgotten_password');


    Route::post(
        'password/reset',
        [ResetPasswordController::class, 'reset']
    )->name('password.update')->middleware('throttle:forgotten_password');

    Route::get(
        'password/reset/{token}',
        [ResetPasswordController::class, 'showResetForm']
    )->name('password.reset');


    Route::post(
        'password/email',
        [ForgotPasswordController::class, 'sendResetLinkEmail']
    )->name('password.email')->middleware('throttle:forgotten_password');





    Route::get(
        '/',
        [
            'as' => 'home',
            'middleware' => ['auth'],
            'uses' => 'DashboardController@getIndex' ]
    );

    // need to keep GET /logout for SAML SLO
    Route::get(
        'logout',
        [LoginController::class, 'logout']
    )->name('logout.get');

    Route::post(
        'logout',
        [LoginController::class, 'logout']
    )->name('logout.post');
});

//Auth::routes();

Route::get(
    '/health', 
    [HealthController::class, 'get']
)->name('health');

Route::middleware(['auth'])->get(
    '/',
    [DashboardController::class, 'index']
)->name('home');

Route::get('/chatbot/url',[ChatbotController::class,'index']);
Route::post('/chatbot/url',[ChatbotController::class,'addUrl']);



// urls for atutodiscoverys 

//urls for ip scan
Route::get(
    'AutoDiscovery/ipScan', 
    [AutoDiscoveryController::class, 'ipScan']
)->name('AutoDiscovery.ipScan');

Route::get(
    'AutoDiscovery/viewipScan', 
    [AutoDiscoveryController::class, 'viewIpScan']
)->name('AutoDiscovery.viewipScan');

Route::post(
    'AutoDiscovery/addipscan', 
    [AutoDiscoveryController::class, 'addipscan']
)->name('AutoDiscovery.addipscan');
Route::delete('AutoDiscovery/deleteIPScan/{id}', [AutoDiscoveryController::class, 'deleteIPScan'])->name('AutoDiscovery.deleteIPScan');






//urls for subnet scan
Route::get(
    'AutoDiscovery/subnetScan', 
    [AutoDiscoveryController::class, 'subnetScan']
)->name('AutoDiscovery.subnetScan');

Route::get(
    'AutoDiscovery/viewsubnetScan', 
    [AutoDiscoveryController::class, 'viewsubnetScan']
)->name('AutoDiscovery.viewsubnetscan');

Route::post(
    'AutoDiscovery/addsubnetScan', 
    [AutoDiscoveryController::class, 'addsubnetScan']
)->name('AutoDiscovery.addsubnetScan');

Route::delete('AutoDiscovery/deleteSubnetScan/{id}', [AutoDiscoveryController::class, 'deleteSubnetScan'])->name('AutoDiscovery.deleteSubnetScan');






//urls for network discovery
Route::get(
    'AutoDiscovery/viewNetworkDiscovery', 
    [AutoDiscoveryController::class, 'viewNetworkDiscovery']
)->name('AutoDiscovery.viewNetworkDiscovery');


//urls for schedule scan
Route::get(
    'AutoDiscovery/schedueleScan', 
    [AutoDiscoveryController::class, 'schedueleScan']
)->name('AutoDiscovery.schedueleScan');

Route::get(
    'AutoDiscovery/viewschedueleScan', 
    [AutoDiscoveryController::class, 'viewschedueleScan']
)->name('AutoDiscovery.viewschedueleScan');

Route::post(
    'AutoDiscovery/addschedueleScan', 
    [AutoDiscoveryController::class, 'addschedueleScan']
)->name('AutoDiscovery.addschedueleScan');
Route::delete('AutoDiscovery/deleteScheduleScan/{id}', [AutoDiscoveryController::class, 'deleteScheduleScan'])->name('AutoDiscovery.deleteScheduleScan');

//import function for the data filling into the asset table

Route::post('AutoDiscovery/import', [AutoDiscoveryController::class, 'import'])->name('AutoDiscovery.import');



//view  route for SW inventory
Route::get(
    'AutoDiscovery/viewSWInventory', 
    [AutoDiscoveryController::class, 'viewSWInventory']
)->name('AutoDiscovery.viewSWInventory');

//view route for SWL inventory
Route::get(
    'AutoDiscovery/viewSWLInventory', 
    [AutoDiscoveryController::class, 'viewSWLInventory']
)->name('AutoDiscovery.viewSWLInventory');

// view route for software license management
Route::get(
    'AutoDiscovery/viewSoftwareMgt', 
    [AutoDiscoveryController::class, 'viewSoftwareMgt']
)->name('AutoDiscovery.viewSoftwareMgt');


//view route for HW inventory
Route::get(
    'AutoDiscovery/viewHWInventory', 
    [AutoDiscoveryController::class, 'viewHWInventory']
)->name('AutoDiscovery.viewHWInventory');



// view route for Processor Configuration

Route::get(
    'AutoDiscovery/viewProcessorConfiguration', 
    [AutoDiscoveryController::class, 'viewProcessorConfiguration']
)->name('AutoDiscovery.viewProcessorConfiguration');

// view route for Install memeory Configuration

Route::get(
    'AutoDiscovery/viewMemoryConfiguration', 
    [AutoDiscoveryController::class, 'viewMemoryConfiguration']
)->name('AutoDiscovery.viewMemoryConfiguration');


// view route for Hard Disk Configuration

Route::get(
    'AutoDiscovery/viewDiskConfiguration', 
    [AutoDiscoveryController::class, 'viewDiskConfiguration']
)->name('AutoDiscovery.viewDiskConfiguration');


// view route for Logical Drive Configuration

Route::get(
    'AutoDiscovery/viewDriveConfiguration', 
    [AutoDiscoveryController::class, 'viewDriveConfiguration']
)->name('AutoDiscovery.viewDriveConfiguration');



// device wise and device wise get data
Route::get(
    'AutoDiscovery/viewDeviceWise', 
    [AutoDiscoveryController::class, 'viewDeviceWise']
)->name('AutoDiscovery.viewDeviceWise');

Route::get('/getDataDeviceWise/{deviceIp}', [AutoDiscoveryController::class, 'getDataDeviceWise']);


// Software wise and software wise get data
Route::get(
    'AutoDiscovery/viewSoftwareWise', 
    [AutoDiscoveryController::class, 'viewSoftwareWise']
)->name('AutoDiscovery.viewSoftwareWise');

Route::get('/getDataSoftwareWise/{appname}', [AutoDiscoveryController::class, 'getDataSoftwareWise']);


//this route for the QR code generator for ipbased

Route::get('AutoDiscovery/ipBased', [AutoDiscoveryController::class, 'ipBased'])->name('AutoDiscovery.ipBased');

Route::get('AutoDiscovery/ipBasedData', [AutoDiscoveryController::class, 'ipBasedData'])->name('AutoDiscovery.ipBasedData');

Route::get('AutoDiscovery/addipbased', [AutoDiscoveryController::class, 'addipbased'])->name('AutoDiscovery.addipbased');

//this route for the QR code generator for nonipbased

Route::get('AutoDiscovery/nonIPBased', [AutoDiscoveryController::class, 'nonIPBased'])->name('AutoDiscovery.nonIPBased');

Route::get('AutoDiscovery/nonIPBasedData', [AutoDiscoveryController::class, 'nonIPBasedData'])->name('AutoDiscovery.nonIPBasedData');

Route::get('AutoDiscovery/addnonIPbased', [AutoDiscoveryController::class, 'addnonIPbased'])->name('AutoDiscovery.addnonIPbased');




// this route for the Asset Reconcilation

Route::get('AutoDiscovery/assetReconciliation', [AutoDiscoveryController::class, 'assetReconciliation'])->name('AutoDiscovery.assetReconciliation');

// this route for the RFID

Route::get('AutoDiscovery/assetRFID', [AutoDiscoveryController::class, 'assetRFID'])->name('AutoDiscovery.assetRFID');

// this route for the Asset Agent

Route::get('AutoDiscovery/assetAgent', [AutoDiscoveryController::class, 'assetAgent'])->name('AutoDiscovery.assetAgent');

Route::get('/agentInstallDevice', [AutoDiscoveryController::class, 'agentInstallDevice'])->name('AutoDiscovery.agentInstallDevice');
Route::get('/getHWInventory/{ip_address}', [AutoDiscoveryController::class, 'getHWInventory'])->name('AutoDiscovery.getHWInventory');

//route for softwre install and uninstalled log

Route::get('AutoDiscovery/swInstallUninstallLog', [AutoDiscoveryController::class, 'swInstallUninstallLog'])->name('AutoDiscovery.swInstallUninstallLog');


//software asset managment

Route::get('AutoDiscovery/addAssetManagement', [AutoDiscoveryController::class, 'addAssetManagement'])->name('AutoDiscovery.addAssetManagement');

Route::get('AutoDiscovery/getManufactureSoftware', [AutoDiscoveryController::class, 'getManufactureSoftware'])->name('AutoDiscovery.getManufactureSoftware');



Route::post('AutoDiscovery/submitAssetManagement', [AutoDiscoveryController::class, 'submitAssetManagement'])->name('AutoDiscovery.submitAssetManagement');


//view for asset management
Route::get('AutoDiscovery/viewAssetMgt', [AutoDiscoveryController::class, 'viewAssetMgt'])->name('AutoDiscovery.viewAssetMgt');

