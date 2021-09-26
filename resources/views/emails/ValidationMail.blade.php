<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <p>Hi {{ $user->name }},</p>
    <p>You're receiving this email because you are doing validation of your Casper Super Chain account. If you are not sure why you're receiving this, please contact your systems administrator.</p>
    <a href="{{ $validateLink }}">Confirm my account</a>
    <p>Thanks,</p>
    <p>The Casper Team</p>
</html>