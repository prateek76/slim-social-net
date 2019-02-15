{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername() }} {% endblock %}

{% block content %}

	<div style="width: 50%;margin-left: 6px;" class="row profile-card1">
  <div class="col-sm-6 col-md-4">
    <div style="background: #f4f2f2;
    box-shadow: 0 0 1px black;" class="thumbnail">
      <img src="{{ user.getAvatarUrl({size: 100}) }}" alt="Profile picture for {{ user.username }}">
      <div class="caption">
        {% if user.getFullName() %}
        <h3 style="text-align: center;">{{ user.getFullName() }}</h3>
        {% endif %}
        <p style="text-align: center;">{{user.email}}</p>
        {% if auth %}
        {% if (not user.isFriendWith(auth)) and  (not user.hasFriendRequestPending(auth)) and (user.id != auth.id) %}
        <p style="text-align: center;"><a href="{{ urlFor('addfriends', {'username' : user.username}) }}" class="btn btn-primary" role="button">Add as friend</a> <a href="#" class="btn btn-default" role="button">send message</a></p>
        {% endif %}
        {% endif %}
      </div>
    </div>
  </div>
</div>

{% endblock %}