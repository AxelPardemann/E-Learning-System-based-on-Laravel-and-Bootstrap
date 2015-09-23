<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2 class="h2">{{$email_subject}}</h2>
		<div>
			{{$email_body}}
		</div>
		<h2 class="h2">Selected comments</h2>
		<div>
			{{$editor_comment}}
		</div>
		<h2 class="h2">Freeform comments</h2>
		<div>
			{{$editor_message}}
		</div>
    </body>
</html>