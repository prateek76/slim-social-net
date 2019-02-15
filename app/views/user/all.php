{% extends 'templates/default.php' %}

{% block title %} Users {% endblock %}

{% block content %}
	
	<h2 style="text-align: center;">Users</h2>
	{% if users is empty %}
		<p>No users</p>
	{% else %}
	<div class="container" style="overflow-x:auto;">
	<table class="table table-striped table-hover">
	<thead class="thead-dark">
	<tr>
	<th scope="col">RNO</th>
	<th scope="col">Avatar</th>
	<th scope="col">username</th>
	<th scope="col">Full Name</th>
	<th scope="col">Email</th>
    </tr>
	</thead>

		{% for user in users %}<!--syntax line angular-->
		<tr>
			<td scope="row">{{ user.id }}</td>
			<td><img src="{{ user.getAvatarUrl({size :35}) }}" alt="Your Avatar"></td>
			<td><a href="{{ urlFor('user.profile', {username: user.username}) }}">
				{{ user.username }}
				{% if user.isAdmin() %}
					(Admin)
				{% endif %}
			</a></td>
			<td>
				{% if user.getFullName() %}
					{{ user.getFullName() }}
				{% else %}
					n/a
				{% endif %}
			</td>
			<td>{{ user.email }}</td>
		</tr>
		{% endfor %}
		</table>
	</div>
	{% endif %}

{% endblock %}