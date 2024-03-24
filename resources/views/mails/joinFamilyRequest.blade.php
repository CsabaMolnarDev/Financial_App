<h1>Hello</h1>
<p>To accept the invitation, please click the following link:</p>
<a href="{{ route('family.acceptInvitation', ['token' => $invitation->token]) }}">Accept Invitation</a>