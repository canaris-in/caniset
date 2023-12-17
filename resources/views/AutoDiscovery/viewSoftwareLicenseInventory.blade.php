@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Software License Inventory
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
                                        <table id="softwareLicenseInventoryTable" class="table table-bordered">
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
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->asset_id }}</td>
                                                        <td>{{ $item->device_name }}</td>
                                                        <td>{{ $item->device_ip }}</td>
                                                        <td>{{ $item->mac_id }}</td>
                                                        <td>{{ $item->data_type }}</td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->product_type }}</td>
                                                        <td>{{ $item->value }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{-- </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {{ $data->links() }}
                                    </div>
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
