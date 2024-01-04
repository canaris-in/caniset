<?php

namespace App\Http\Controllers\autoDiscovery;

use App\Http\Controllers\Controller;
use App\Models\IPScan;
use App\Models\Asset;
use App\Models\SoftwareInventory;
use App\Models\SoftwareLicenseInventory;
use App\Models\SubnetScan;
use App\Models\NetworkDiscovery;
use Illuminate\Http\Request;
use App\Models\ScheduleScan;
use App\Models\HardwareInventory;
use App\Models\ProcessorConfiguration;
use App\Models\MemoryConfiguration;
use App\Models\AgentInstalledDevice;
use App\Models\hwPrinter;
use App\Models\SwLicenseManagement;
use App\Models\SwInstallUninstallLog;
use App\Models\DiskConfiguration;
use App\Models\LogicaldriveConfiguration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\PdfToImage\Pdf;

class AutoDiscoveryController extends Controller
{


   // this below function is related to ipscan 

   public function addipscan(Request $request)
   {
      $request->validate([
         'group_name' => 'required|string|max:255',
         'start_ip' => 'required|ip',
         'end_ip' => 'required|ip',
      ]);


      $IPScan = IPScan::create([
         'group_name' => $request->input('group_name'),
         'start_ip' => $request->input('start_ip'),
         'end_ip' => $request->input('end_ip'),

      ]);
   }

   public function viewIpScan()
   {
      $data = IPScan::all(['id', 'start_ip', 'group_name', 'end_ip']);
      return view('AutoDiscovery.viewIPScan', ['data' => $data]);
   }

   public function ipScan()
   {
      return view('AutoDiscovery.ipscan');
   }
   public function deleteIPScan($id)
   {
      try {
         $item = IPScan::findOrFail($id);
         $item->delete();
         return redirect()->route('AutoDiscovery.viewipScan')->with('success', 'Record deleted successfully');
      } catch (\Exception $e) {
         return response()->json(['error' => 'Error deleting item', 'message' => $e->getMessage()], 500);
      }
   }






   // this below function is related to subnet scan 

   public function subnetScan()
   {
      return view('AutoDiscovery.subnetscan');
   }
   public function addsubnetScan(Request $request)
   {
      $request->validate([
         'group_name' => 'required|string|max:255',
         'start_ip' => 'required|ip',
         'subnet_mask' => 'required|ip',
      ]);


      $SubnetScan = SubnetScan::create([
         'group_name' => $request->input('group_name'),
         'start_ip' => $request->input('start_ip'),
         'subnet_mask' => $request->input('subnet_mask'),

      ]);
   }
   public function viewsubnetScan()
   {
      $data = SubnetScan::all(['id', 'start_ip', 'group_name', 'subnet_mask']);
      return view('AutoDiscovery.viewSubnetScan', ['data' => $data]);
   }
   public function deleteSubnetScan($id)
   {
      try {
         $item = SubnetScan::findOrFail($id);
         $item->delete();
         return redirect()->route('AutoDiscovery.viewsubnetscan')->with('success', 'Record deleted successfully');
      } catch (\Exception $e) {
         return response()->json(['error' => 'Error deleting item', 'message' => $e->getMessage()], 500);
      }
   }






   // this below function is related to Network discovery

   public function viewNetworkDiscovery()
   {
      $data = NetworkDiscovery::all(['id', 'node_ip', 'location', 'mac_ip', 'node_name', 'oem', 'os_type']);
      return view('AutoDiscovery.viewnetworkdiscovery', ['data' => $data]);
   }



   // this below function is related to schedule scan

   public function schedueleScan()
   {
      return view('AutoDiscovery.schedulescan');
   }

   public function viewschedueleScan()
   {
      $data = ScheduleScan::all(['id', 'start_ip', 'schedule_type', 'subnet_mask', 'configuration_type', 'once_time']);
      return view('AutoDiscovery.viewScheduleScan', ['data' => $data]);
   }
   public function addschedueleScan(Request $request)
   {


      // return $request->input('configuration_type');
      $request->validate([
         'scheduleType' => 'required',
         'start_ip' => 'required|ip',
         'subnet_mask' => 'required|ip',
         'configuration_type' => 'required',
         'once_time' => 'required',
      ]);

      $ScheduleScan = ScheduleScan::create([
         'schedule_type' => $request->input('scheduleType'),
         'start_ip' => $request->input('start_ip'),
         'subnet_mask' => $request->input('subnet_mask'),
         'configuration_type' => $request->input('configuration_type'),
         'once_time' => $request->input('once_time')

      ]);
   }

