@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Asset Audit Reconcilation
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

    <div id="app">
        <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0">
                <div id="webui">
                    <!-- First Section with a different background color -->
                    <section class="content1">
                        <!-- Add 5 red containers above the table -->
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="total">
                            <div class="icon-container" style="background-color: Blue;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; " width="50" height="70" src="/img/up.png" alt="long-arrow-up" />
                            </div>
                            <div class="text-container">
                                <div class="title">TOTAL</div>
                                <div class="count">11</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="found">
                            <div class="icon-container" style="background-color: green;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;" width="50" height="70" src="/img/visible.png" alt="visible"/>
                            </div>
                            <div class="text-container">
                                <div class="title">FOUND</div>
                                <div class="count">11</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="missing">
                            <div class="icon-container" style="background-color: red;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;" width="50" height="70" src="/img/error.png" alt="error"/>
                            </div>
                            <div class="text-container">
                                <div class="title">MISSING</div>
                                <div class="count">0</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="pending">
                            <div class="icon-container" style="background-color: orange;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;" width="50" height="70" src="/img/appointment-reminders--v1.png" alt="appointment-reminders--v1"/>
                            </div>
                            <div class="text-container">
                                <div class="title">PENDING</div>
                                <div class="count">0</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="newdata">
                            <div class="icon-container" style="background-color: #d29999;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;" width="50" height="70" src="/img/filled-plus-2-math.png" alt="filled-plus-2-math"/>
                            </div>
                            <div class="text-container">
                                <div class="title">NEW</div>
                                <div class="count">0</div>
                            </div>
                        </div>
                        <div class="red-container open-modal" data-toggle="modal" data-target="#exampleModal"
                        data-name="deviation">
                            <div class="icon-container" style="background-color: #8bbccd;">
                                <!-- Add your icon here -->
                                {{-- <img src="https://icons8.com/icon/39778/up-arrow" alt="Icon" width="40" height="70"> --}}
                                <img style="padding-bottom: 16px;  padding-top: 16px; padding-left: 6px; padding-right: 6px;" width="50" height="70" src="/img/deviation.png" alt="deviation"/>
                            </div>
                            <div class="text-container">
                                <div class="title">DEVIATION</div>
                                <div class="count">0</div>
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
                                                    <th>Location</th>
                                                    <th>Sub Location</th>
                                                    <th>Total Assets</th>
                                                    <th>Found Total</th>
                                                    <th>Missing Assets</th>
                                                    <th>Pending</th>
                                                    <th>New Asset</th>
                                                    <th>Asset Deviation</th>
                                                    <th>Barcode Mismatched</th>
                                                    <th>Unable to scan QR</th>
                                                    <th>Asset Damage</th>
                                                    <th>Data Inconsistency</th>
                                                    <th>Other</th>
                                                    <th>Record Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Conference Room</td>
                                                    <td>23</td>
                                                    <td>23</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Reception</td>
                                                    <td>14</td>
                                                    <td>14</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Store</td>
                                                    <td>10</td>
                                                    <td>10</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>1</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Floor</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Counselling Room</td>
                                                    <td>13</td>
                                                    <td>13</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>GhatKopar</td>
                                                    <td>Cash Counter</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>Pune</td>
                                                    <td>Room Key</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>Pune</td>
                                                    <td>Cash Counter</td>
                                                    <td>23</td>
                                                    <td>23</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>Mumbai</td>
                                                    <td>Conference Room</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>Mumbai</td>
                                                    <td>Counselling Room</td>
                                                    <td>5</td>
                                                    <td>5</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>
                                                <tr>
                                                    <td>Pune</td>
                                                    <td>Conference Room</td>
                                                    <td>23</td>
                                                    <td>23</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>2021-05-11 19:02:27</td>
                                                </tr>

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
                    <ul class="nav nav-tabs hidden-print"  style="background-color: black; color: white; padding-left:10px;">
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
                                            <th>Location</th>
                                            <th>Sub Location</th>
                                            <th>Sync Status</th>
                                            <th>Sync Timestamp</th>
                                            <th>Description</th>
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


@stop
@section('moar_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the cell click
    var modalCells = document.querySelectorAll('.open-modal');
    modalCells.forEach(function (cell) {
        cell.addEventListener('click', function (event) {
            // Define sample data (replace this with your actual data)
            var total = [{
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            }
        ];
            var found = [
                {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Mumbai',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            },
            {
                asset_tag: 'E200001D250F02212000C9FA',
                location: 'Pune',
                sublocation: 'Vashi',
                syncStatus: 'Server room',
                syncTimestamp: '2021-05-11 19:02:27'
            }
            ];

            var missing = [];
            var pending = [
            ];

            var newdata = [];

            var deviation = [
            ];

            // Populate the second table with sampleData
            var tableBody = document.querySelector('#exampleTableGetData tbody');
            var headersElement = document.querySelector('h3.pull-left.pagetitle');
            tableBody.innerHTML = '';
            headersElement.innerHTML = '';
            var headerElement = document.createElement('h3');
            headerElement.classList.add('pagetitle');
            var typeName = event.currentTarget.getAttribute('data-name');
            console.log(typeName);
            var sampleData = null;
            if (typeName === "total") {
                sampleData = total;
                headerText = "Total";
            } else if (typeName === "found") {
                sampleData = found;
                headerText = "Found";
            } else if (typeName === "missing") {
                sampleData = missing;
                headerText = "Missing";
            } else if (typeName === "pending") {
                sampleData = pending;
                headerText = "Pending";
            } else if (typeName === "newdata") {
                sampleData = newdata;
                headerText = "New";
            } else if (typeName === "deviation") {
                sampleData = deviation;
                headerText = "Deviation";
            }

            headerElement.textContent = headerText;
            
            headersElement.appendChild(headerElement);
            if (sampleData) {
                sampleData.forEach(item => {
                    var row = '<tr>' +
                        '<td>' + item.asset_tag + '</td>' +
                        '<td>' + item.location + '</td>' +
                        '<td>' + item.sublocation + '</td>' +
                        '<td>' + item.syncStatus + '</td>' +
                        '<td>' + item.syncTimestamp + '</td>' +
                        '</tr>';
                    tableBody.innerHTML += row;
                });
            } else {
                console.error("Invalid typeName:", typeName);
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
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
   <script>
    $(document).ready(function() {
        $('#exampleTableGetData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endsection
