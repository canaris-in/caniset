@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Add Asset Management
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

        .content {
            margin-left: auto;
            margin-right: auto;
            min-height: 150px;
            padding: 15px;
        }


        .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}
        
    </style>
    {{-- <div id="app"> --}}
    {{-- <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0"> --}}
    <div class="showAlert"></div>                    
    <div id="webui">
        <section class="content" id="main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs hidden-print">
                    <!-- Tab headers -->
                    <!-- ... -->
                </ul>
                <form id="assetMangementForm" action="{{ route('AutoDiscovery.submitAssetManagement')}}" method="post" style="margin-top: 25px;" enctype="multipart/form-data">
                    @csrf
                <div class="tab-content">
                    <div class="form-row" style="display: flex; margin-top:10px;">
                        <div class="form-group col-md-6">
                            <label for="manufactureName">Manufacture Name</label>
                            {{-- <input type="text" class="form-control"> --}}
                            <select class="form-control" id="manufactureName" name="manufactureName">
                                <option value="">Please Select</option>
                                @foreach ($manufactureName as $manufacturer)
                                <option value="{{ $manufacturer }}">{{ $manufacturer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="manufactureSoftware">Manufacture Software</label>
                            {{-- <input type="text" class="form-control" id="lastName"> --}}
                            <select class="form-control" id="manufactureSoftware" name="manufactureSoftware">
                                <option value="">Please Select</option>
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="form-row" style="display: flex;">
                        <div class="form-group col-md-6">
                            <label for="licenseType">License Type</label>
                            {{-- <input type="text" class="form-control"> --}}
                            <select class="form-control" id="licenseType" name="licenseType">
                                <option value="">Please Select</option>
                                <option value="volume">Volume</option>
                                <option value="single_license">Single License</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="licenseOption">License Option</label>
                            {{-- <input type="text" class="form-control"> --}}
                            <select class="form-control" id="licenseOption" name="licenseOption">
                                <option value="">Please Select</option>
                                <option value="full_pakage">Full Package</option>
                                <option value="others">Others</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist" style="background-color: #e0e3e7;">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile">Financial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#contact">License</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#message">Maintenance

                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                                        <div class="pt-4">
                                            {{-- <ul class="nav nav-tabs hidden-print"
                                                style="background-color: black; color: white; padding-left:10px;">
                                                <h3 class="pull-left pagetitle">HW Configuration</h3>
                                            </ul> --}}
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="asset_tag">Asset Tag</label>
                                                    <input type="text" class="form-control" id="asset_tag" name="asset_tag" placeholder="Enter Asset Tag" >
                                                    <div class="invalid-feedback">Please enter the asset tag.</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="expiry_date">Expiry Date</label>
                                                    {{-- <input type="text" class="form-control" id="lastName"> --}}
                                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date" >
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="acquistionDate">Acquistion Date</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <input type="date" class="form-control" id="acquistionDate" name="acquistionDate">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="location">Location</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <select class="form-control" id="location" name="location">
                                                        <option value="">Please Select</option>
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="subLocation">Sub Location</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <select class="form-control" id="subLocation" name="subLocation">
                                                        <option value="">Please Select</option>
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="description">Description</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                        <div class="pt-4">
                                            {{-- <ul class="nav nav-tabs hidden-print"
                                                style="background-color: black; color: white; padding-left:10px;">
                                                <h3 class="pull-left pagetitle">HW Configuration</h3>
                                            </ul> --}}
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="vendor">Vendor</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <select class="form-control" id="vendor" name="vendor">
                                                        <option value="">Please Select</option>
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="purchase_order_no">Purchase Order No</label>
                                                    <input type="text" class="form-control" id="purchase_order_no" name="purchase_order_no" placeholder="Enter Purchase Order No">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="purchase_cost">Purchase Cost</label>
                                                    <input type="text" class="form-control" id="purchase_cost" name="purchase_cost" placeholder="Enter Purchase Cost">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="purchase_date">Purchase Date</label>
                                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="invoice_no">Invoice Number</label>
                                                    <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Enter Invoice Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="invoice_date">Invoice Date</label>
                                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="purchaseBill">Purchase Bill</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <input type="file" class="form-control" id="purchaseBill" name="purchaseBill">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact">
                                        <div class="pt-4">
                                            {{-- <ul class="nav nav-tabs hidden-print"
                                                style="background-color: black; color: white; padding-left:10px;">
                                                <h3 class="pull-left pagetitle">HW Configuration</h3>
                                            </ul> --}}
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="firstName">IP Address</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="lastName">Mac Address</label>
                                                    <input type="text" class="form-control" id="lastName">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="firstName">Manufacture</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="lastName">Processor Count</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="message">
                                        <div class="pt-4">
                                            {{-- <ul class="nav nav-tabs hidden-print"
                                                style="background-color: black; color: white; padding-left:10px;">
                                                <h3 class="pull-left pagetitle">HW Configuration</h3>
                                            </ul> --}}
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="warranty_effective_date">Warranty Effective Date</label>
                                                    <input type="date" class="form-control" id="warranty_effective_date" name="warranty_effective_date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="warranty_expiry_date">Warranty Expiry Date</label>
                                                    <input type="date" class="form-control" id="warranty_expiry_date" name="warranty_expiry_date">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="amc_effective_date">AMC Effective Date</label>
                                                    <input type="date" class="form-control" id="amc_effective_date" name="amc_effective_date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amc_expiry_date">Amc Expiry Date</label>
                                                    <input type="date" class="form-control" id="amc_expiry_date" name="amc_expiry_date">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex; margin-top:10px;">
                                                <div class="form-group col-md-6">
                                                    <label for="insurance_effective_date">Insurance Effective Date</label>
                                                    <input type="date" class="form-control" id="insurance_effective_date" name="insurance_effective_date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="insurance_expiry_date">Insurance Expiry Date</label>
                                                    <input type="date" class="form-control" id="insurance_expiry_date" name="insurance_expiry_date" placeholder="Select Insurance Expiry Date">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="insurance_company_name">Insurance Company Name</label>
                                                    {{-- <input type="text" class="form-control"> --}}
                                                    <select class="form-control" id="insurance_company_name" name="insurance_company_name">
                                                        <option value="">Please Select</option>
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="insurance_policy_no">Insurance Policy Number</label>
                                                    <input type="text" class="form-control" id="insurance_policy_no" name="insurance_policy_no" placeholder="Enter Insurance policy Number">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="amc_agreement">AMC Agreement</label>
                                                    <input type="file" class="form-control" id="amc_agreement" name="amc_agreement">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amc_bill">AMC Bill</label>
                                                    <input type="file" class="form-control" id="amc_bill" name="amc_bill">
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: flex;">
                                                <div class="form-group col-md-6">
                                                    <label for="warranty_bill">Warranty Bill</label>
                                                    <input type="file" class="form-control" id="warranty_bill" name="warranty_bill">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="insurance_bill">Insurance Bill</label>
                                                    <input type="file" class="form-control" id="insurance_bill" name="insurance_bill">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center><button id="addAssetManagement" type="button" class="btn btn-primary" style="margin-top: 10px;margin-bottom:10px;">Submit</button></center>
                </div>
            </form>
            </div>
        </section>
    </div>
    {{-- </div>
        </div> --}}
    {{-- </div> --}}
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
            $('#exampleTable1,#exampleTable11,#exampleTable12,#exampleTable13,#exampleTable14').DataTable({
                dom: 'tip',

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleTable2').DataTable({
                dom: 'tip',

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#exampleTable3').DataTable({
                dom: 'Blftip',
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000],
                pageLength: 10
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleTable4').DataTable({
                dom: 'Blftip',
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000],
                pageLength: 10

            });
        });
    </script>

    <script>
        $(document).ready(function () {
        $('#manufactureName').change(function () {
            var selectedManufacturer = $(this).val();

            // Make AJAX request
            $.ajax({
                type: 'GET',
                url: '/AutoDiscovery/getManufactureSoftware', // Replace with your actual AJAX endpoint URL
                data: {
                    manufacturer: selectedManufacturer
                },
                success: function (data) {
                    $('#manufactureSoftware').empty();
                    $('#manufactureSoftware').append('<option value="">Please Select</option>');
                    $.each(data, function (index, value) {
                    $('#manufactureSoftware').append('<option value="' + value + '">' + value + '</option>');
                });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });


    
        $('#addAssetManagement').click(function () {
            var selectedManufacturer = $(this).val();
            var formData = new FormData($('#assetMangementForm')[0]);
            $.ajax({
                type: 'POST',
                url: '/AutoDiscovery/submitAssetManagement', 
                data:formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    showAlert('Data submitted successfully', 'success','.showAlert');
                    window.location.href = '/AutoDiscovery/addAssetManagement';
                    console.log(response);
                },
                error: function (xhr) {
                    // Handle errors
                    if (xhr.status === 422) {
                        // Validation error response
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = "Validation Errors:\n";

                        $.each(errors, function (key, value) {
                            errorMessage += key + ': ' + value[0] + '\n';
                        });

                        alert(errorMessage);
                    } else {
                        // Handle other errors
                        console.log(xhr.responseText);
                    }
                }
            });
        });
       

        function showAlert(message, type,containerSelector) {
    // Create a div for the alert
    var alertDiv = $('<div>');

    // Add appropriate styling based on the alert type
    if (type === 'success') {
        alertDiv.addClass('alert alert-success');
    } else {
        alertDiv.addClass('alert alert-danger');
    }

    // Set the alert message
    alertDiv.text(message);

    // Append the alert to the body or any specific container in your HTML
    $(containerSelector).html(alertDiv);

    // Fade out the alert after a certain duration (e.g., 3 seconds)
    setTimeout(function () {
        alertDiv.fadeOut('slow', function () {
            // Remove the alert from the DOM after fading out
            alertDiv.remove();
        });
    }, 3000); // 3000 milliseconds = 3 seconds
}
    });
    </script>
@endsection