   public function deleteScheduleScan($id)
   {
      try {
         $item = ScheduleScan::findOrFail($id);
         $item->delete();
         return redirect()->route('AutoDiscovery.viewschedueleScan')->with('success', 'Record deleted successfully');
      } catch (\Exception $e) {
         return response()->json(['error' => 'Error deleting item', 'message' => $e->getMessage()], 500);
      }
   }



   // import function for the auto discovery function

   public function import(Request $request)
   {
      $selectedItems = $request->input('selectedItems');

      //    foreach ($selectedItems as $item) {
      //       Asset::create([
      //           'name' => $item['node_name']
      //       ]);
      //   }
      foreach ($selectedItems as $item) {
         DB::table('assets')->insert([
            'name' => $item['node_name'],
            'user_id' => 2,
            'model_id' => 1,
            'status_id' => 2,
            'asset_tag' => 1244
            // Add other fields as needed
         ]);
      }
      return response()->json(['message' => 'Record Imported successfully']);
   }



   //function for the view of software inventory
   public function viewSWInventory()
   {
      $data = SoftwareInventory::all([
         'id', 'asset_id',
         'device_name',
         'device_ip',
         'mac_id',
         'application_name',
         'application_version',
         'is_license',
         'license_key',
         'product_id',
         'publisher',
         'uninstall_str'
      ]);
      return view('AutoDiscovery.viewSoftwareInventory', ['data' => $data]);
   }

   //function for the view of software license inventory


   public function viewSWLInventory()
   {
      $data = SoftwareLicenseInventory::all([
         'id',
         'asset_id',
         'device_name',
         'device_ip',
         'mac_id',
         'data_type',
         'product_name',
         'product_type',
         'value'
      ]);
      return view('AutoDiscovery.viewSoftwareLicenseInventory', ['data' => $data]);
   }


