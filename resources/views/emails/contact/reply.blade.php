<!DOCTYPE html>
<html>
<head>
    <title>Re: {{ $contact->subject }}</title>
</head>
<body>
    <p>Hi {{ $contact->name }},</p>
    <p>Thank you for contacting us. Here is the reply to your inquiry:</p>
    <p><em>{{ $replyMessage }}</em></p>
    <hr>
    <p><strong>Your Original Message:</strong></p>
    <p>{{ $contact->message }}</p>
    <br>
    <p>Regards,<br>{{ config('app.name') }} Team</p>
</body>
</html>
