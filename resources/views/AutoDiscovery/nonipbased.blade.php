@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Generate QR Code
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
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                <form id="nonIPbasedform" class="form-horizontal has-validation-callback">
                                    {{-- @csrf --}}
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="text-left"
                                                style="text-align: left; font-size: 24px; color: #333; margin-bottom: 20px; margin-top: 10px;">
                                                NON IP Based</div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Generate By</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <select class="form-control" id="generate_data" name="generate_data">
                                                        <option value="">--Please Select--</option>
                                                        <option value="ASSET_TAG">Asset Tag</option>
                                                        <option value="ASSET_NAME">Asset Name</option>
                                                        <option value="LOCATION">Location</option>
                                                        <option value="CATEGORY">Category</option>
                                                        <option value="DEPARTMENT">Sub Location</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Asset Data</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <select id="asset_data" name="asset_data[]" tabindex="1"
                                                        class="form-control selectpicker" data-style="btn-default"
                                                        style="width: 100%;" items="${assetData}" multiple="multiple">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="box-footer text-right">
                                                <a href="{{ route('AutoDiscovery.nonIPBased') }}"
                                                    class="btn btn-link text-left">Cancel</a>
                                                <button id="nonIPbasedbutton" type="button" class="btn btn-primary">
                                                    Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
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
                                        <table id="exampleTable" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Asset Tag</th>
                                                    <th>Asset Name</th>
                                                    <th>Location</th>
                                                    <th>Category</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Add pagination links -->
                                    {{-- <div class="d-flex justify-content-center">
                                        {{ $data->links() }}
                                    </div> --}}
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
    </div>

@stop
@section('moar_scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
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
            $('#asset_data').select2({
                placeholder: 'Select Asset Data',
                allowClear: true,
                closeOnSelect: false
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Attach a change event handler to the generate_data dropdown
            $('#generate_data').change(function() {
                // Get the selected value
                var selectedValue = $(this).val();

                // Check if a value is selected
                if (selectedValue !== "") {
                    // Make an AJAX request to the specified route
                    $.ajax({
                        url: "{{ route('AutoDiscovery.nonIPBasedData') }}",
                        type: "GET", // Adjust the HTTP method if needed
                        data: {
                            generate_data: selectedValue
                        },
                        success: function(data) {
                            var assetDataDropdown = $('#asset_data');
                            var compAssetData = $('#generate_data')
                                .val();

                            assetDataDropdown.empty();
                            data.forEach(function(item) {
                                assetDataDropdown.append('<option value="' + item[
                                    compAssetData] + '">' + item[
                                    compAssetData] + '</option>');
                            });

                            assetDataDropdown.selectpicker('refresh');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });










            $('#nonIPbasedbutton').click(function() {

                var formData = $('#nonIPbasedform').serialize();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: "{{ route('AutoDiscovery.addnonIPbased') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var assets = response;
                        $('#exampleTable tbody').empty();
                        // Loop through the array and update the table with the new data
                        assets.forEach(function(asset) {
                            var newRow = '<tr>' +
                                '<td>' + asset.asset_tag + '</td>' +
                                '<td>' + asset.asset_name + '</td>' +
                                '<td>' + asset.location + '</td>' +
                                '<td>' + asset.category + '</td>' +
                                '</tr>';

                            $('#exampleTable tbody').append(newRow);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


        });
    </script>
@endsection
