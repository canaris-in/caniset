@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View IP Scan
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

    {{-- <div id="app">
        <div class="form-group" id="eup-widget-code-wrapper">
            <div class="col-sm-12 col-sm-offset-0"> --}}
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
                                    <table id="exampleTable" class="display nowrap" style="width:100%" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Group Name</th>
                                                <th>Start IP</th>
                                                <th>End IP</th>
                                                <th>Delete</th>
                                                <!-- Add more headers as needed -->
                                            </tr>
                                        </thead>
                                        @php
$counter = 1;
@endphp
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{ $item->group_name }}</td>
                                                    <td>{{ $item->start_ip }}</td>
                                                    <td>{{ $item->end_ip }}</td>
                                                    {{-- <td>
                                                        <button class="btn btn-danger" onclick="deleteIPScan({{ $item->id }})">Delete</button>
                                                    </td> --}}
                                                    <td>
                                                        <form action="{{ route('AutoDiscovery.deleteIPScan', $item->id) }}"
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
                        </div>
                    </section>
                </div>
            {{-- </div>
        </div>
    </div> --}}
@endsection
@section('moar_scripts')
    {{-- <script>
        $(document).ready(function() {
            // Make an AJAX request to fetch data
            $.ajax({
                url: '/AutoDiscovery/viewipScan', // Replace with your actual server endpoint
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate the table with the fetched data
                    populateTable(data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            function populateTable(data) {
                var tbody = $('#exampleTable tbody');
                // Clear existing rows
                tbody.empty();

                // Loop through the data and append rows to the table
                for (var i = 0; i < data.length; i++) {
                    var row = '<tr>' +
                        '<td>' + data[i].id + '</td>' +
                        '<td>' + data[i].group_name + '</td>' +
                        '<td>' + data[i].start_ip + '</td>' +
                        '<td>' + data[i].end_ip + '</td>' +
                        // Add more cells as needed
                        '</tr>';
                    tbody.append(row);
                }
            }
        });
    </script> --}}

    <script>
        // function deleteIPScan(id) {
        //     $.ajax({
        //         url: '/AutoDiscovery/deleteIPScan' + id, 
        //         method: 'DELETE',
        //         dataType: 'json',
        //         success: function (response) {
        //             Swal.fire({
        //                     title: 'Success!',
        //                     text: 'Item deleted successfully',
        //                     icon: 'success',
        //                     confirmButtonText: 'OK'
        //                 }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         window.location.href = '/AutoDiscovery/viewipScan';
        //                     }
        //                 });
        //         },
        //         error: function (error) {
        //             console.error('Error deleting item:', error);
        //         }
        //     });
        // }
    </script>
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
                    dom: 'Blfrtip',
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10
                });
            });
        </script>
@endsection
