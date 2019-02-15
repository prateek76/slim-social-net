{% extends 'templates/default.php' %}

{% block title %} Register {% endblock %}

{% block content %}
	<div class="col-xs-3" style="left: calc(39%);top: 64px;">
	<form action="{{urlFor('register.post')}}" method="post" autocomplete="off">
		<div class="form-group">
			<label for="email">Email</label>
			<input class="form-control" type="text" name="email" id="email" {% if request.post('email') %} value="{{request.post('email')}}" {% endif %}">
			{% if errors.first('email') %} {{errors.first('email')}} {% endif %}
		</div>
		<div class="form-group">
			<label for="username">username</label>
			<input class="form-control" type="text" name="username" id="username"  {% if request.post('email') %} value="{{request.post('username')}}" {% endif %}>
			{% if errors.first('username') %} {{errors.first('username')}} {% endif %}
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input class="form-control" type="password" name="password" id="password">
			{% if errors.first('password') %} {{errors.first('password')}} {% endif %}
		</div>
		<div class="form-group">
			<label for="password_confirm">Confirm Password</label>
			<input class="form-control" type="password" name="password_confirm" id="password_confirm">
			{% if errors.first('password_confirm') %} {{errors.first('password_confirm')}} {% endif %}
		<div class="form-group">
			<br>
			<button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
		</div>

		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
	</div>
{% endblock %}