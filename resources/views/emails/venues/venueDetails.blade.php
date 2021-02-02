@component('mail::message')
    # Venue Details Notification
    Hi, {{$booking->firstname.' '.$booking->lastname}}. Your request for the  "{{$booking->venue->name}}" venue on the {{$booking->book_date}} has been {{$booking->status->name}}.
@if ($booking->status->name== 'confirmed')
    Kindly click on the link below to proceed with making the payment.
    The link will expire after 24 hrs, after which the request will be automatically rejected.
@component('mail::button', ['url' => \URL::to('/venue/venuePayment/'.$booking->code.'-'.$booking->id)])
Make Payment
@endcomponent
@endif


    Thanks,
    {{ config('app.name') }}
@endcomponent


