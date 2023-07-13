@extends('layouts/default')

{{-- Page title --}}
@section('title')
ChatBot
@parent
@stop

{{-- Page content --}}
@section('content')
    {{-- Hide importer until vue has rendered it, if we continue using vue for other things we should move this higher in the style --}}
    <style>
        [v-cloak] {
            display:none;
        }

    </style>

<div id="app">
    <div class="form-group" id="eup-widget-code-wrapper">

        
        <div class="col-sm-6 col-sm-offset-2">
            {{-- <form action="/chatbot/url" method="POST"> --}}
            {{-- {{@csrf_field()}} --}}
                <label for="">Please Enter Domain:</label>
                <input rows="1.8" class="disabled form-control" name="urls" id="url" value="{{ $url }}">
                <textarea rows="1.8" class="disabled form-control" hidden name="url" id="urls">{{ $final_url }}</textarea>
            @if ('https')
                <p class="text-warning">
                    {{ __("Example. ex: 127.0.0.1:8000") }}
                </p>
            @endif
            <p class="text-help">
                {{ __("After making updates in the settings you need to update the code on your website.") }}
            </p>
            <p class="form-help">
                <button type="button" class="btn btn-default" id="eup-show-preview"  onclick="executeCode()" >{{ __("Submit") }}</button>
               
                <a href=""></a>
            </p>
            {{-- </form> --}}
        </div>
    </div>
</div>   
</div>
@stop
<script>
    // {{$final_url}};
    function executeCode() {
    var javascriptCode = document.getElementById('urls').value;
    // console.log($javascriptCode);

     var scriptElement = document.createElement('script');
        scriptElement.textContent = javascriptCode;
        document.head.appendChild(scriptElement);
         
    }
</script>
@section('moar_scripts')

@endsection
