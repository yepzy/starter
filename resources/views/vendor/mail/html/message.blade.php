@component('mail::layout')
    @php
        $phoneNumber = settings()->phone_number;
        $email = settings()->email;
    @endphp
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot
    {{-- Topcopy --}}
    @slot('topcopy')
        @component('vendor.mail.html.topcopy')
            @lang('mails.notification.noReply')
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
                <br>@lang('mails.notification.action.contact') :
                @if($phoneNumber)
                    @lang('mails.notification.action.phone', compact('phoneNumber'))
                @endif
                @if($email)
                    @if($phoneNumber)
                        -
                    @endif
                    @lang('mails.notification.action.email', compact('email'))
                @endif
            @endif
        @endcomponent
    @endslot
@endcomponent
