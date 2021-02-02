@component('mail::message')
    # Venue Booking Enquiry Notification

    Hello {{$user->name}}, you have a booking request awaiting your response in our system.

    {{$booking->firstname.' '.$booking->lastname}} wants to book "{{$booking->venue->name}}" venue on the {{$booking->book_date}}.

    Details/Enquiries
    {{$booking->description}}

    Kindly log in and respond to the request.
    Thanks,
    {{ config('app.name') }}
@endcomponent
