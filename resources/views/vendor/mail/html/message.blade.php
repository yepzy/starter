@component('mail::layout')
    @php
        $settings = cache('settings');
        $phoneNumber = optional($settings)->phone_number;
        $email = optional($settings)->email;
    @endphp
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url'), 'settings' => $settings])
            {{ config('app.name') }}
        @endcomponent
    @endslot
    {{-- Topcopy --}}
    @slot('topcopy')
        @component('vendor.mail.html.topcopy')
            @lang('mail.notification.noReply')
        @endcomponent
    @endslot
    {{-- Body --}}
    {{ $slot }}
    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
            @if($phoneNumber || $email)
                <br>@lang('mail.notification.action.contact') :
                @if($phoneNumber)
                    @lang('mail.notification.action.phone', compact('phoneNumber'))
                @endif
                @if($email)
                    @if($phoneNumber)
                        -
                    @endif
                    @lang('mail.notification.action.email', compact('email'))
                @endif
            @endif
        @endcomponent
    @endslot
@endcomponent
