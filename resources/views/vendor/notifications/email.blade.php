@component('mail::message')

{{-- Greeting --}}
@if ($greeting)
# {{ $greeting }}
@else
# @lang('mail.notification.greeting.default')
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{!! $line . '  ' !!}
@endforeach

{{-- Action Button --}}
@isset($actionText)
@php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
@endphp
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
    {{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{!! $line . '  ' !!}
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('mail.notification.salutation.default'),<br>
*@lang('mail.notification.signature', ['team' => config('app.name')])*
@endif

{{-- Subcopy --}}
@component('mail::subcopy')
@lang('mail.notification.action.alternative', [
'actionText' => $actionText,
'actionURL'  => $actionUrl
])
@endcomponent
    
@endcomponent
