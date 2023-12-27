@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Software Inventory
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
                                        {{-- <div class="row">
                                        <div
                                            class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                            <div class="fixed-table-container"> --}}
                                        <table id="exampleTable" class="display nowrap" style="width:100%">
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
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->asset_id }}</td>
                                                        <td>{{ $item->device_name }}</td>
                                                        <td>{{ $item->device_ip }}</td>
                                                        <td>{{ $item->mac_id }}</td>
                                                        <td>{{ $item->application_name }}</td>
                                                        <td>{{ $item->application_version }}</td>
                                                        <td>{{ $item->is_license }}</td>
                                                        <td>{{ $item->license_key }}</td>
                                                        <td>{{ $item->product_id }}</td>
                                                        <td>{{ $item->publisher }}</td>
                                                        <td>{{ $item->uninstall_str }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{-- </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                    {{-- <div class="d-flex justify-content-center">
                                        {{ $data->links() }}
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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
