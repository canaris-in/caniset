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
use App\Models\DiskConfiguration;
use App\Models\LogicaldriveConfiguration;
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

      $data = SoftwareInventory::all('application_name', 'publisher', 'application_version')
         ->where('device_ip', $deviceIp);

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
   }

   public function agentInstallDevice($ipAddress){
      

      return view("AutoDiscovery.agentInstalledDevice");
   }
}
