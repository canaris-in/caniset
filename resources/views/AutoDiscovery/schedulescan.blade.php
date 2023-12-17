@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Schedule Scan
    @parent
@stop
<!-- Add this to your HTML file (head section) or install using npm/yarn -->
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-QHvzZqjzY2R64U+L0ZT+YXV3Zlpy6pkoF8XV1MOke6b4WRwP5+AUAs/CKvAJB/JCAfUqAs+uzgI5Il0sEJLx4A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

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
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                <form id="schedulescanform" action="{{ route('AutoDiscovery.addschedueleScan') }}" method="post"
                                    class="form-horizontal has-validation-callback">
                                    @csrf
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="text-left"
                                                style="text-align: left; font-size: 24px; color: #333; margin-bottom: 20px; margin-top: 10px;">
                                                Schedule Scan</div>
                                            <div class="form-group">
                                                <label for="exampleInputName" class="col-md-3 control-label">Configuration
                                                    Type</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <select class="form-control" id="scheduleType" name="scheduleType">
                                                        <option value="Daily Backup">Scan Once</option>
                                                        <option value="Weekly Backup">Daily Scan</option>
                                                        <option value="Monthly Backup">Weekly Scan</option>
                                                        <option value="Monthly Backup">Monthly Scan</option>
                                                        <option value="Plan Backup">Periodic Scan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Start IP</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="text" class="form-control" name="start_ip"
                                                        aria-label="start_ip" id="start_ip" required>
                                                    <small class="form-text text-muted">Enter a valid IP address.</small>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Subnet Mask</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="text" class="form-control" name="subnet_mask"
                                                        aria-label="subnet_mask" id="subnet_mask" required>
                                                    <small class="form-text text-muted">Enter a valid IP address.</small>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="configuration_type" class="col-md-3 control-label">Schedule Type</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <select class="form-control" name="configuration_type" id="configuration_type"
                                                        multiple="multiple" required>
                                                        <option value="Running Configuration">Running Configuration</option>
                                                        <option value="Startup Configuration">Startup Configuration</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                    <small class="form-text text-muted">Select one or more schedule
                                                        types.</small>
                                                </div>
                                            </div> --}} 
                                            <div class="form-group">
                                                <label for="configuration_type" class="col-md-3 control-label">Schedule Types</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <select class="form-control" name="configuration_type" id="configuration_type" multiple="multiple" >
                                                        <option value="Running Configuration">Running Configuration</option>
                                                        <option value="Startup Configuration">Startup Configuration</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                    <small class="form-text text-muted">Select one or more schedule types.</small>
                                                </div>
                                            </div>                                          
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Time</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="time" id="once_time" name="once_time" class="form-control" required>
                                                    <small class="form-text text-muted">Enter a Time.</small>
                                                </div>
                                            </div>                                          
                                            <div class="box-footer text-right">
                                                <a href="{{ route('AutoDiscovery.schedueleScan') }}"
                                                    class="btn btn-link text-left">Cancel</a>
                                                <button type="submit" class="btn btn-primary"> Submit</button>
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

@stop
@section('moar_scripts')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
        $('#configuration_type').select2({
            placeholder: 'Select schedule types',
            allowClear: true,
            closeOnSelect: false
        });
    });
    </script>
    <script>
        // jQuery script to handle form submission
        $(document).ready(function() {
            $('#schedulescanform').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);

                        // Use SweetAlert for a better user experience
                        Swal.fire({
                            title: 'Success!',
                            text: 'Form submitted successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            // Redirect to the show-form URL after the user clicks OK
                            if (result.isConfirmed) {
                                window.location.href = '/AutoDiscovery/schedueleScan';
                            }
                        });
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle the error as needed
                    }
                });

            });
        });


        
    </script>


@endsection