   //function for viewSoftwareMgt
   public function viewSoftwareMgt(){
      $SoftwareMgt = [
         json_decode('{"AssetTag": "/adobe", "Manufacturer": "Adobe Systems Incorporated", "Software": "Adobe Acrobat Reader DC", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "/adobe/License", "Manufacturer": "Adobe Systems Incorporated", "Software": "Adobe Acrobat Reader XI", "TotalVolume": "5", "UsedVolume": "5", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "AMD", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "NEW", "Manufacturer": "FEIG ELECTRONIC GmbH", "Software": "Windows Driver Package FEIG ELECTRONIC GmbH", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "Tally", "Manufacturer": "Tally Solutions Pvt. Ltd.", "Software": "Tally.ERP 9", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "/Chrome", "Manufacturer": "Google", "Software": "Chrome 5.8", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "Teams", "Manufacturer": "Microsoft", "Software": "Microsoft team", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "Apache12", "Manufacturer": "Apache12", "Software": "Apache12 version 4", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "/mysql", "Manufacturer": "Oracle Pvt", "Software": "Database Server", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "Excel", "Manufacturer": "Microsoft Software", "Software": "Microsoft", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
         json_decode('{"AssetTag": "Anydesk", "Manufacturer": "AnyDesk Software GmbH", "Software": "Anydesk", "TotalVolume": "3", "UsedVolume": "0", "AvailableVolume": "3", "UnlicensedDevices": "0", "TotalInstallApps": "3", "LicenseType": "Volume", "LicenseOption": "Full Package", "AcquisitionDate": "2020-05-17", "ExpiryDate": "2020-05-17", "SubLocation": "Conference Room", "Location": "", "Vendor": "", "PurchaseCost": "", "PurchaseDate": "", "InvoiceNo": "", "InvoiceDate": "", "AMCExpiryDate": "2020-06-17", "AMCEffectiveDate": "2020-06-17", "InsuranceEffectiveDate": "2020-06-17", "InsuranceExpiryDate": "2020-06-17", "WarrantyExpiryDate": "2020-06-1", "WarrantyEffectiveDate": "2020-06-2", "AgeOfAssets": "2020-06-2"}', true),
     ];
      return view('AutoDiscovery.viewSoftwareMgt', ['data' => $SoftwareMgt]);
   }

   //function for the view of Hardware license inventory


   public function viewHWInventory()
   {
      $data = HardwareInventory::all([
         'id',
         'asset_id',
         'bios_manufacturer',
         'bios_name',
         'bios_release_date',
         'bios_version',
         'build_number',
         'disk_space',
         'domain',
         'host_name',
         'ip_address',
         'mac_address',
         'manufacturer',
         'original_serial_no',
         'os_name',
         'os_type',
         'os_version',
         'processor_count',
         'processor_manufacturer',
         'processor_name',
         'product_id',
         'service_pack',
         'system_model',
         'total_memory',
      ]);
      return view('AutoDiscovery.viewHardwareInventory', ['data' => $data]);
   }


   //function for the view of Processor Configuration


   public function viewProcessorConfiguration()
   {
      $data = ProcessorConfiguration::all([
         'asset_id', 'bios_manufacturer', 'bios_name', 'bios_release_date', 'bios_version', 'build_number', 'disk_space', 'domain', 'host_name', 'ip_address',
         'mac_address', 'mac_address', 'manufacturer', 'original_serial_no', 'os_name', 'os_type', 'os_version', 'processor_count', 'processor_manufacturer',
         'processor_name', 'product_id', 'service_pack', 'system_model', 'total_memory'
      ]);
      return view('AutoDiscovery.viewProcessorConfiguration', ['data' => $data]);
   }

   //function for the view of Install memeory Configuration


   public function viewMemoryConfiguration()
   {
      $data = MemoryConfiguration::all([
         'id',
         'asset_id', 'bank_label', 'capacity', 'frequency', 'module_tag', 'serial_number', 'socket'
      ]);
      return view('AutoDiscovery.viewMemoryConfiguration', ['data' => $data]);
   }

   //function for the view of Hard Disk Configuration


   public function viewDiskConfiguration()
   {
      $data = DiskConfiguration::all([
         'id',
         'asset_id', 'capacity', 'interface_type', 'manufacturer', 'media_type', 'model', 'name', 'serial_number'
      ]);
      return view('AutoDiscovery.viewDiskConfiguration', ['data' => $data]);
   }

   //function for the view of ogical Drive Configuration


   public function viewDriveConfiguration()
   {
      $data = LogicaldriveConfiguration::all([
         'id',
         'asset_id', 'capacity', 'drive', 'drive_type', 'drive_usage', 'file_type', 'free_space', 'serial_number'
      ]);
      return view('AutoDiscovery.viewDriveConfiguration', ['data' => $data]);
   }


   // function for the  list of software device wise

   public function viewDeviceWise()
   {
      $data = SoftwareInventory::select()
         ->selectRaw('COUNT(application_name) as app_count')
         ->groupBy('device_name', 'device_ip', 'mac_id')
         ->get();
      return view("AutoDiscovery.viewDeviceWise", ['data' => $data]);
   }

   public function getDataDeviceWise($deviceIp)
   {

      $data = SoftwareInventory::select('application_name', 'publisher', 'application_version')
         ->where('device_ip', $deviceIp)->get();

      return response()->json(['data' => $data]);
   }

   // function for the  list of software Software wise

   public function viewSoftwareWise()
   {
      $data = SoftwareInventory::select('application_name', 'application_version', 'publisher')
         ->selectRaw('COUNT(application_name) as app_count')
         ->groupBy('application_name', 'application_version', 'publisher')
         ->get();
      return view("AutoDiscovery.viewSoftwareWise", ['data' => $data]);
   }

   public function getDataSoftwareWise($appname)
   {

      $data = SoftwareInventory::select('device_name', 'device_ip', 'mac_id')
         ->where('application_name', $appname)
         ->get();

      return response()->json(['data' => $data]);
   }


   //Function for QR code generator on IP Based

   public function ipBased()
   {

      return view("AutoDiscovery.ipbased");
   }

   public function ipBasedData(Request $request)
   {
      $generateData = $request->input('generate_data');

      $ipBasedData = DB::table('hw_assets')
         ->select($generateData)
         ->where('ASSET_TYPE', 'IPBased')
         ->where('MONITORING_STATUS', '!=', 'False')
         ->get();
      return response()->json($ipBasedData);
   }


   public function addipbased(Request $request)
   {


      $generateData = $request->input('generate_data');
      $ipBasedData = $request->input('asset_data');
      $givenFields = ['asset_tag', 'asset_name', 'location', 'category', 'acquisition_date', 'acquisition_date', 'asset_serial_number', 'asset_status', 'asset_type', 'class', 'company', 'department', 'group_name'];

      // Ensure $ipBasedData is an array
      if (!is_array($ipBasedData)) {
         // Handle the case where $ipBasedData is not an array
         return "Invalid asset_data format";
      }

      $ipBasedData = DB::table('hw_assets as hw_asset')
         ->select($givenFields)
         ->whereIn('hw_asset.' . $generateData, $ipBasedData)
         ->where('hw_asset.ASSET_TYPE', 'IPBased')
         ->where('hw_asset.MONITORING_STATUS', '!=', 'False')
         ->get();

      // foreach ($ipBasedData as $data) {
      //    $qrCodeData = json_encode([
      //       'asset_tag' => $data->asset_tag,
      //       'asset_name' => $data->asset_name,
      //       'location' => $data->location,
      //       // Add more fields as needed
      //    ]);

      //    // Generate QR code
      //    $qrCode = QrCode::size(300)->generate($qrCodeData);
      //    $pdf = app('dompdf.wrapper')->loadView('qr_code', compact('qrCodeData', 'qrCode'));

      //    // Save the PDF to storage
      //    $pdfPath = 'qrcode.pdf';
      //    Storage::put($pdfPath, $pdf->output());



      // }
      // return $pdf->stream('qrcode.pdf');












      $pdfPaths = [];

      foreach ($ipBasedData as $data) {
         $qrCodeData = json_encode([
            'asset_tag' => $data->asset_tag,
            'asset_name' => $data->asset_name,
            'location' => $data->location,
            // Add more fields as needed
         ]);

         // Generate QR code
         $qrCode = QrCode::size(300)->generate($qrCodeData);

         // Generate PDF for each item
         $pdf = app('dompdf.wrapper')->loadView('qr_code', compact('qrCodeData', 'qrCode'));

         // Save the PDF to storage
         $pdfPath = 'qrcode_' . $data->asset_tag . '.pdf'; // Use a unique name for each PDF
         Storage::put($pdfPath, $pdf->output());

         // Store the PDF path in the array
         $pdfPaths[] = storage_path('app/' . $pdfPath);
      }

      // Merge all PDFs into a single PDF
      $mergedPdfPath = 'merged_qrcodes.pdf';
      // $pdfMerger = new Pdf();
      // $pdfMerger->addPages($pdfPaths);
      // $pdfMerger->saveAs(storage_path('app/' . $mergedPdfPath));

      // Stream the merged PDF to the browser
      return response()->download(storage_path('app/' . $mergedPdfPath))->deleteFileAfterSend(true);
      // return response("Pdf Downloaded");
   }



   //Function for QR code generator on NON IP Based


   public function nonIPBased()
   {

      return view("AutoDiscovery.nonipbased");
   }

   public function nonIPBasedData(Request $request)
   {
      $generateData = $request->input('generate_data');

      $ipBasedData = DB::table('hw_assets')
         ->select($generateData)
         ->where('ASSET_TYPE', 'NONIPBased')
         ->where('MONITORING_STATUS', '!=', 'False')
         ->get();
      return response()->json($ipBasedData);
   }


   public function addnonIPbased(Request $request)
   {


      $generateData = $request->input('generate_data');
      $ipBasedData = $request->input('asset_data');
      $givenFields = ['asset_tag', 'asset_name', 'location', 'category', 'acquisition_date', 'acquisition_date', 'asset_serial_number', 'asset_status', 'asset_type', 'class', 'company', 'department', 'group_name'];

      // Ensure $ipBasedData is an array
      if (!is_array($ipBasedData)) {
         // Handle the case where $ipBasedData is not an array
         return "Invalid asset_data format";
      }

      $ipBasedData = DB::table('hw_assets as hw_asset')
         ->select($givenFields)
         ->whereIn('hw_asset.' . $generateData, $ipBasedData)
         ->where('hw_asset.ASSET_TYPE', 'NONIPBased')
         ->where('hw_asset.MONITORING_STATUS', '!=', 'False')
         ->get();
   }


   // function for the asset reconcilation

   public function assetReconciliation(){
      return view("AutoDiscovery.assetReconcilation");
   }

   //function for the rfid

   public function assetRFID(){
      return view("AutoDiscovery.assetRFID");
   }


   //function for the Asset Agent

   public function assetAgent(){

      $data = AgentInstalledDevice::all([
         'id',
    'IP_ADDRESS', 'HOST_NAME', 'BRANCH_NAME', 'AGENT_START_TIME',
    'DEVICE_STATUS', 'VERSION', 'MAC_ADDRESS', 'DEVICE_IP',
    'DEVICE_MAC_LIST', 'SW_LAST_DISCOVER', 'SERIALNUMBER',
    'SW_COUNT', 'SW_SCAN_TYPE',
      ]);
      return view("AutoDiscovery.agentInstalledDevice", ['data' => $data]);
      // return view("AutoDiscovery.hwInventory");
   }

   public function agentInstallDevice(Request $request){
   
      $ipAddress = $request->input('ip_address');
      return response()->json(['ip_address' => $ipAddress]);
      

      
   }

   public function getHWInventory($ipAddress){

      
      $swInventory = SoftwareInventory::where('device_ip', $ipAddress)->get([
         'id', 'asset_id',
         'device_name',
         'device_ip',
         'mac_id',
         'application_name',
         'application_version',
         'is_license',
         'license_key',
         'product_id',
         'publisher',
         'uninstall_str'
     ]);
      $swlInventory= SoftwareLicenseInventory::where('device_ip', $ipAddress)->get([
         'id',
         'asset_id',
         'device_name',
         'device_ip',
         'mac_id',
         'data_type',
         'product_name',
         'product_type',
         'value'
      ]);

      $hwInventory=HardwareInventory::where('ip_address', $ipAddress)->get([
         'id',
         'manufacturer',
         'processor_count',
         'processor_name'
      ]);

      $memoryInventory=MemoryConfiguration::where('ip_address', $ipAddress)->get([
         'id','bank_label', 'capacity', 'frequency', 'module_tag', 'serial_number', 'socket'
      ]);

      $diskInventory=DiskConfiguration::where('ip_address', $ipAddress)->get([
         'id','capacity', 'interface_type', 'manufacturer', 'media_type', 'model', 'name', 'serial_number'
      ]);

      $driveInventory=LogicaldriveConfiguration::where('ip_address', $ipAddress)->get([
         'id','capacity', 'drive', 'drive_type', 'drive_usage', 'file_type', 'free_space', 'serial_number'
      ]);
      $hwPrinter=hwPrinter::where('ip_address', $ipAddress)->get([
         'sr_no','driver_name', 'location', 'model', 'name', 'server', 'type',
      ]);

      $hardwareData=HardwareInventory::where('ip_address', $ipAddress)->get([
         'id', 'bios_manufacturer', 'bios_name', 'bios_release_date', 'bios_version', 'build_number', 'disk_space', 'domain', 'host_name', 'ip_address',
          'mac_address', 'manufacturer', 'original_serial_no', 'os_name', 'os_type', 'os_version', 'processor_count', 'processor_manufacturer',
         'processor_name', 'product_id', 'service_pack', 'system_model', 'total_memory'
      ]);

      // return $hardwareData;
      // return $swInventory;
      return view("AutoDiscovery.hwInventory",['swData' => $swInventory,'swlData'=>$swlInventory,'hwInventory'=>$hwInventory,'memoryInventory'=>$memoryInventory,'diskInventory'=>$diskInventory,'driveInventory'=>$driveInventory,'hwPrinter'=>$hwPrinter,'hardwareData'=>$hardwareData]);
   }



   // controller for swInstallUninstallLog 

   public function swInstallUninstallLog()
   {
      $data = SwInstallUninstallLog::all('host_name',
      'ip_address',
      'branch_name',
      'scan_type',
      'event_type',
      'event_time',
      'application_name',
      'application_publisher',
      'application_version',
      'application_install_date',);
      return view("AutoDiscovery.swInstallUninstallLog", ['data' => $data]);
   }


   //add asset form
   
   public function addAssetManagement(){
      $manufactureName = SoftwareInventory::distinct()->pluck('publisher');
      return view("AutoDiscovery.addAssetMgtForm", ['manufactureName' => $manufactureName]);
   }


   public function getManufactureSoftware(Request $request){
      $publisher = $request->input('manufacturer');

      $manufactureSoftware = SoftwareInventory::distinct()->pluck('publisher');
      $manufactureSoftware = SoftwareInventory::where('publisher', $publisher)
      ->pluck('application_name');

     return response()->json($manufactureSoftware);


   }



   public function submitAssetManagement(Request $request){


      $validator = Validator::make($request->all(), [
         // Add your validation rules here
          // First set of fields
    'manufactureName' => 'required',
    'manufactureSoftware' => 'required',
    'licenseType' => 'required',
    'licenseOption' => 'required',

     // Second set of fields
    // Second set of fields (required if any field in this set is filled)
    'asset_tag' => 'required_without_all:vendor,warranty_effective_date',
    'expiry_date' => 'sometimes|required_without_all:vendor,warranty_effective_date',
    'acquistionDate' => 'sometimes|required_without_all:vendor,warranty_effective_date',
    'location' => 'sometimes|required_without_all:vendor,warranty_effective_date',
    'subLocation' => 'sometimes|required_without_all:vendor,warranty_effective_date',
    'description' => 'sometimes|required_without_all:vendor,warranty_effective_date',

    // Third set of fields (required if any field in this set is filled)
    'vendor' => 'required_without_all:asset_tag,warranty_effective_date',
    'purchase_order_no' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',
    'purchase_cost' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',
    'purchase_date' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',
    'invoice_no' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',
    'invoice_date' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',
    'purchaseBill' => 'sometimes|required_without_all:asset_tag,warranty_effective_date',

    // Fourth set of fields (required if any field in this set is filled)
    'warranty_effective_date' => 'required_without_all:asset_tag,vendor',
    'warranty_expiry_date' => 'required_with:warranty_effective_date',
    'amc_effective_date' => 'sometimes|required_without_all:asset_tag,vendor',
    'amc_expiry_date' => 'sometimes|required_without_all:asset_tag,vendor',
    'insurance_effective_date' => 'sometimes|required_without_all:asset_tag,vendor',
    'insurance_expiry_date' => 'sometimes|required_without_all:asset_tag,vendor',
    'insurance_company_name' => 'sometimes|required_without_all:asset_tag,vendor',
    'insurance_policy_no' => 'sometimes|required_without_all:asset_tag,vendor',
    'amc_agreement' => 'sometimes|required_without_all:asset_tag,vendor',
    'amc_bill' => 'sometimes|required_without_all:asset_tag,vendor',
    'warranty_bill' => 'sometimes|required_without_all:asset_tag,vendor',
    'insurance_bill' => 'sometimes|required_without_all:asset_tag,vendor',
     ]);
 
//      $validator->sometimes(
//       ['manufactureName', 'manufactureSoftware', 'licenseType', 'licenseOption'],
//       'required',
//       function ($input) {
//           return empty($input->asset_tag) && empty($input->vendor) && empty($input->warranty_effective_date);
//       }
//   );

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 422);
     }



