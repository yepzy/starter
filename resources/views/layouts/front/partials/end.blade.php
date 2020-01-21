<script type="text/javascript" src="{{ mix('/js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ mix('/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ mix('/js/front.js') }}"></script>
@if(! empty($js))
    <script type="text/javascript" src="{{ $js }}"></script>
@endif
@stack('scripts')
