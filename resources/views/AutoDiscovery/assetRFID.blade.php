@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Asset Movements
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

        .red-container {
            background-color: #fff;
            height: 70px;
            width: 180px;
            display: flex;
            align-items: center;
        }

        .content1 {
            display: flex;
            justify-content: space-between;
            padding: 15px;
        }

        @media screen and (max-width: 1250px) {
            .content1 {
                flex-direction: column;
                align-items: center;
            }
            .red-container{
                background-color: #fff;
            height: 70px;
            width: 100%;
            display: flex;
            align-items: center;
            padding-right: 30px;
            margin-top:10px; 
            }
        }

        .icon-container {
            margin-right: 10px;
            /* Adjust as needed for spacing between icon and text */
        }

        .title {
            font-weight: bold;
        }

        .count {
            font-size: 14px;
            /* Adjust as needed */
        }
    </style>

    {{-- <div id="app">
        <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0"> --}}
                <div id="webui">
                    <!-- First Section with a different background color -->
                    <section class="content1">
                        <!-- Add 5 red containers above the table -->
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="inApprovedData">
                            <div class="icon-container" style="background-color: green;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; " width="50" height="70"
                                    src="/img/up.png" alt="up--v1" />
                            </div>
                            <div class="text-container">
                                <div class="title">APPROVED</div>
                                <div class="title">IN</div>
                                <div class="count">3</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="outApprovedData">
                            <div class="icon-container" style="background-color: green;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; " width="50" height="70"
                                    src="/img/down--v1.png" alt="up--v1" />
                            </div>
                            <div class="text-container">
                                <div class="title">APPROVED</div>
                                <div class="title">OUT</div>
                                <div class="count">1</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="innotApprovedData">
                            <div class="icon-container" style="background-color: red;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; " width="50" height="70"
                                    src="/img/up.png" alt="up--v1" />
                            </div>
                            <div class="text-container">
                                <div class="title">NOT APPROVED</div>
                                <div class="title">IN</div>
                                <div class="count">3</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="outnotApprovedData">
                            <div class="icon-container" style="background-color: red;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; " width="50" height="70"
                                    src="/img/down--v1.png" alt="up--v1" />
                            </div>
                            <div class="text-container">
                                <div class="title">NOT APPROVED</div>
                                <div class="title">OUT</div>
                                <div class="count">4</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="totalApproved">
                            <div class="icon-container" style="background-color: #298fb2;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;"
                                    width="50" height="70" src="/img/filled-plus-2-math.png"
                                    alt="filled-plus-2-math" />
                            </div>
                            <div class="text-container">
                                <div class="title">TOTAL</div>
                                <div class="title">APPROVED</div>
                                <div class="count">4</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                            data-name="totalnotApproved">
                            <div class="icon-container" style="background-color: #298fb2;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;"
                                    width="50" height="70" src="/img/filled-plus-2-math.png"
                                    alt="filled-plus-2-math" />
                            </div>
                            <div class="text-container">
                                <div class="title">TOTAL</div>
                                <div class="title">NOT APPROVED</div>
                                <div class="count">7</div>
                            </div>
                        </div>
                    </section>

                    <!-- Second Section with a different background color -->
                    <section class="content">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs hidden-print">
                                <!-- Tab headers -->
                                <!-- ... -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="checkedout">
                                    <div class="table-responsive">
                                        <table id="exampleTable"  class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Asset Tag</th>
                                                    <th>Asset Name</th>
                                                    <th>Location</th>
                                                    <th>Department</th>
                                                    <th>Date</th>
                                                    <th>RFID Location</th>
                                                    <th>RFID Status</th>
                                                    <th>Process</th>
                                                    <th>History</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Populate the table with actual data -->
                                                <tr>
                                                    <td>E2000018180201130200F7F6</td>
                                                    <td>Semi Fowler Bed-6</td>
                                                    <td>Vashi</td>
                                                    <td>Ward</td>
                                                    <td>2021-06-19 20:47:06.0</td>
                                                    <td>Pune</td>
                                                    <td>Out</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E200001D250F02212000C9FA</td>
                                                    <td>Server And Networks-4</td>
                                                    <td>Vashi</td>
                                                    <td>Server room</td>
                                                    <td>2021-06-22 11:09:37.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E2000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-6</td>
                                                    <td>Vashi</td>
                                                    <td>Ward</td>
                                                    <td>2021-06-23 14:31:49.0</td>
                                                    <td>Thane</td>
                                                    <td>Out</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>HPL/VSH/WRD/PMCUP/8</td>
                                                    <td>GKP REC CHAIR03</td>
                                                    <td>Vashi</td>
                                                    <td>Server room</td>
                                                    <td>2021-06-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>Out</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E3000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-1</td>
                                                    <td>Vashi</td>
                                                    <td>Server room</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E7000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-2</td>
                                                    <td>Maswad</td>
                                                    <td>Server room</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E7000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-5</td>
                                                    <td>Vashi</td>
                                                    <td>Ward</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>Out</td>
                                                    <td>Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E7000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-8</td>
                                                    <td>Pune</td>
                                                    <td>Ward</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E5000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-7</td>
                                                    <td>Vashi</td>
                                                    <td>Server room</td>
                                                    <td>2021-08-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E00018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-01</td>
                                                    <td>Vashi</td>
                                                    <td>Ward</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>In</td>
                                                    <td>Approved</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>E7000018180201160200FTFO</td>
                                                    <td>Patient Med Cupborad-02</td>
                                                    <td>Vashi</td>
                                                    <td>Ward</td>
                                                    <td>2021-09-23 14:31:49.0</td>
                                                    <td>Pune</td>
                                                    <td>Out</td>
                                                    <td>Not Approved</td>
                                                    <td></td>
                                                </tr>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <section class="content" id="main">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs hidden-print" style="background-color: black; color: white; padding-left:10px;">
                        <h3 class="pull-left pagetitle" ></h3>
                    </ul>
                    <div class="tab-content">
                        <!-- Tab panes -->
                        <div class="tab-pane active" id="checkedout">
                            <div class="table-responsive">
                                <table id="exampleTableGetData" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Asset Tag</th>
                                            <th>Asset Name</th>
                                            <th>Location</th>
                                            <th>Department</th>
                                            <th>RFID Location</th>
                                            <th>Movement Time</th>
                                        </tr>
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
    document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the cell click
    var modalCells = document.querySelectorAll('.open-modal');
    modalCells.forEach(function (cell) {
        cell.addEventListener('click', function (event) {
            // Define sample data (replace this with your actual data)
            var inApprovedData = [{
                asset_tag: 'E200001D250F02212000C9FA',
                asset_name: 'Server And Networks-4',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-06-22 11:09:37.0'
            },
            {
                asset_tag: 'E00018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-01',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-02',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            }];
            var outApprovedData = [
                {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-5',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            }
            ];

            var innotApprovedData = [
                {
                asset_tag: 'E3000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-1',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                asset_tag: 'E5000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-7',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-08-23 14:31:49.0'
            },
            {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-2',
                location: 'Maswad',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            }
            ];
            var outnotApprovedData = [{
                    asset_tag: 'E2000018180201130200F7F6',
                    asset_name: 'Semi Fowler Bed-6',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Pune',
                    movement_time: '2021-06-19 20:47:06.0'
                },
                {
                    asset_tag: 'E2000018180201160200FTFO',
                    asset_name: 'Patient Med Cupborad-6',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Thane',
                    movement_time: '2021-06-23 14:31:49.0'
                },
                {
                    asset_tag: 'E7000018180201160200FTFO',
                    asset_name: 'Patient Med Cupborad-02',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Pune',
                    movement_time: '2021-09-23 14:31:49.0'
                },
                {
                    asset_tag: 'HPL/VSH/WRD/PMCUP/8',
                    asset_name: 'GKP REC CHAIR03',
                    location: 'Vashi',
                    deparment: 'Server room',
                    rfidLocation: 'Pune',
                    movement_time: '2021-06-23 14:31:49.0'
                }
            ];

            var totalApproved = [
                {
                asset_tag: 'E200001D250F02212000C9FA',
                asset_name: 'Server And Networks-4',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-06-22 11:09:37.0'
            },
            {
                asset_tag: 'E00018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-01',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-02',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-5',
                location: 'Vashi',
                deparment: 'Ward',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            }
            ];

            var totalnotApproved = [
                {
                asset_tag: 'E3000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-1',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                asset_tag: 'E5000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-7',
                location: 'Vashi',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-08-23 14:31:49.0'
            },
            {
                asset_tag: 'E7000018180201160200FTFO',
                asset_name: 'Patient Med Cupborad-2',
                location: 'Maswad',
                deparment: 'Server room',
                rfidLocation: 'Pune',
                movement_time: '2021-09-23 14:31:49.0'
            },
            {
                    asset_tag: 'E2000018180201130200F7F6',
                    asset_name: 'Semi Fowler Bed-6',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Pune',
                    movement_time: '2021-06-19 20:47:06.0'
                },
                {
                    asset_tag: 'E2000018180201160200FTFO',
                    asset_name: 'Patient Med Cupborad-6',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Thane',
                    movement_time: '2021-06-23 14:31:49.0'
                },
                {
                    asset_tag: 'E7000018180201160200FTFO',
                    asset_name: 'Patient Med Cupborad-02',
                    location: 'Vashi',
                    deparment: 'Ward',
                    rfidLocation: 'Pune',
                    movement_time: '2021-09-23 14:31:49.0'
                },
                {
                    asset_tag: 'HPL/VSH/WRD/PMCUP/8',
                    asset_name: 'GKP REC CHAIR03',
                    location: 'Vashi',
                    deparment: 'Server room',
                    rfidLocation: 'Pune',
                    movement_time: '2021-06-23 14:31:49.0'
                }
            ];

            // Populate the second table with sampleData
            var tableBody = document.querySelector('#exampleTableGetData tbody');
            var headersElement = document.querySelector('h3.pull-left.pagetitle');
            headersElement.innerHTML = '';
            $('#exampleTableGetData').DataTable().destroy();
            var headerElement = document.createElement('h3');
            headerElement.classList.add('pagetitle');
            tableBody.innerHTML = '';

            var typeName = event.currentTarget.getAttribute('data-name');
            console.log(typeName);
            var sampleData = null;
            if (typeName === "inApprovedData") {
                sampleData = inApprovedData;
                headerText = "IN APPROVED";
            } else if (typeName === "outApprovedData") {
                sampleData = outApprovedData;
                headerText = "OUT APPROVED";
            } else if (typeName === "innotApprovedData") {
                sampleData = innotApprovedData;
                headerText = "IN NON APPROVED";
            } else if (typeName === "outnotApprovedData") {
                sampleData = outnotApprovedData;
                headerText = "OUT NON APPROVED";
            } else if (typeName === "totalApproved") {
                sampleData = totalApproved;
                headerText = "TOTAL APPROVED";
            } else if (typeName === "totalnotApproved") {
                sampleData = totalnotApproved;
                headerText = "TOTAL NOT APPROVED";
            }

            headerElement.textContent = headerText;
            
            headersElement.appendChild(headerElement);
            if (sampleData) {
                sampleData.forEach(item => {
                    var row = '<tr>' +
                        '<td>' + item.asset_tag + '</td>' +
                        '<td>' + item.asset_name + '</td>' +
                        '<td>' + item.location + '</td>' +
                        '<td>' + item.deparment + '</td>' +
                        '<td>' + item.rfidLocation + '</td>' +
                        '<td>' + item.movement_time + '</td>' +
                        '</tr>';
                    tableBody.innerHTML += row;
                });
                $('#exampleTableGetData').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'csv', 'excel', 'pdf', 'print'
                            ],
                            lengthMenu: [10, 25, 50, 100, 500, 1000, 2000],
                            pageLength: 10
                        });
            } else {
                console.error("Invalid typeName:", typeName);
            }
        });
    });
});

 </script>
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
    {{-- <script>
        $(document).ready(function() {
            $('#exampleTableGetData').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10
            });
        });
    </script> --}}

 
@endsection
