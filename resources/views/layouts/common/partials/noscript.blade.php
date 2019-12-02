<noscript class="d-flex justify-content-center bg-danger text-white p-4">
    @if($gtmId = $settings->google_tag_manager_id)
        <iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}"
                height="0"
                width="0"
                style="display:none;visibility:hidden;"></iframe>
    @endif
    <div class="noscript">
        <h3>
            <i class="fa fa-exclamation-triangle"></i>
            @lang('noscript.warning.title')
        </h3>
        @lang('noscript.warning.message')
    </div>
</noscript>
