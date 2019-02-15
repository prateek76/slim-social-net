{% extends 'templates/default.php' %}

{% block title %} recovery {% endblock %}

{% block content %}
<div class="col-xs-2">
<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
		<div class="form-group">
			<label for="identifier">email</label>
			<input class="form-control" type="text" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
			{% if errors.first('email') %} {{errors.first('email')}} {% endif %}
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Get Link</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
</div>
{% endblock %}
