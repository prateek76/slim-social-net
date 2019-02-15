{% extends 'email/templates/default.php' %}

{% block content %}
<head>
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

	<style type="text/css">
	
		div
		{
			background: radial-gradient(circle, #484848, #2f3031);
			padding: 20px;
			color: white;
			font-family: 'Dosis', sans-serif;
			font-size: 24px;
		}
	</style>
</head>
	<div>
		Link to change your password
		<br>
		<br>
		<span>click on this link to reset your password:{{ base_url }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</span>
	</div>
{% endblock %}