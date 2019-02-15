{% extends 'email/templates/default.php' %}

{% block content %}
<head>
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

	<style type="text/css">
	
		div{
			background: radial-gradient(circle, #484848, #2f3031);
			padding: 20px;
			color: white;
			font-family: 'Dosis', sans-serif;
			font-size: 24px;
		}
	</style>
</head>
	<div>
		You have successfully changed your password
		<br>
		<br>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
{% endblock %}