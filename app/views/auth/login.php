{% extends 'templates/default.php' %}

{% block title %} Login {% endblock %}

{% block content %}
	<div class="" style="float: right;margin-right: 100px;margin-top: 100px;">
	<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
		<div style="position: relative;" class="form-group">
			<label style="position: absolute;
						  top: 0;
						  transform: translateY(-50%);
						  left: 10px;
						  background: white;
  						  padding: 5px 2px;" for="identifier">Username/email</label>
			<input style="padding: 10px 20px;
						  font-size: 14px;
						  outline: 0;height: 50px;" class="form-control" type="text" name="identifier" id="identifier">
			{% if errors.first('identifier') %} {{errors.first('identifier')}} {% endif %}
		</div>
		<br>
		<div style="position: relative;" class="form-group">
			<label style="position: absolute;
						  top: 0;
						  transform: translateY(-50%);
						  left: 10px;
						  background: white;
  						  padding: 5px 2px;" for="password">Password</label>
			<input style="padding: 10px 20px;
						  font-size: 18px;
						  outline: 0;height: 40px;" class="form-control" type="password" name="password" id="password">
			{% if errors.first('password') %} {{errors.first('password')}} {% endif %}
		</div>
		<div class="checkbox">
			<label for="remember"><input type="checkbox" name="remember" id="remember">Remember me</label>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
		<div>
			<a href="{{ urlFor('password.recover') }}" style="font-size: 18px;">forgot password?</a>
		</div>
	</div>
{% endblock %}