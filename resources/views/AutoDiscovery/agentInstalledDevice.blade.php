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
    </style>

    {{-- <div id="app">
        <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0"> --}}
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
                                        <table id="exampleTable" class="display nowrap" style="width:100%">
                                            @php
$counter = 1;
@endphp
                                            <thead>
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <th>IP Address</th>
                                                    <th>Host Name</th>
                                                    <th>Branch Name</th>
                                                    <th>Agent Start Time</th>
                                                    <th>Device Status</th>
                                                    <th>Version</th>
                                                    <th>MAC Address</th>
                                                    <th>Device IP</th>
                                                    <th>Device MAC List</th>
                                                    <th>SW Last Discover</th>
                                                    <th>Serial Number</th>
                                                    <th>SW Count</th>
                                                    <th>SW Scan Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $device)
                                                    <tr>
                                                        <td>{{ $device->id }}</td>
                                                        <td >{{ $device->IP_ADDRESS }}</td>
                                                        <td>{{ $device->HOST_NAME }}</td>
                                                        <td>{{ $device->BRANCH_NAME }}</td>
                                                        <td>{{ $device->AGENT_START_TIME }}</td>
                                                        <td>{{ $device->DEVICE_STATUS }}</td>
                                                        <td>{{ $device->VERSION }}</td>
                                                        <td>{{ $device->MAC_ADDRESS }}</td>
                                                        <td style="color: red" class="ip-address">{{ $device->DEVICE_IP }}</td>
                                                        <td>{{ $device->DEVICE_MAC_LIST }}</td>
                                                        <td>{{ $device->SW_LAST_DISCOVER }}</td>
                                                        <td>{{ $device->SERIALNUMBER }}</td>
                                                        <td>{{ $device->SW_COUNT }}</td>
                                                        <td>{{ $device->SW_SCAN_TYPE }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            {{-- </div>
        </div>
    </div> --}}
@endsection
@section('moar_scripts')
    <script>
        $(document).ready(function() {
            // Iterate through each table row
            $('.ip-address').click(function() {
                // Extract IP address from the row
                var ipAddress = $(this).text();

                // Make an Ajax request to fetch additional data
                $.ajax({
                    url: '/agentInstallDevice', // Replace with your actual endpoint
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        ip_address: ipAddress
                    },
                    success: function(response) {
                        
                        // console.log(response.ip_address);
                        var redirectUrl = '/getHWInventory/' + response.ip_address;
                        window.location.href = redirectUrl;                       
                    }.bind(this), // bind(this) is used to maintain the context of the current <td>
                    error: function(xhr, status, error) {
                        console.error('Ajax request failed:', error);
                    }
                });
            });
        });
    </script>
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
            $('#exampleTable').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10
            });
        });
    </script>

@endsection