      $manufactureName = $request->input('manufactureName');
      $manufactureSoftware = $request->input('manufactureSoftware');
      $licenseType = $request->input('licenseType');
      $licenseOption = $request->input('licenseOption');
      $asset_tag = $request->input('asset_tag');
      $expiry_date = $request->input('expiry_date');
      $acquistionDate = $request->input('acquistionDate');
      $location = $request->input('location');
      $subLocation = $request->input('subLocation');
      $description = $request->input('description');
      $vendor = $request->input('vendor');
      $purchase_order_no = $request->input('purchase_order_no');
      $purchase_cost = $request->input('purchase_cost');
      $purchase_date = $request->input('purchase_date');
      $invoice_no = $request->input('invoice_no');
      $invoice_date = $request->input('invoice_date');
      $purchaseBill = $request->file('purchaseBill');
      $warranty_effective_date = $request->input('warranty_effective_date');
      $warranty_expiry_date = $request->input('warranty_expiry_date');
      $amc_effective_date = $request->input('amc_effective_date');
      $amc_expiry_date = $request->input('amc_expiry_date');
      $insurance_effective_date = $request->input('insurance_effective_date');
      $insurance_expiry_date = $request->input('insurance_expiry_date');
      $insurance_company_name = $request->input('insurance_company_name');
      $insurance_policy_no = $request->input('insurance_policy_no');
      $amc_agreement = $request->file('amc_agreement');
      $amc_bill = $request->file('amc_bill');
      $warranty_bill = $request->file('warranty_bill');
      $insurance_bill = $request->file('insurance_bill');

