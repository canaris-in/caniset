@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Software License Management
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
                                        <table id="exampleTable" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Asset Taf</th>
                                                    <th>Manufacturer</th>
                                                    <th>Software</th>
                                                    <th>Total Volume</th>
                                                    <th>Used Volume</th>
                                                    <th>Available Volume</th>
                                                    <th>Unlicenced Devices</th>
                                                    <th>Total Install Apps</th>
                                                    <th>License Type</th>
                                                    <th>License Option</th>
                                                    <th>Acquisition Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Sub Location</th>
                                                    <th>Location</th>
                                                    <th>Vendor</th>
                                                    <th>Purchase Cost</th>
                                                    <th>Purchase Date</th>
                                                    <th>Invoice No</th>
                                                    <th>Invoice Date</th>
                                                    <th>AMC Expiry Date</th>
                                                    <th>AMC Effective Date</th>
                                                    <th>Insurace Effective Date</th>
                                                    <th>Insurance Expiry Date</th>
                                                    <th>Warranty Expiry Date</th>
                                                    <th>Warranty Effective Date</th>
                                                    <th>Age of Assets</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $software)
                                                    <tr>
                                                        <td>{{ $software['AssetTag'] }}</td>
                                                        <td>{{ $software['Manufacturer'] }}</td>
                                                        <td>{{ $software['Software'] }}</td>
                                                        <td class="open-modal" data-toggle="modal"
                                                            data-target="#exampleModal" data-name="total_volume"
                                                            data-no="{{ $software['TotalVolume'] }}">
                                                            {{ $software['TotalVolume'] }}</td>
                                                        <td class="open-modal" data-toggle="modal"
                                                            data-target="#exampleModal" data-name="used_volume"
                                                            data-no="{{ $software['UsedVolume'] }}">
                                                            {{ $software['UsedVolume'] }}</td>
                                                        <td class="open-modal" data-toggle="modal"
                                                            data-target="#exampleModal" data-name="available_volume"
                                                            data-no="{{ $software['AvailableVolume'] }}">
                                                            {{ $software['AvailableVolume'] }}</td>
                                                        <td>{{ $software['UnlicensedDevices'] }}</td>
                                                        <td class="open-modal" data-toggle="modal"
                                                            data-target="#exampleModal" data-name="total_install_app"
                                                            data-no="{{ $software['TotalInstallApps'] }}">
                                                            {{ $software['TotalInstallApps'] }}</td>
                                                        <td>{{ $software['LicenseType'] }}</td>
                                                        <td>{{ $software['LicenseOption'] }}</td>
                                                        <td>{{ $software['AcquisitionDate'] }}</td>
                                                        <td>{{ $software['ExpiryDate'] }}</td>
                                                        <td>{{ $software['SubLocation'] }}</td>
                                                        <td>{{ $software['Location'] }}</td>
                                                        <td>{{ $software['Vendor'] }}</td>
                                                        <td>{{ $software['PurchaseCost'] }}</td>
                                                        <td>{{ $software['PurchaseDate'] }}</td>
                                                        <td>{{ $software['InvoiceNo'] }}</td>
                                                        <td>{{ $software['InvoiceDate'] }}</td>
                                                        <td>{{ $software['AMCExpiryDate'] }}</td>
                                                        <td>{{ $software['AMCEffectiveDate'] }}</td>
                                                        <td>{{ $software['InsuranceEffectiveDate'] }}</td>
                                                        <td>{{ $software['InsuranceExpiryDate'] }}</td>
                                                        <td>{{ $software['WarrantyExpiryDate'] }}</td>
                                                        <td>{{ $software['WarrantyEffectiveDate'] }}</td>
                                                        <td>{{ $software['AgeOfAssets'] }}</td>
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <section class="content" id="main">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs hidden-print" style="background-color: black; color: white; padding-left:10px;">
                        <h3 class="pull-left pagetitle"></h3>
                    </ul>
                    <div class="tab-content">
                        <!-- Tab panes -->
                        <div class="tab-pane active" id="checkedout">
                            <div class="table-responsive">
                                <table id="exampleTableGetData" class="display nowrap" style="width:100%">
                                    <thead>

                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('moar_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for the cell click
            var modalCells = document.querySelectorAll('.open-modal');
            modalCells.forEach(function(cell) {
                cell.addEventListener('click', function() {
                    // var deviceIp = this.getAttribute('data-device-ip');

                    var modal_name = this.getAttribute('data-name');
                    var modal_no = parseInt(this.getAttribute('data-no'), 10);

                    var headersElement = document.querySelector('h3.pull-left.pagetitle');
                    headersElement.innerHTML = '';
                    var headerElement = document.createElement('h3');
                    headerElement.classList.add('pagetitle');
                    var tableBody = document.querySelector('#exampleTableGetData tbody');
                    var tablehead = document.querySelector('#exampleTableGetData thead');
                    tableBody.innerHTML = '';
                    tablehead.innerHTML = '';

                    var total_available = '<tr>' +
                        '<th>' + "License Key" + '</th>' +
                        '</tr>';

                    var install_used = '<tr>' +
                        '<th>' + "IP Address" + '</th>' +
                        '<th>' + "Host Name" + '</th>' +
                        '<th>' + "License Key" + '</th>' +
                        '</tr>';

                    var total_volume = [{
                            key: 'E3000018180201160200FTFO',
                        },
                        {
                            key: 'B3000018180201160200FTFO',
                        },
                        {
                            key: 'KYC00018180201160200FTFO',
                        },
                        {
                            key: 'B3000018180201160200FTFO',
                        },
                        {
                            key: 'KYC00018180201160200FTFO',
                        }
                    ];


                    var used_volume = [{
                            ip_address: '192.168.1.5',
                            host_name: 'DELL',
                            key: 'E3000018180201160200FTFO',
                        },
                        {
                            ip_address: '192.168.1.6',
                            host_name: 'HP',
                            key: 'E3000018180201160200FTFO',
                        },
                        {
                            ip_address: '192.168.1.7',
                            host_name: 'Lenovo',
                            key: 'E3000018180201160200FTFO',
                        },
                        {
                            ip_address: '192.168.1.6',
                            host_name: 'HP',
                            key: 'E3000018180201160200FTFO',
                        },
                        {
                            ip_address: '192.168.1.7',
                            host_name: 'Lenovo',
                            key: 'E3000018180201160200FTFO',
                        }
                    ]


                    if (modal_name === "total_volume") {
                        headerText = "Total Volume";
                        tablehead.innerHTML = total_available;
                        total_volume.forEach(item => {
                           if(modal_no!=0){
                            var row = '<tr>' +
                                '<td>' + item.key + '</td>' +
                                '</tr>';
                            tableBody.innerHTML += row;
                            modal_no--;
                           }
                        });
                    } else if (modal_name === "used_volume") {
                        headerText = "Used Volume";
                        tablehead.innerHTML = install_used;

                        used_volume.forEach(item => {
                           
                            if(modal_no!=0){
                                var row = '<tr>' +
                                '<td>' + item.ip_address + '</td>' +
                                '<td>' + item.host_name + '</td>' +
                                '<td>' + item.key + '</td>' +
                                '</tr>';
                            tableBody.innerHTML += row;
                            modal_no--;
                            }
                            
                        });
                    } else if (modal_name === "available_volume") {
                        headerText = "Available Volume";
                        tablehead.innerHTML = total_available;
                        total_volume.forEach(item => {
                            if(modal_no!=0){
                                var row = '<tr>' +
                                '<td>' + item.key + '</td>' +
                                '</tr>';
                            tableBody.innerHTML += row;
                            modal_no--;
                            }
                        });
                    } else if (modal_name === "total_install_app") {
                        tablehead.innerHTML = install_used;
                        headerText = "Total Install Apps";
                        used_volume.forEach(item => {
                           if(modal_no!=0){
                            var row = '<tr>' +
                                '<td>' + item.ip_address + '</td>' +
                                '<td>' + item.ip_address + '</td>' +
                                '<td>' + item.key + '</td>' +
                                '</tr>';
                            tableBody.innerHTML += row;
                            modal_no--;
                           }
                        });
                    }
                    headerElement.textContent = headerText;
                    headersElement.appendChild(headerElement);
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
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                lengthMenu: [
                    [10, 20, 30]
                ],
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleTableGetData').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
