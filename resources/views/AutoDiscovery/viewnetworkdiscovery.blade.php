@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Network Discovery
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
                                <button id="importButton" class="btn btn-primary" style="margin: 5px 5px 5px 5px"
                                    type="button">Import</button>
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
                                                <th> <input type="checkbox" name="selectedItems[]" value=""></th>
                                                <th>ID</th>
                                                <th>Node IP</th>
                                                <th>Location</th>
                                                <th>Mac IP</th>
                                                <th>Node Name</th>
                                                <th>OEM</th>
                                                <th>OS Type</th>
                                                <!-- Add more headers as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="selectedItems[]"
                                                            value="{{ $item->id }}">
                                                    </td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->node_ip }}</td>
                                                    <td>{{ $item->location }}</td>
                                                    <td>{{ $item->mac_ip }}</td>
                                                    <td>{{ $item->node_name }}</td>
                                                    <td>{{ $item->oem }}</td>
                                                    <td>{{ $item->os_type }}</td>
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
    <script>
        // Check/uncheck all checkboxes when the header checkbox is clicked
        $('#exampleTable thead input[type="checkbox"]').click(function() {
            if (this.checked) {
                // Check all checkboxes in the tbody
                $('#exampleTable tbody input[type="checkbox"]').prop('checked', true);
            } else {
                // Uncheck all checkboxes in the tbody
                $('#exampleTable tbody input[type="checkbox"]').prop('checked', false);
            }
        });

        // Check/uncheck the header checkbox based on the status of tbody checkboxes
        $('#exampleTable tbody input[type="checkbox"]').click(function() {
            var allChecked = $('#exampleTable tbody input[type="checkbox"]:checked').length === $(
                '#exampleTable tbody input[type="checkbox"]').length;
            $('#exampleTable thead input[type="checkbox"]').prop('checked', allChecked);
        });


        $('#importButton').click(function(e) {
            e.preventDefault();

            // Array to store selected item IDs
            var selectedItems = [];

            // Find all checkboxes that are checked
            $('input[name="selectedItems[]"]:checked').each(function() {
                if (!$(this).closest('tr').find('th').length) {
                    var rowData = {
                        id: $(this).val(),
                        node_ip: $(this).closest('tr').find('td:eq(2)').text(),
                        location: $(this).closest('tr').find('td:eq(3)').text(),
                        node_name: $(this).closest('tr').find('td:eq(5)').text(),
                        // Include other properties as needed
                    };
                    selectedItems.push(rowData);
                } // Add the ID to the array
            });

            // Perform the AJAX request to send data to the server
            $.ajax({
                type: 'POST',
                url: '{{ route('AutoDiscovery.import') }}', // Laravel route function to generate the URL
                data: {
                    selectedItems: selectedItems
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data impoted successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((response) => {
                        window.location.href = '/AutoDiscovery/viewNetworkDiscovery';

                    });
                },
                error: function(error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    </script>
@endsection
