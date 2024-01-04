@extends('layouts/default')

{{-- Page title --}}
@section('title')
    View Asset Management
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
                                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                                            <div class="fixed-table-container"> --}}
                            @php
                                $counter = 1;
                            @endphp
                            <table id="exampleTable" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ASSET_ID</th>
                                        <th>INVOICE_DATE</th>
                                        <th>INVOICE_NO</th>
                                        <th>PURCHASE_BILL</th>
                                        <th>PURCHASE_COST</th>
                                        <th>PURCHASE_DATE</th>
                                        <th>PURCHASE_ORDER_NO</th>
                                        <th>VENDOR</th>
                                        <th>ACQUISITION_DATE</th>
                                        <th>ASSET_TAG</th>
                                        <th>DEPARTMENT</th>
                                        <th>DESCRIPTION</th>
                                        <th>LICENSE_KEY</th>
                                        <th>LICENSE_OPTION</th>
                                        <th>LICENSE_TYPE</th>
                                        <th>LOCATION</th>
                                        <th>SUB_LOCATION</th>
                                        <th>MANUFACTURER</th>
                                        <th>MANUFACTURER_SW</th>
                                        <th>VOLUME</th>
                                        <th>AMC_AGREEMENT</th>
                                        <th>AMC_BILL</th>
                                        <th>AMC_EFFECTIVE_DATE</th>
                                        <th>AMC_EXPIRY_DATE</th>
                                        <th>EXPIRY_DATE</th>
                                        <th>INSURANCE_BILL</th>
                                        <th>INSURANCE_COMPANY_NAME</th>
                                        <th>INSURANCE_EFFECTIVE_DATE</th>
                                        <th>INSURANCE_EXPIRY_DATE</th>
                                        <th>INSURANCE_POLICY_NO</th>
                                        <th>WARRANTY_BILL</th>
                                        <th>WARRANTY_EFFECTIVE_DATE</th>
                                        <th>WARRANTY_EXPIRY_DATE</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $item->ASSET_ID ?? 'NA' }}</td>
                                            <td>{{ $item->INVOICE_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->INVOICE_NO ?? 'NA' }}</td>
                                            <td>{{ $item->PURCHASE_BILL ?? 'NA' }}</td>
                                            <td>{{ $item->PURCHASE_COST ?? 'NA' }}</td>
                                            <td>{{ $item->PURCHASE_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->PURCHASE_ORDER_NO ?? 'NA' }}</td>
                                            <td>{{ $item->VENDOR ?? 'NA' }}</td>
                                            <td>{{ $item->ACQUISITION_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->ASSET_TAG ?? 'NA' }}</td>
                                            <td>{{ $item->DEPARTMENT ?? 'NA' }}</td>
                                            <td>{{ $item->DESCRIPTION ?? 'NA' }}</td>
                                            <td>{{ $item->LICENSE_KEY ?? 'NA' }}</td>
                                            <td>{{ $item->LICENSE_OPTION ?? 'NA' }}</td>
                                            <td>{{ $item->LICENSE_TYPE ?? 'NA' }}</td>
                                            <td>{{ $item->LOCATION ?? 'NA' }}</td>
                                            <td>{{ $item->SUB_LOCATION ?? 'NA' }}</td>
                                            <td>{{ $item->MANUFACTURER ?? 'NA'  }}</td>
                                            <td>{{ $item->MANUFACTURER_SW ?? 'NA' }}</td>
                                            <td>{{ $item->VOLUME ?? 'NA' }}</td>
                                            <td>{{ $item->AMC_AGREEMENT ?? 'NA' }}</td>
                                            <td>{{ $item->AMC_BILL ?? 'NA' }}</td>
                                            <td>{{ $item->AMC_EFFECTIVE_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->AMC_EXPIRY_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->EXPIRY_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->INSURANCE_BILL ?? 'NA' }}</td>
                                            <td>{{ $item->INSURANCE_COMPANY_NAME ?? 'NA' }}</td>
                                            <td>{{ $item->INSURANCE_EFFECTIVE_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->INSURANCE_EXPIRY_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->INSURANCE_POLICY_NO ?? 'NA' }}</td>
                                            <td>{{ $item->WARRANTY_BILL ?? 'NA' }}</td>
                                            <td>{{ $item->WARRANTY_EFFECTIVE_DATE ?? 'NA' }}</td>
                                            <td>{{ $item->WARRANTY_EXPIRY_DATE ?? 'NA' }}</td>
                                        </tr>
                                    @endforeach
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
    {{-- </div>
        </div>
    </div> --}}
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
            $('#exampleTable').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                lengthMenu: [10, 25, 50, 100, 500, 1000, 2000], 
                pageLength: 10
            });
        });
    </script>
@endsection
