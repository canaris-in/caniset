@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Processor Configuration
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
    </style>

    <div id="app">
        <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0">
                <div id="webui">
                    <section class="content" id="main">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs hidden-print">
                                <!-- Tab headers -->
                                <!-- ... -->
                            </ul>
                            <div class="tab-content">
                                <!-- Tab panes -->
                                <div class="tab-pane active" id="checkedout">
                                    <div class="table-responsive">
                                        {{-- <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                            <div class="fixed-table-container"> --}}
                                        <table id="exampleTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Asset ID</th>
                                                    <th>Bios Manufacturer</th>
                                                    <th>Bios Name</th>
                                                    <th>Bios Release Date</th>
                                                    <th>Bios Version</th>
                                                    <th>Build Number</th>
                                                    <th>Disk Space</th>
                                                    <th>Domain</th>
                                                    <th>Host Name</th>
                                                    <th>IP Address</th>
                                                    <th>MAC Address</th>
                                                    <th>Manufacturer</th>
                                                    <th>Original Serial No</th>
                                                    <th>OS Name</th>
                                                    <th>OS Type</th>
                                                    <th>OS Version</th>
                                                    <th>Processor Count</th>
                                                    <th>Processor Manufacturer</th>
                                                    <th>Processor Name</th>
                                                    <th>Product ID</th>
                                                    <th>Service Pack</th>
                                                    <th>System Model</th>
                                                    <th>Total Memory</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->asset_id }}</td>
                                                        <td>{{ $item->bios_manufacturer }}</td>
                                                        <td>{{ $item->bios_name }}</td>
                                                        <td>{{ $item->bios_release_date }}</td>
                                                        <td>{{ $item->bios_version }}</td>
                                                        <td>{{ $item->build_number }}</td>
                                                        <td>{{ $item->disk_space }}</td>
                                                        <td>{{ $item->domain }}</td>
                                                        <td>{{ $item->host_name }}</td>
                                                        <td>{{ $item->ip_address }}</td>
                                                        <td>{{ $item->mac_address }}</td>
                                                        <td>{{ $item->manufacturer }}</td>
                                                        <td>{{ $item->original_serial_no }}</td>
                                                        <td>{{ $item->os_name }}</td>
                                                        <td>{{ $item->os_type }}</td>
                                                        <td>{{ $item->os_version }}</td>
                                                        <td>{{ $item->processor_count }}</td>
                                                        <td>{{ $item->processor_manufacturer }}</td>
                                                        <td>{{ $item->processor_name }}</td>
                                                        <td>{{ $item->product_id }}</td>
                                                        <td>{{ $item->service_pack }}</td>
                                                        <td>{{ $item->system_model }}</td>
                                                        <td>{{ $item->total_memory }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Add pagination links -->
                                    <div class="d-flex justify-content-center">
                                        {{ $data->links() }}
                                    </div>
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
@endsection
@section('moar_scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
