@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Software Wise
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
                                                    <th>Application Name</th>
                                                    <th>Application Version</th>
                                                    <th>Publisher</th>
                                                    <th>Software Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->application_name }}</td>
                                                    <td>{{ $item->application_version }}</td>
                                                    <td>{{ $item->publisher }}</td>
                                                    <td class="open-modal" data-toggle="modal" data-target="#exampleModal" data-device-name="{{ $item->application_name }}">
                                                        {{ $item->app_count }}
                                                    </td>
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



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                                <table id="exampleTableGetData" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Device Name</th>
                                            <th>Device IP</th>
                                            <th>Mac Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
@endsection
@section('moar_scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener for the cell click
            var modalCells = document.querySelectorAll('.open-modal');
            modalCells.forEach(function (cell) {
                cell.addEventListener('click', function () {
                    var appname = this.getAttribute('data-device-name');
    
                    fetch('/getDataSoftwareWise/' + appname)
                                .then(response => response.json())
                                .then(additionalData => {
                                    // Populate the second table with additionalData
                                    var tableBody = document.querySelector('#exampleTableGetData tbody');
                                    tableBody.innerHTML = ''; // Clear existing data
    
                                    additionalData.data.forEach(item => {
                                        var row = '<tr>' +
                                            '<td>' + item.device_name + '</td>' +
                                            '<td>' + item.device_ip + '</td>' +
                                            '<td>' + item.mac_id + '</td>' +
                                            '</tr>';
                                        tableBody.innerHTML += row;
                                    });
                                })
                                .catch(error => console.error('Error fetching additional data:', error));

                });
            });
        });
    </script>
@endsection
