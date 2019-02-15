{% extends 'templates/default.php' %}

{% block title %} Change Password {% endblock %}

{% block content %}
	<div class="col-xs-2">
	<form action="{{ urlFor('password.change.post') }}" method="post" autocomplete="off">
		<div class="form-group">
			<label for="password_old">current password</label>
			<input class="form-control" type="password" name="password_old" id="password_old">
			{% if errors.first('password_old') %} {{errors.first('password_old')}} {% endif %}
		</div>
		<div class="form-group">
			<label for="password">New Password</label>
			<input class="form-control" type="password" name="password" id="password">
			{% if errors.first('password') %} {{errors.first('password')}} {% endif %}
		</div>
		<div class="form-group">
			<label for="password_confirm">Confirm new Password</label>
			<input class="form-control" type="password" name="password_confirm" id="password_confirm">
			{% if errors.first('password_confirm') %} {{errors.first('password_confirm')}} {% endif %}
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
	</div>
{% endblock %}