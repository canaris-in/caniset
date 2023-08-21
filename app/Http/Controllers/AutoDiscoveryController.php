<?php

namespace App\Http\Controllers;

use App\Models\ApiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\FetchApiData;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\CustomField;

class AutoDiscoveryController extends Controller
{
    public function index()
    {
        return view('feature.autodiscovery', ['data' => '']);
    }

    public function fileName($filename)
    {
        $filePath = 'C:/Users/Lucifer/Desktop/file/network_data/'.$filename;
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);
            return response()->json([
                'status' => 200,
                'filename' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'filename' => 'File not Found',
            ]);
        }
    }
    public function mapping(Request $request)
    {
        $submittedData = json_decode($request->input('data'), true);
        $dataField = CustomField::all('name');
        $fieldKey = array_keys($submittedData[0]);
        $fieldValues = array_values($submittedData[0]);
        $data = [$fieldKey, $fieldValues, $dataField];
        return view('feature.mapping', ['data' => $data, 'submited_data' => $submittedData]);
    }

    public function storeData(Request $req)
    {
        $submittedData = $req->input('submited_data');
        $input_field = $req->input('field_key_value');
        $custome_field = $req->input('custome_field');
        $mapping = array_combine($custome_field, $input_field);

        foreach ($submittedData as $item) {
            $dataSave = new Asset();
            $dataSave->model_id = '1';
            $dataSave->status_id = '1';
            $dataSave->asset_tag = $req->get('asset_tag', Asset::autoincrement_asset());

            // foreach ($custome_field as $custome) {
            //     $custome_field_db_name = CustomField::where('name', $custome)->first();
            //     $custome_field_data = $custome_field_db_name->db_column;
            // }
            // var_dump($custome_field);

            // foreach ($input_field as $input) {
            //     $input_filed_data = $item[$input];
            // }
            // var_dump($input_filed_data);
            // $dataSave->$custome_field_data = $input_filed_data;

            // $dataSave->save();

                $custome_ips = CustomField::where('name', $custome_field[0])->first();
                $custome_ip = $custome_ips->db_column;

                $custome_macs = CustomField::where('name', $custome_field[1])->first();
                $custome_mac = $custome_macs->db_column;

                $custome_hostnames = CustomField::where('name', $custome_field[2])->first();
                $custome_hostname = $custome_hostnames->db_column;

                $custome_models = CustomField::where('name', $custome_field[3])->first();
                $custome_model = $custome_models->db_column;

                $custome_model_numbers = CustomField::where('name', $custome_field[4])->first();
                $custome_model_number = $custome_model_numbers->db_column;

                $custome_serial_numbers = CustomField::where('name', $custome_field[5])->first();
                $custome_serial_number = $custome_serial_numbers->db_column;

                $custome_ram_infos = CustomField::where('name', $custome_field[6])->first();
                $custome_ram_info = $custome_ram_infos->db_column;

                $custome_cpu_infos = CustomField::where('name', $custome_field[7])->first();
                $custome_cpu_info = $custome_cpu_infos->db_column;

                $custome_disk_infos = CustomField::where('name', $custome_field[8])->first();
                $custome_disk_info = $custome_disk_infos->db_column;

                $custome_os_details = CustomField::where('name', $custome_field[9])->first();
                $custome_os_detail = $custome_os_details->db_column;

                $input_ip = $item[$input_field[0]];
                $input_mac = $item[$input_field[1]];
                $input_hostname = $item[$input_field[2]];
                $input_model = $item[$input_field[3]];
                $input_model_number = $item[$input_field[4]];
                $input_serial_number = $item[$input_field[5]];
                $input_ram_info = $item[$input_field[6]];
                $input_cpu_info = $item[$input_field[7]];
                $input_disk_info = $item[$input_field[8]];
                $input_os_details = $item[$input_field[9]];

            //save in database
                $dataSave->$custome_ip = $input_ip;
                $dataSave->$custome_mac = $input_mac;
                $dataSave->$custome_hostname = $input_hostname;
                $dataSave->$custome_model = $input_model;
                $dataSave->$custome_model_number = $input_model_number;
                $dataSave->$custome_serial_number = $input_serial_number;
                $dataSave->$custome_ram_info = $input_ram_info;
                $dataSave->$custome_cpu_info = $input_cpu_info;
                $dataSave->$custome_disk_info = $input_disk_info;
                $dataSave->$custome_os_detail = $input_os_details;
                $dataSave->save();
            }
        return redirect('/autodiscovery')->with('success', 'Successfully imported devices');
    }
}
