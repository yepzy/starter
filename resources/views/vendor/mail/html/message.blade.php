@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
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
            @if($settings->phone_number || $settings->email)
                <br>@lang('mail.notification.action.contact') :
                @if($phoneNumber = $settings->phone_number)
                    @lang('mail.notification.action.phone', compact('phoneNumber'))
                @endif
                @if($email = $settings->email)
                    @if($phoneNumber)
                        -
                    @endif
                    @lang('mail.notification.action.email', compact('email'))
                @endif
            @endif
        @endcomponent
    @endslot
@endcomponent
