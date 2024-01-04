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

            .qr-code-image {
                margin: 10px;
            }
        </style>

        <div id="app">
            <div class="form-group" id="eup-widget-code-wrapper">


                <div class="col-sm-12 col-sm-offset-0">
                    <div id="webui">
                        <section class="content" id="main">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                    <form id="ipbasedform" class="form-horizontal has-validation-callback">
                                        {{-- @csrf --}}
                                        <div class="box box-default">
                                            <div class="box-body">
                                                <div class="text-left"
                                                    style="text-align: left; font-size: 24px; color: #333; margin-bottom: 20px; margin-top: 10px;">
                                                    IP Based</div>
                                                <div class="form-group ">
                                                    <label for="name" class="col-md-3 control-label">Generate By</label>
                                                    <div class="col-md-7 col-sm-12 required">
                                                        <select class="form-control" id="generate_data"
                                                            name="generate_data">
                                                            <option value="">--Please Select--</option>
                                                            <option value="ASSET_ID">Asset ID</option>
                                                            <option value="ASSET_TAG">Asset Tag</option>
                                                            <option value="ASSET_NAME">Asset Name</option>
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
                                                    <a href="{{ route('AutoDiscovery.ipBased') }}"
                                                        class="btn btn-link text-left">Cancel</a>
                                                    <button id="ipbasedbutton" type="button" class="btn btn-primary">
                                                        Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="qrcode-container" class="table-container"></div>

    @stop

    @section('moar_scripts')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>


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
                            url: "{{ route('AutoDiscovery.ipBasedData') }}",
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










                $('#ipbasedbutton').click(function() {

                    var formData = $('#ipbasedform').serialize();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'GET',
                        url: "{{ route('AutoDiscovery.addipbased') }}",
                        data: formData,
                        // dataType: 'json',
                        success: function(response) {
                            // $('#qrcode-container').empty();

                            // // Loop through the array and generate QR codes
                            // response.forEach(function(asset) {
                            //     // Assuming each asset has a property named 'qrCodeValue'
                            //     var qrCodeValue = "Asset Tag: " + asset.asset_tag +
                            //         "\nAsset Name: " + asset.asset_name +
                            //         "\nLocation: " + asset.location +
                            //         "\nCategory: " + asset.category +
                            //         "\nAcquisition Date: " + asset.acquisition_date +
                            //         "\nAsset Serial Number: " + asset.asset_serial_number +
                            //         "\nAsset Status: " + asset.asset_status +
                            //         "\nAsset Type: " + asset.asset_type +
                            //         "\nClass: " + asset.class +
                            //         "\nCompany: " + asset.company +
                            //         "\nDepartment: " + asset.department +
                            //         "\nGroup Name: " + asset.group_name +
                            //         "\n";

                            //     // Create a new QR code element
                            //     var qrCode = document.createElement('div');
                            //     qrCode.className = 'qr-code-image';
                            //     new QRCode(qrCode, {
                            //         text: qrCodeValue,
                            //         width: 200,
                            //         height: 200
                            //     });

                            //     // Append the QR code to the container
                            //     $('#qrcode-container').append(qrCode);
                            // });
                            console.log(response);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });


            });
        </script>
    @endsection
