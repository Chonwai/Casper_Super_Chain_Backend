<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <p>Hi {{ $follow->requester['name'] }}, {{ $follow->addressee['email'] }} has accepted your follow request.</p>
    <p>You're receiving this email because you has received the follow confirmation by {{ $follow->addressee['name'] }}. You can come back and check the follow status.</p>
    <p>Thanks,</p>
    <p>The Casper Team</p>
</html>