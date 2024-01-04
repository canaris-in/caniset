@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Agent Installed Device
    @parent
@stop

{{-- Page content --}}
@section('content')
    {{-- Hide importer until vue has rendered it, if we continue using vue for other things we should move this higher in the style --}}
    <style>
        [v-cloak] {
            display: none;
        }

        .table-container {
            max-height: 500px;
            /* Adjust the height as needed */
            overflow-y: auto;
        }

        *,
        *:after,
        *:before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            box-sizing: border-box;
        }

        .content {
            margin-left: auto;
            margin-right: auto;
            min-height: 150px;
            padding: 15px;
        }
    </style>
    {{-- <div id="app"> --}}
        {{-- <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0"> --}}
                <div id="webui">
                    <section class="content" id="main">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs hidden-print">
                                <!-- Tab headers -->
                                <!-- ... -->
                            </ul>
                            <div class="tab-content">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <div class="default-tab">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#home">HW
                                                        Inventory</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#profile">HW
                                                        Configuration</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#contact">Software
                                                        Inventory</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#message">Software Licence
                                                        Inventory</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                                    <div class="pt-4">
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Hardware Inventory</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable1" class="display nowrap"
                                                                                style="width:100%">
                                                                                @php
$counter = 1;
@endphp

                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No</th>
                                                                                        <th>Processor Name</th>
                                                                                        <th>Processor Manufacturer</th>
                                                                                        <th>No. Of Cores</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($hwInventory as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $counter++ }}</td>
                                                                                            <td>{{ $swItem->processor_name }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->manufacturer }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->processor_count }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Install Memory Modules
                                                                    </h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable11" class="display nowrap"
                                                                                style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No</th>
                                                                                        <th>Socket</th>
                                                                                        <th>Capacity</th>
                                                                                        <th>Module Tag</th>
                                                                                        <th>Bank Label</th>
                                                                                        <th>Serial Number</th>
                                                                                        <th>Frequency</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($memoryInventory as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $swItem->id }}</td>
                                                                                            <td>{{ $swItem->socket }}</td>
                                                                                            <td>{{ $swItem->capacity }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->module_tag }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->bank_label }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->serial_number }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->frequency }}
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Hard Disk</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable12" class="display nowrap"
                                                                                style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No</th>
                                                                                        <th>Name</th>
                                                                                        <th>Serial Number</th>
                                                                                        <th>Model</th>
                                                                                        <th>Media Type</th>
                                                                                        <th>Interface Type</th>
                                                                                        <th>Manufacturer</th>
                                                                                        <th>Capacity</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($diskInventory as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $swItem->id }}</td>
                                                                                            <td>{{ $swItem->name }}</td>
                                                                                            <td>{{ $swItem->serial_number }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->model }}</td>
                                                                                            <td>{{ $swItem->media_type }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->interface_type }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->manufacturer }}
                                                                                            <td>{{ $swItem->capacity }}
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Logical Drives</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable13" class="display nowrap"
                                                                                style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No</th>
                                                                                        <th>Drive</th>
                                                                                        <th>Drive Type</th>
                                                                                        <th>File Type</th>
                                                                                        <th>Serial Number</th>
                                                                                        <th>Capacity</th>
                                                                                        <th>Free Space</th>
                                                                                        <th>Drive Usage</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($driveInventory as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $swItem->id }}</td>
                                                                                            <td>{{ $swItem->drive }}</td>
                                                                                            <td>{{ $swItem->drive_type }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->file_type }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->serial_number }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->capacity }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->free_space }}
                                                                                            <td>{{ $swItem->drive_usage }}
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Printers</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable14" class="display nowrap"
                                                                                style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No</th>
                                                                                        <th>Name</th>
                                                                                        <th>Server</th>
                                                                                        <th>Model</th>
                                                                                        <th>Type</th>
                                                                                        <th>Driver Name</th>
                                                                                        <th>Location</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($hwPrinter as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $swItem->sr_no }}</td>
                                                                                            <td>{{ $swItem->name }}</td>
                                                                                            <td>{{ $swItem->server }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->model }}</td>
                                                                                            <td>{{ $swItem->type }}</td>
                                                                                            <td>{{ $swItem->driver_name }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->location }}
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile">
                                                    <div class="pt-4">
                                                        <section class="content" id="main">
                                                               <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">HW Configuration</h3>
                                                                </ul>
                                                            {{-- <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">HW Configuration</h3>
                                                                </ul> --}}
                                                                {{-- <div class="tab-content">
                                                                    <!-- Tab panes --> --}}
                                                                   
                                                                    <form style="margin-top: 10px">
                                                                        @foreach ($hardwareData as $item)
                                                                        <div class="form-row" style="display: flex;">
                                                                          <div class="form-group col-md-6">
                                                                            <label for="firstName">IP Address</label>
                                                                            <input type="text" value="{{$item->ip_address}}"  class="form-control" readonly>
                                                                          </div>
                                                                          <div class="form-group col-md-6">
                                                                            <label for="lastName">Mac Address</label>    
                                                                            <input type="text" value="{{$item->mac_address}}" class="form-control" id="lastName" readonly>
                                                                          </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">Manufacture</label>
                                                                              <input type="text" value="{{$item->manufacturer}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Processor Count</label>    
                                                                              <input type="text" value="{{$item->processor_count}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">OS Type</label>
                                                                              <input type="text" value="{{$item->os_type}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Disk Space</label>    
                                                                              <input type="text" value="{{$item->disk_space}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">Processor Name</label>
                                                                              <input type="text" value="{{$item->processor_name}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Service Pack</label>    
                                                                              <input type="text" value="{{$item->service_pack}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">Domain</label>
                                                                              <input type="text" value="{{$item->domain}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Original Serial Number</label>    
                                                                              <input type="text" value="{{$item->original_serial_no}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">Total Memory</label>
                                                                              <input type="text" value="{{$item->total_memory}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Processor Manufacture</label>    
                                                                              <input type="text" value="{{$item->processor_manufacturer}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">BIOS Name</label>
                                                                              <input type="text" value="{{$item->bios_name}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">BIOS Manufacture</label>    
                                                                              <input type="text" value="{{$item->bios_manufacturer}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">BIOS Release Date</label>
                                                                              <input type="text" value="{{$item->bios_release_date}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">BIOS Version</label>    
                                                                              <input type="text" value="{{$item->bios_version}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">Build Number</label>
                                                                              <input type="text" value="{{$item->build_number}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">Host Name</label>    
                                                                              <input type="text" value="{{$item->host_name}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row" style="display: flex;">
                                                                            <div class="form-group col-md-6">
                                                                              <label for="firstName">OS Name</label>
                                                                              <input type="text" value="{{$item->os_name}}" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                              <label for="lastName">OS Version</label>    
                                                                              <input type="text" value="{{$item->os_version}}" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </form>
                                                                    
                                                                {{-- </div> --}}
                                                            {{-- </div> --}}
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="contact">
                                                    <div class="pt-4">
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Software Inventory</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable3"
                                                                                class="display nowrap" style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Asset ID</th>
                                                                                        <th>Device Name</th>
                                                                                        <th>Device IP</th>
                                                                                        <th>MAC ID</th>
                                                                                        <th>Application Name</th>
                                                                                        <th>Application Version</th>
                                                                                        <th>Is License</th>
                                                                                        <th>License Key</th>
                                                                                        <th>Product ID</th>
                                                                                        <th>Publisher</th>
                                                                                        <th>Uninstall String</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($swData as $swItem)
                                                                                        <tr>
                                                                                            <td>{{ $swItem->id }}</td>
                                                                                            <td>{{ $swItem->asset_id }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->device_name }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->device_ip }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->mac_id }}</td>
                                                                                            <td>{{ $swItem->application_name }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->application_version }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->is_license }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->license_key }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->product_id }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->publisher }}
                                                                                            </td>
                                                                                            <td>{{ $swItem->uninstall_str }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="message">
                                                    <div class="pt-4">
                                                        <section class="content" id="main">
                                                            <div class="nav-tabs-custom">
                                                                <ul class="nav nav-tabs hidden-print"
                                                                    style="background-color: black; color: white; padding-left:10px;">
                                                                    <h3 class="pull-left pagetitle">Software License
                                                                        Inventory</h3>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <!-- Tab panes -->
                                                                    <div class="tab-pane active" id="checkedout">
                                                                        <div class="table-responsive">
                                                                            {{-- <div class="row">
                                                                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                                                                <div class="fixed-table-container"> --}}
                                                                            <table id="exampleTable4"
                                                                                class="display nowrap" style="width:100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Asset ID</th>
                                                                                        <th>Device Name</th>
                                                                                        <th>Device IP</th>
                                                                                        <th>MAC ID</th>
                                                                                        <th>Data Type</th>
                                                                                        <th>Product Name</th>
                                                                                        <th>Product Type</th>
                                                                                        <th>Value</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($swlData as $swlItem)
                                                                                        <tr>
                                                                                            <td>{{ $swlItem->id }}</td>
                                                                                            <td>{{ $swlItem->asset_id }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->device_name }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->device_ip }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->mac_id }}</td>
                                                                                            <td>{{ $swlItem->data_type }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->product_name }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->product_type }}
                                                                                            </td>
                                                                                            <td>{{ $swlItem->value }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- Add pagination links -->
                                                                        {{-- <div class="d-flex justify-content-center">
                                                                            {{ $data->links() }}
                                                                        </div> --}}
                                                                        {{-- </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            {{-- </div>
        </div> --}}
    {{-- </div> --}}
@endsection
@section('moar_scripts')
    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/jquery/select2.min.js"></script>
    <script src="/js/jquery/jquery.dataTables.min.js"></script>
    <script src="/js/jquery/dataTables.buttons.min.js"></script>
    <script src="/js/jquery/jszip.min.js"></script>
    <script src="/js/jquery/pdfmake.min.js"></script>
    <script src="/js/jquery/vfs_fonts.js"></script>
    <script src="/js/jquery/buttons.html5.min.js"></script>
    <script src="/js/jquery/buttons.print.min.js"></script>
    <script src="/js/jquery/sweetalert2@11.js"></script>
    <script>
        $(document).ready(function() {
            $('#exampleTable1,#exampleTable11,#exampleTable12,#exampleTable13,#exampleTable14').DataTable({
                dom: 'tip',

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleTable2').DataTable({
                dom: 'tip',

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#exampleTable3').DataTable({
                dom: 'Blftip',
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleTable4').DataTable({
                dom: 'Blftip',
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10

            });
        });
    </script>
@endsection