      if ($request->hasFile('purchaseBill')) {
         $fileName = uniqid('file_') . '.' . $purchaseBill->getClientOriginalExtension();
         Storage::disk('local')->makeDirectory('mydata');
         Storage::disk('local')->put('mydata/' . $fileName, file_get_contents($purchaseBill));
       }
 
      $insertGeneral = [

         'MANUFACTURER' => $manufactureName,
         'MANUFACTURER_SW' => $manufactureSoftware,
         'LICENSE_TYPE' => $licenseType,
         'LICENSE_OPTION' => $licenseOption,
         'ASSET_TAG' => $asset_tag,
         'EXPIRY_DATE' => $expiry_date,
         'ACQUISITION_DATE' => $acquistionDate,
         'LOCATION' => $location
       
     ];

    

  

      if($asset_tag!==null && $expiry_date!=null && $acquistionDate!=null && $location!=null && $subLocation!=null && $description!=null){
              SwLicenseManagement::create($insertGeneral);
              return "rajesh";
            
      }
      else if($vendor!==null && $purchase_order_no!=null && $purchase_cost!=null && $purchase_date!=null && $invoice_no!=null && $invoice_date!=null){
         $filePath="";
         if ($request->hasFile('purchaseBill')) {
            $fileName = uniqid('file_') . '.' . $purchaseBill->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('purchaseBill');
            $directoryPath = 'purchaseBill';

// Create the full path
           $filePath = $directoryPath . '/' . $fileName;
            Storage::disk('local')->put('purchaseBill/' . $fileName, file_get_contents($purchaseBill));
          }


         $insertFinancial = [
            'MANUFACTURER' => $manufactureName,
               'MANUFACTURER_SW' => $manufactureSoftware,
               'LICENSE_TYPE' => $licenseType,
               'LICENSE_OPTION' => $licenseOption,   
            'VENDOR' => $vendor,
            'PURCHASE_ORDER_NO' => $purchase_order_no,
            'PURCHASE_COST' => $purchase_cost,
            'PURCHASE_BILL'=>$filePath,
            'PURCHASE_DATE' => $purchase_date,
            'INVOICE_NO' => $invoice_no,
            'INVOICE_DATE' => $invoice_date
        ];
         SwLicenseManagement::create($insertFinancial);


         return "rohit";
      }
      else if($warranty_effective_date!==null && $warranty_expiry_date!=null && $amc_effective_date!=null && $amc_expiry_date!=null && $insurance_effective_date!=null && $insurance_expiry_date!=null){ 
         $amcfilePath="";
         $amcBillfilePath="";
         $warrantyfilePath="";
         $insurancefilePath="";
         if ($request->hasFile('amc_agreement')) {
            $fileName = uniqid('file_') . '.' . $amc_agreement->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('amc_agreement');
            $directoryPath = 'amc_agreement';

       // Create the full path
       $amcfilePath = $directoryPath . '/' . $fileName;
            Storage::disk('local')->put('amc_agreement/' . $fileName, file_get_contents($amc_agreement));
          }

          if ($request->hasFile('amc_bill')) {
            $fileName = uniqid('file_') . '.' . $amc_bill->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('amc_bill');
            $directoryPath = 'amc_bill';

       // Create the full path
       $amcBillfilePath = $directoryPath . '/' . $fileName;
            Storage::disk('local')->put('amc_bill/' . $fileName, file_get_contents($amc_bill));
          }

          if ($request->hasFile('warranty_bill')) {
            $fileName = uniqid('file_') . '.' . $warranty_bill->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('warranty_bill');
            $directoryPath = 'warranty_bill';

       // Create the full path
       $warrantyfilePath = $directoryPath . '/' . $fileName;
            Storage::disk('local')->put('warranty_bill/' . $fileName, file_get_contents($warranty_bill));
          }

          if ($request->hasFile('insurance_bill')) {
            $fileName = uniqid('file_') . '.' . $insurance_bill->getClientOriginalExtension();
            Storage::disk('local')->makeDirectory('insurance_bill');
            $directoryPath = 'insurance_bill';

       // Create the full path
       $insurancefilePath = $directoryPath . '/' . $fileName;
            Storage::disk('local')->put('insurance_bill/' . $fileName, file_get_contents($insurance_bill));
          }
          $insertMaintenance = [
         
            'MANUFACTURER' => $manufactureName,
                  'MANUFACTURER_SW' => $manufactureSoftware,
                  'LICENSE_TYPE' => $licenseType,
                  'LICENSE_OPTION' => $licenseOption,
            'WARRANTY_EFFECTIVE_DATE' => $warranty_effective_date,
            'WARRANTY_EXPIRY_DATE' => $warranty_expiry_date,
            'AMC_EFFECTIVE_DATE' => $amc_effective_date,
            'AMC_EXPIRY_DATE' => $amc_expiry_date,
            'INSURANCE_EFFECTIVE_DATE' => $insurance_effective_date,
            'INSURANCE_EXPIRY_DATE' => $insurance_expiry_date,
            'AMC_AGREEMENT' => $amcfilePath,
            'AMC_BILL' => $amcBillfilePath,
            'WARRANTY_BILL' => $warrantyfilePath,
            'INSURANCE_BILL' => $insurancefilePath
         ];
         SwLicenseManagement::create($insertMaintenance);
         return "gopal";
      }







