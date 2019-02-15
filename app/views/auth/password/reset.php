{% extends 'templates/default.php' %}

{% block title %} Reset password {% endblock %}

{% block content %}
	<?php
		//i am sending this identifier after taking from the link send to email
	?>
	<div class="col-xs-2">
	<form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
		<div class="form-group">
			<label for="password">Password</label>
			<input class="form-control" type="password" name="password" id="password">
			{% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
		</div>
		<div class="form-group">
			<label for="password_confirm">Confirm Password</label>
			<input class="form-control" type="password" name="password_confirm" id="password_confirm">
			{% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Reset</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form> 
	</div>
{% endblock %}