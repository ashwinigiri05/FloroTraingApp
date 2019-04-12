<p>Hi, {{ $receiverUser->firstname ?? 'Super User'  }}</p>
<p>Welcome to Super-admin-panel !!</p>
<p>Your account is created By : {{ $senderUser->firstname .' '. $senderUser->lastname }}</p>
<p>Your login credentails are: </p>
<p>Email : {{ $receiverUser->email ?? 'Super User'  }}</p>
<p>password : {{ $additionalInformation['password'] ?? 'Super User'  }}</p>
<p>
    <a class="btn btn-primary" href="{{ env('APP_URL') . '/login' }}" >
        Click here to login
    </a>
</p>