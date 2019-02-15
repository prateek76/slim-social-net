{% extends 'email/templates/default.php' %}

{% block content %}
<head>
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

	<style type="text/css">
		div{
			background: linear-gradient(#A0EA4C,#E5EA4C);
			padding: 20px;
		}
		p{
			color: black;
			font-size: 24px;
			font-family: 'Dosis', sans-serif;
		}
	</style>
</head>
	<div>
		<p>You have successfully registered</p>
		<span>Active your account using this link :: {{ base_url }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</span>
	</div>
{% endblock %}