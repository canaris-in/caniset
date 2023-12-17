@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Hard Disk Configuration
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
                                                    <th>ID</th>
                                                    <th>Asset ID</th>
                                                    <th>Capacity</th>
                                                    <th>Interface Type</th>
                                                    <th>Manufacturer</th>
                                                    <th>Media Type</th>
                                                    <th>Model</th>
                                                    <th>Name</th>
                                                    <th>Serial Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->asset_id }}</td>
                                                        <td>{{ $item->capacity }}</td>
                                                        <td>{{ $item->interface_type }}</td>
                                                        <td>{{ $item->manufacturer }}</td>
                                                        <td>{{ $item->media_type }}</td>
                                                        <td>{{ $item->model }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->serial_number }}</td>
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
