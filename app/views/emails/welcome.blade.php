<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2 class="h2">New Member Registration</h2>
        <p>Password is {{$password}}</p>
			Thanks for signing up for {{$firstname}} {{$lastname}}, your login is: {{$email}}

			Confirming your account will give you full access to the {{$firstname}} {{$lastname}} control panel and all future notifications will be sent to this email address. (If not confirmed this request will expire in 1 hour.)

			To verify your account, please click following link
			<a href="{{ URL::route('user/verify', array('token'=>$token))}}">Page</a>
    </body>
</html>