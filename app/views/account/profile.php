{% extends 'templates/default.php' %}

{% block title %} Update profile {% endblock %}

{% block content %}
<div class="col-xs-2">
<form action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
	<div class="form-group">
		<label for="email">Email</label>
		<input class="form-control" type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : auth.email }}"><?php//we are either going to output users email or the email they posted?>
		{% if errors.has('email') %}{{ errors.first('email') }}{% endif %}
	</div>
	<div class="form-group">
		<label for="first_name">First name</label>
		<input class="form-control" type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
		{% if errors.has('first_name') %}{{ errors.first('first_name') }}{% endif %}
	</div>
	<div class="form-group">
		<label for="last_name">Last name</label>
		<input class="form-control" type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
		{% if errors.has('last_name') %}{{ errors.first('last_name') }}{% endif %}
	</div>
	<div class="form-group">
			<button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
		</div>
	
	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
</form>
</div>
{% endblock %}