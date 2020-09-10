@component('mail::message')
# Introduction
<div>
    Price: {{ $eventBookings }}
</div>
The body of your message.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
