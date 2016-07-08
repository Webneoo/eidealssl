<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Careers</h2>

		<div>
			<b>From:</b> {{ $input['fullname'] }} <br/>
			<b>Date of birth:</b>{{ $input['birth_date'] }} <br/>
			<b>Email:</b>{{ $input['email'] }} <br/>
			<b>Position applied for:</b>{{ $input['position'] }} <br/>
			<b>Expected Salary:</b>{{ $input['salary'] }} <br/>
			<b>Experience:</b><br/>{{ nl2br($input['experience']) }} <br/>	
		</div>
	</body>
</html>