      // return redirect()->route('AutoDiscovery.addAssetManagement')->with('success', 'Record Inserted successfully');


   //    $data = [
   //       'manufactureName' => $request->input('manufactureName'),
   //       'manufactureSoftware' => $request->input('manufactureSoftware'),
   //       'licenseType' => $request->input('licenseType'),
   //       'licenseOption' => $request->input('licenseOption'),
   //       'asset_tag' => $request->input('asset_tag'),
   //       'expiry_date' => $request->input('expiry_date'),
   //       'acquistionDate' => $request->input('acquistionDate'),
   //       'location' => $request->input('location'),
   //       'subLocation' => $request->input('subLocation'),
   //       'description' => $request->input('description'),
   //       'vendor' => $request->input('vendor'),
   //       'purchase_order_no' => $request->input('purchase_order_no'),
   //       'purchase_cost' => $request->input('purchase_cost'),
   //       'purchase_date' => $request->input('purchase_date'),
   //       'invoice_no' => $request->input('invoice_no'),
   //       'invoice_date' => $request->input('invoice_date'),
   //       'purchaseBill' => $request->input('purchaseBill'),
   //       'warranty_effective_date' => $request->input('warranty_effective_date'),
   //       'warranty_expiry_date' => $request->input('warranty_expiry_date'),
   //       'amc_effective_date' => $request->input('amc_effective_date'),
   //       'amc_expiry_date' => $request->input('amc_expiry_date'),
   //       'insurance_effective_date' => $request->input('insurance_effective_date'),
   //       'insurance_expiry_date' => $request->input('insurance_expiry_date'),
   //       'insurance_company_name' => $request->input('insurance_company_name'),
   //       'insurance_policy_no' => $request->input('insurance_policy_no'),
   //       'amc_agreement' => $request->input('amc_agreement'),
   //       'amc_bill' => $request->input('amc_bill'),
   //       'warranty_bill' => $request->input('warranty_bill'),
   //       'insurance_bill' => $request->input('insurance_bill'),
   //   ];
     
    


   }




   // function for view asset management
   public function viewAssetMgt(){
      $data=SwLicenseManagement::all();

      return view("AutoDiscovery.viewAssetMgt", ['data' => $data]);
   }
}
