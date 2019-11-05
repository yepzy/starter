<script type="text/javascript" src="{{ mix('/js/manifest.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('/js/vendor.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('/js/admin.js') }}" defer></script>
@if(! empty($js))
    <script type="text/javascript" src="{{ $js }}" defer></script>
@endif
