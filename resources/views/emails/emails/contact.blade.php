@component('mail::message')
# New Contact Submission

##Email
{{ $email }}

##Message
{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
