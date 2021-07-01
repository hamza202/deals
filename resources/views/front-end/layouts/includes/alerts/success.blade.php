{{--@if(Session::has('success'))--}}
{{--    <div class="row mr-2 ml-2">--}}
{{--            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"--}}
{{--                    id="type-error">{{Session::get('success')}}--}}
{{--            </button>--}}
{{--    </div>--}}

{{--   --}}
{{--@endif--}}

<script>
    @if (session('alert'))
    swal("{{ session('alert') }}");
    @endif
</script>


@if(Session::has('success'))

    <div class="alert alert-success alert-block">
        <strong>{{ session('success') }}</strong>
    </div>
@endif
