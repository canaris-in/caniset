@extends('layouts/default')
{{-- Page title --}}
@section('title')
    Auto Discovery
    @parent
@stop
{{-- Page content --}}
@section('content')
    {{-- Hide importer until vue has rendered it, if we continue using vue for other things we should move this higher in the style --}}
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <div id="app">
        <div class="autodiscoverbutton">
            <p class="form-help">
                <button id="loadButton" type="button" class="btn btn-default"
                    id="eup-show-preview">{{ __('Scan') }}</button>
            </p>
            <p class="form-help">
            <form id="data-form" action="/mapping" method="POST">
                @csrf
                <input type="hidden" name="data" id="form-data" value="">
                <button type="submit" id="loadButtonimport" class="btn btn-default"
                    id="eup-show-preview">{{ __('Import') }}</button>
            </form>
            </p>
        </div>
        <div class="row" id="autodiscoverytable">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped snipe-table" id="table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" data-field="id" data-visible="false">
                                                ID</th>
                                            <th data-sortable="true" data-field="name" data-visible="false">
                                                IP</th>
                                            <th data-sortable="true" data-field="asset_tag">
                                                Mac Address</th>
                                            <th data-sortable="true" data-field="serial">
                                                Host Name</th>
                                            <th data-sortable="true" data-field="model">
                                                Model</th>
                                            <th data-sortable="true" data-field="model_number" data-visible="false">
                                                Model Number</th>
                                            <th data-sortable="true" data-field="status_label">
                                                Serial Number</th>
                                            <th data-sortable="true" data-field="assigned_to">
                                                RAM</th>
                                            <th data-sortable="true" data-field="employee_number">
                                                CPU</th>
                                            <th data-sortable="true" data-field="location" data-searchable="true">
                                                DISK</th>
                                            <th data-sortable="true" data-field="location" data-searchable="true">
                                                OS_Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
        <div class="overlay" id="loadingOverlay">
            <div class="loader"></div>
        </div>
        <div id="content" style="display: none;">
            <!-- Your content goes here -->
            <p>This is the loaded content.</p>
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            function updateDataContainer(data) {
                fetchedData = data;
            }
            $(document).on('click', '#loadButton', function(e) {
                e.preventDefault();
                const apiUrl = "http://127.0.0.1:8000/scan/";
                $.get(apiUrl);
                //date
                const currentDatetime = new Date();
                const formattedDatetime =
                    `${currentDatetime.getFullYear()}_${(currentDatetime.getMonth() + 1).toString().padStart(2, '0')}_${currentDatetime.getDate().toString().padStart(2, '0')}_${currentDatetime.getHours().toString().padStart(2, '0')}_${currentDatetime.getMinutes().toString().padStart(2, '0')}`;
                const resultString = `network_devices_${formattedDatetime}.json`;
                console.log(resultString);
                showLoadingOverlay();
                /////////////////////////////////////////////////
                function pollForStatus(resultString) {
                    const url = "/fetch-file/" + resultString;

                    function fetchAndHandleStatus() {
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(response) {
                                if (response.status === 200) {
                                    updateDataContainer(response.filename);
                                    console.log("File fetched successfully:", response);
                                    hideLoadingOverlay();
                                    document.getElementById("autodiscoverytable").style
                                        .display = "block";
                                    document.getElementById("loadButtonimport").style.display =
                                        "block";
                                    //fetch data
                                    const data = response.filename /* Your data here */ ;

                                    const tableBody = document.querySelector(
                                        '#table tbody');

                                    if (data.length > 0) {
                                        data.forEach((item, index) => {
                                            const row = document.createElement('tr');

                                            const columns = [
                                                index + 1,
                                                item.ip || 'N/A',
                                                item.mac || 'N/A',
                                                item.hostname || 'N/A',
                                                item.model || 'N/A',
                                                item.model_number || 'N/A',
                                                item.serial_number || 'N/A',
                                                item.ram_info || 'N/A',
                                                item.cpu_info || 'N/A',
                                                item.disk_info || 'N/A',
                                                item.os_details || 'N/A',
                                            ];

                                            columns.forEach(content => {
                                                const cell = document
                                                    .createElement('td');
                                                cell.textContent = content;
                                                row.appendChild(cell);
                                            });

                                            tableBody.appendChild(row);
                                        });
                                    }
                                    ////
                                } else if (response.status === 404) {
                                    console.log("File not found. Polling again...");
                                    setTimeout(fetchAndHandleStatus,
                                        1000); // Poll again after 1 second
                                    showLoadingOverlay();
                                } else {
                                    console.log("Unexpected response status:", response.status);
                                    showLoadingOverlay();
                                    // Handle other response statuses
                                }
                            },
                            error: function(error) {
                                console.error("An error occurred:", error);
                                // Handle AJAX error
                            }
                        });
                    }

                    // Start the initial polling
                    fetchAndHandleStatus();
                }

                // Call the pollForStatus function with the initial resultString
                pollForStatus(resultString);

            });

            $("#data-form").submit(function(event) {
                event.preventDefault();
                var formData = fetchedData; // Use fetched data for form submission
                $("#form-data").val(JSON.stringify(formData));
                this.submit();
            });
        });

        function showLoadingOverlay() {
            document.getElementById("loadingOverlay").style.display = "flex";
        }

        function hideLoadingOverlay() {
            document.getElementById("loadingOverlay").style.display = "none";
        }
    </script>
    <style>
        /* Styles for loading overlay */
        #autodiscoverytable,
        #loadButtonimport {
            display: none;
        }

        .autodiscoverbutton {
            display: flex;
            flex-direction: row;
        }

        #loadButtonimport {
            margin-left: 10px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            border: 4px solid #F3F3F3;
            border-top: 4px solid #3498DB;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@stop
@section('moar_scripts')
@endsection
