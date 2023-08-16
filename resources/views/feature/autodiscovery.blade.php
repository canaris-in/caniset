@extends('layouts/default')
{{-- Page title --}}
@section('title')
Auto Discovery
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
    <div class="autodiscoverbutton">
        <p class="form-help">
            <button id="loadButton" type="button" class="btn btn-default"
                id="eup-show-preview">{{ __("Scan") }}</button>
            <a href=""></a>
        </p>
        <p class="form-help">
            <button id="loadButtonimport" type="button" class="btn btn-default"
                id="eup-show-preview">{{ __("Import") }}</button>
            <a href=""></a>
        </p>
    </div>
    <div class="row" id="autodiscoverytable">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped snipe-table" id="table">
                                <thead>
                                    <tr>
                                        <th data-sortable="true" data-field="id" data-visible="false">
                                            {{ trans('general.id') }}</th>
                                        <th data-field="company" data-searchable="true" data-sortable="true"
                                            data-switchable="true" data-visible="false">{{ trans('general.company') }}
                                        </th>
                                        <th data-sortable="true" data-field="name" data-visible="false">
                                            {{ trans('admin/hardware/form.name') }}</th>
                                        <th data-sortable="true" data-field="asset_tag">
                                            {{ trans('admin/hardware/table.asset_tag') }}</th>
                                        <th data-sortable="true" data-field="serial">
                                            {{ trans('admin/hardware/table.serial') }}</th>
                                        <th data-sortable="true" data-field="model">
                                            {{ trans('admin/hardware/form.model') }}</th>
                                        <th data-sortable="true" data-field="model_number" data-visible="false">
                                            {{ trans('admin/models/table.modelnumber') }}</th>
                                        <th data-sortable="true" data-field="status_label">
                                            {{ trans('admin/hardware/table.status') }}</th>
                                        <th data-sortable="true" data-field="assigned_to">
                                            {{ trans('admin/hardware/form.checkedout_to') }}</th>
                                        <th data-sortable="true" data-field="employee_number">
                                            {{ trans('general.employee_number') }}</th>
                                        <th data-sortable="true" data-field="location" data-searchable="true">
                                            {{ trans('admin/hardware/table.location') }}</th>
                                        <th data-sortable="true" data-field="category" data-searchable="true">
                                            {{ trans('general.category') }}</th>
                                        <th data-sortable="true" data-field="manufacturer" data-searchable="true"
                                            data-visible="false">{{ trans('general.manufacturer') }}</th>
                                        <th data-sortable="true" data-field="purchase_cost" data-searchable="true"
                                            data-visible="false">{{ trans('admin/hardware/form.cost') }}</th>
                                        <th data-sortable="true" data-field="purchase_date" data-searchable="true"
                                            data-visible="false">{{ trans('admin/hardware/form.date') }}</th>
                                        <th data-sortable="false" data-field="eol" data-searchable="true">
                                            {{ trans('general.eol') }}</th>
                                        <th data-sortable="true" data-searchable="true" data-field="notes">
                                            {{ trans('general.notes') }}</th>
                                        <th data-sortable="true" data-searchable="true" data-field="order_number">
                                            {{ trans('admin/hardware/form.order') }}</th>
                                        <th data-sortable="true" data-searchable="true" data-field="last_checkout">
                                            {{ trans('admin/hardware/table.checkout_date') }}</th>
                                        <th data-sortable="true" data-field="expected_checkin" data-searchable="true">
                                            {{ trans('admin/hardware/form.expected_checkin') }}</th>
                                        @foreach(\App\Models\CustomField::all() AS $field)
                                        <th data-sortable="{{ ($field->field_encrypted=='1' ? 'false' : 'true') }}"
                                            data-visible="false" data-field="{{$field->db_column_name()}}">
                                            @if ($field->field_encrypted=='1')
                                            <i class="fas fa-lock"></i>
                                            @endif
                                            {{$field->name}}
                                        </th>
                                        @endforeach
                                        <th data-sortable="true" data-field="created_at" data-searchable="true"
                                            data-visible="false">{{ trans('general.created_at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $asset)
                                        <tr>
                                            <td>
                                                {{$asset->ip}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @foreach($data['asset'] as $asset)
                                    <tr>
                                        <td>
                                        {{ $asset['id'] ? $asset['id'] : "-" }}</td>
                                        <td>{{ trans('general.company') }}
                                        </td>
                                        <td>
                                        {{ $asset['name'] ? $asset['name'] : "-" }}</td>
                                        <td>
                                        {{ $asset['asset_tag'] ? $asset['asset_tag'] : "-" }}</td>
                                        <td>
                                            {{ $asset['serial'] ? $asset['serial'] : "-" }}</td>
                                        <td>
                                            {{ trans('admin/hardware/form.model') }}</td>
                                        <td>
                                            {{ trans('admin/models/table.modelnumber') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/table.status') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/form.checkedout_to') }}</td>
                                        <td>
                                            {{ trans('general.employee_number') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/table.location') }}</td>
                                        <td>
                                            {{ trans('general.category') }}</td>
                                        <td>{{ trans('general.manufacturer') }}</td>
                                        <td>{{ trans('admin/hardware/form.cost') }}</td>
                                        <td>{{ trans('admin/hardware/form.date') }}</td>
                                        <td>
                                            {{ trans('general.eol') }}</td>
                                        <td>
                                            {{ trans('general.notes') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/form.order') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/table.checkout_date') }}</td>
                                        <td>
                                            {{ trans('admin/hardware/form.expected_checkin') }}</td>
                                        @foreach(\App\Models\CustomField::all() AS $field)
                                        <td data-sortable="{{ ($field->field_encrypted=='1' ? 'false' : 'true') }}"
                                            data-visible="false" data-field="{{$field->db_column_name()}}">
                                            @if ($field->field_encrypted=='1')
                                            <i class="fas fa-lock"></i>
                                            @endif
                                            {{$field->name}}
                                        </td>
                                        @endforeach
                                        <td data-sortable="true" data-field="created_at" data-searchable="true"
                                            data-visible="false">{{ trans('general.created_at') }}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->
    <div class="overlay" id="loadingOverlay">
        <div class="loader"></div>
    </div>
    <div id="content" style="display: none;">
        <!-- Your content goes here -->
        <p>This is the loaded content.</p>
    </div>
    <!-- </div> -->
    <!-- </div> -->
</div>
</div>
<script>
document.getElementById("loadButton").addEventListener("click", function() {
    showLoadingOverlay();
    // Simulate loading time (remove this in actual implementation)
    setTimeout(function() {
        hideLoadingOverlay();
        document.getElementById("autodiscoverytable").style.display = "block";
        document.getElementById("loadButtonimport").style.display = "block";
    }, 3000);
});
function showLoadingOverlay() {
    document.getElementById("loadingOverlay").style.display = "flex";
}
function hideLoadingOverlay() {
    document.getElementById("loadingOverlay").style.display = "none";
}
</script>
<style>
/* Styles for loading overlay */
#autodiscoverytable, #loadButtonimport{
    display: none;
}
.autodiscoverbutton {
    display: flex;
    flex-direction: row;
}
#loadButtonimport {
    margin-left: 10px;
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.loader {
    border: 4px solid #F3F3F3;
    border-top: 4px solid #3498DB;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
@stop
@section('moar_scripts')
@endsection