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
            <form action="/chatbot/url" method="POST">
            {{@csrf_field()}}
                <label for="">Please Enter Domain Name:</label>
                <input type="text" rows="1.8" class="disabled form-control" name="urls" id="url" required value="{{ $url }}">
                <textarea style="margin-top: 10px;" rows="5" class="disabled form-control" readonly name="url" id="urls">{{ $final_url }}</textarea>
            @if ('https')
                <p class="text-warning">
                    {{ __("Example. ex: demo-canidesk.canaris.in") }}
                </p>
            @endif
            <p class="text-help">
                {{ __("After making updates in the settings you need to update the code on your website.") }}
            </p>
            <p class="form-help">
                <button type="submit" class="btn btn-default" id="eup-show-preview">{{ __("Submit") }}</button>
                <a href=""></a>
            </p>
            </form>
        </div>
    </div>
</div>   
</div>
<script>
    const javascriptCode = document.getElementById('urls').value;
     const scriptElement = document.createElement('script');
        scriptElement.textContent = javascriptCode;
        document.head.appendChild(scriptElement);
</script>
@stop

@section('moar_scripts')

@endsection
