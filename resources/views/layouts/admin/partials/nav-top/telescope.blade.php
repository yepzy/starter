@if(app()->environment('local'))
    <li class="nav-item">
        <a class="nav-link"
           href="/telescope"
           title="{{ __('Debug assistant.') }}"
           target="_blank">
            <i class="fas fa-binoculars fa-fw text-success"></i>
            <span class="d-none d-xl-inline">{{ __('Telescope') }}</span>
        </a>
    </li>
@endif
