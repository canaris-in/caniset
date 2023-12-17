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
use App\Models\DiskConfiguration;
use App\Models\LogicaldriveConfiguration;
use Illuminate\Support\Facades\DB;
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
      $data = NetworkDiscovery::all(['id','node_ip', 'location', 'mac_ip','node_name', 'oem', 'os_type']);
      return view('AutoDiscovery.viewnetworkdiscovery', ['data' => $data]);
   }



   // this below function is related to schedule scan

   public function schedueleScan(){
      return view('AutoDiscovery.schedulescan');
   }

   public function viewschedueleScan(){
      $data = ScheduleScan::all(['id','start_ip', 'schedule_type', 'subnet_mask','configuration_type', 'once_time']);
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

   public function import(Request $request){
      $selectedItems = $request->input('selectedItems');

   //    foreach ($selectedItems as $item) {
   //       Asset::create([
   //           'name' => $item['node_name']
   //       ]);
   //   }
   foreach ($selectedItems as $item) {
      DB::table('assets')->insert([
          'name' => $item['node_name'],
          'user_id'=>2,
          'model_id'=>1,
          'status_id'=>2,
          'asset_tag'=>1244
          // Add other fields as needed
      ]);
  }
     return response()->json(['message' => 'Record Imported successfully']);

   }



   //function for the view of software inventory
   public function viewSWInventory(){
      $data = SoftwareInventory::select(['id', 'asset_id',
      'device_name',
      'device_ip',
      'mac_id',
      'application_name',
      'application_version',
      'is_license',
      'license_key',
      'product_id',
      'publisher',
      'uninstall_str'])->paginate(5);
      return view('AutoDiscovery.viewSoftwareInventory', ['data' => $data]);
   }

   //function for the view of software license inventory


   public function viewSWLInventory(){
      $data = SoftwareLicenseInventory::select([   'id',
      'asset_id',
      'device_name',
      'device_ip',
      'mac_id',
      'data_type',
      'product_name',
      'product_type',
      'value'])->paginate(10  );
      return view('AutoDiscovery.viewSoftwareLicenseInventory', ['data' => $data]);
   }

   //function for the view of Hardware license inventory


   public function viewHWInventory(){
      $data = HardwareInventory::select([
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
     ])->paginate(5);   
      return view('AutoDiscovery.viewHardwareInventory', ['data' => $data]);
   }


   //function for the view of Processor Configuration


   public function viewProcessorConfiguration(){
      $data = ProcessorConfiguration::select([ 
         'asset_id','bios_manufacturer','bios_name','bios_release_date','bios_version','build_number','disk_space','domain','host_name','ip_address',
        'mac_address','mac_address','manufacturer','original_serial_no','os_name','os_type','os_version','processor_count','processor_manufacturer',
        'processor_name','product_id','service_pack','system_model','total_memory'
      ])->paginate(5);
      return view('AutoDiscovery.viewProcessorConfiguration', ['data' => $data]);
   }

   //function for the view of Install memeory Configuration


   public function viewMemoryConfiguration(){
      $data = MemoryConfiguration::select([ 
         'id',
        'asset_id', 'bank_label', 'capacity', 'frequency', 'module_tag', 'serial_number', 'socket'
      ])->paginate(10  );
      return view('AutoDiscovery.viewMemoryConfiguration', ['data' => $data]);
   }

   //function for the view of Hard Disk Configuration


   public function viewDiskConfiguration(){
      $data = DiskConfiguration::select([ 
         'id',
         'asset_id', 'capacity', 'interface_type', 'manufacturer', 'media_type', 'model', 'name', 'serial_number'
      ])->paginate(10  );
      return view('AutoDiscovery.viewDiskConfiguration', ['data' => $data]);
   }

   //function for the view of ogical Drive Configuration


   public function viewDriveConfiguration(){
      $data = LogicaldriveConfiguration::select([   
         'id',
        'asset_id', 'capacity', 'drive', 'drive_type', 'drive_usage', 'file_type', 'free_space', 'serial_number'
      ])->paginate(10  );
      return view('AutoDiscovery.viewDriveConfiguration', ['data' => $data]);
   }


   // function for the  list of software device wise

   public function viewDeviceWise(){
      $data = SoftwareInventory::select(  )
            ->selectRaw('COUNT(application_name) as app_count')
            ->groupBy('device_name', 'device_ip', 'mac_id')
            ->paginate(10);
      return view("AutoDiscovery.viewDeviceWise", ['data' => $data]);
   }

   public function getDataDeviceWise($deviceIp){

      $data = SoftwareInventory::select('application_name', 'publisher', 'application_version')
      ->where('device_ip', $deviceIp)
      ->get();

  return response()->json(['data' => $data]);
}

 // function for the  list of software Software wise

 public function viewSoftwareWise(){
   $data = SoftwareInventory::select('application_name', 'application_version', 'publisher')
         ->selectRaw('COUNT(application_name) as app_count')
         ->groupBy('application_name', 'application_version', 'publisher')
         ->paginate(10);
   return view("AutoDiscovery.viewSoftwareWise", ['data' => $data]);
}

public function getDataSoftwareWise($appname){

   $data = SoftwareInventory::select('device_name', 'device_ip', 'mac_id')
   ->where('application_name', $appname)
   ->get();

return response()->json(['data' => $data]);
}

}
