@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Schedule Scan
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
                                    {{-- <div class="row">
                                        <div
                                            class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                            <div class="fixed-table-container"> --}}
                                    <table id="exampleTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Start IP</th>
                                                <th>Schedule Type</th>
                                                <th>Subnet mask</th>
                                                <th>Configuration Type</th>
                                                <th>Time</th>
                                                <th>Delete</th>
                                                <!-- Add more headers as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->start_ip }}</td>
                                                    <td>{{ $item->schedule_type }}</td>
                                                    <td>{{ $item->subnet_mask }}</td>
                                                    <td>{{ $item->configuration_type }}</td>
                                                    <td>{{ $item->once_time }}</td>
                                                    {{-- <td>
                                                        <button class="btn btn-danger" onclick="deleteIPScan({{ $item->id }})">Delete</button>
                                                    </td> --}}
                                                    <td>
                                                        <form action="{{ route('AutoDiscovery.deleteScheduleScan', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
