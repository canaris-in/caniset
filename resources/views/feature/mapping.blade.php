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
        {{-- @foreach ($submited_data as $device)
            <ul>
                @foreach ($device as $key => $value)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
            <hr>
        @endforeach --}}
        <form action="/mapping/import" method="post">
            @csrf
            @foreach ($submited_data as $device)
                @foreach ($device as $key => $value)
                    <input type="hidden" name="submited_data[{{ $loop->parent->index }}][{{ $key }}]"
                        value="{{ $value }}">
                @endforeach
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="table-responsive">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4 text-right">
                                                <div class="row">
                                                    <label class="control-label">
                                                        <h4>Header</h4>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-right">
                                                <div class="row">
                                                    <label class="control-label">
                                                        <h4>Import Field</h4>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-right">
                                                <div class="row">
                                                    <label class="control-label">
                                                        <h4>Sample Value</h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @if (!empty($data))
                                        @for ($i = 0; $i < count($data[1]); $i++)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 text-right">
                                                        <div class="row" style="margin-top: 20px">
                                                            <label
                                                                class="control-label">{{ $data[0][$i] ? $data[0][$i] : ' ' }}</label>
                                                            <input type="hidden" name="field_key_value[]"
                                                                value="{{ $data[0][$i] ? $data[0][$i] : ' ' }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <div class="row" style="margin-top: 20px">
                                                            <select class="" name="custome_field[]"
                                                                style="width: 250px; height: 35px;" required>
                                                                <option value="">Please Select</option>
                                                                @foreach ($data[2] as $item)
                                                                    <option value="{{ $item->name ? $item->name : ' ' }}">
                                                                        {{ $item->name ? $item->name : ' ' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 text-right">
                                                        <div class="row" style="margin-top: 20px">
                                                            <div class="required">
                                                                <label
                                                                    class="control-label">{{ $data[1][$i] ? $data[1][$i] : ' ' }}</label>
                                                                <input type="hidden" name="field_key_value_data"
                                                                    value="{{ $data[1][$i] ? $data[1][$i] : ' ' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-default">
                submit
            </button>
        </form>
    </div>
@stop
@section('moar_scripts')
@endsection
