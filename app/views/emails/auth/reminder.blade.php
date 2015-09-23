<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Password Reset</h1>
        <p>To reset your password, visit this <a href="{{ URL::route('user/reset', array('token'=>$token))}}">page</a> and complete password reset process.</p>    

        <p>If you did not request to reset your password, please ignore this email or contact support.</p> 
    </body>
</html>