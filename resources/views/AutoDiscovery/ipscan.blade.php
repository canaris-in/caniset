@extends('layouts/default')

{{-- Page title --}}
@section('title')
    IP Scan
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
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                <form  id="ipscanform" action="{{ route('AutoDiscovery.addipscan') }}" method="post" class="form-horizontal has-validation-callback">
                                    @csrf
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="text-left" style="text-align: left; font-size: 24px; color: #333; margin-bottom: 20px; margin-top: 10px;">IP Scan</div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">Group Name</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="text" class="form-control" name="group_name"
                                                        aria-label="group_name" id="group_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">IP Mask</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="text" class="form-control" name="start_ip"
                                                        aria-label="start_ip" id="start_ip" required>
                                                    <small class="form-text text-muted">Enter a valid IP address.</small>    
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" class="col-md-3 control-label">End IP Mask</label>
                                                <div class="col-md-7 col-sm-12 required">
                                                    <input type="text" class="form-control" name="end_ip"
                                                        aria-label="end_ip" id="end_ip" required>
                                                    <small class="form-text text-muted">Enter a valid IP address.</small>     
                                                </div>
                                            </div>
                                            <div class="box-footer text-right">
                                                <a href="{{ route('AutoDiscovery.ipScan') }}" class="btn btn-link text-left">Cancel</a>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // jQuery script to handle form submission
    $(document).ready(function() {
        $('#ipscanform').submit(function(event) {
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
                                window.location.href = '/AutoDiscovery/ipScan';
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
