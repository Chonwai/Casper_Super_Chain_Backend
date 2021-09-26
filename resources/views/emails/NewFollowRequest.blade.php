<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <p>Hi {{ $follow->addressee['name'] }}, {{ $follow->requester['email'] }} has sent you a follow request.</p>
    <p>You're receiving this email because you has received the follow request by {{ $follow->requester['name'] }}. You can come back and confirm the follow request.</p>
    <p>Thanks,</p>
    <p>The Casper Team</p>
</html>