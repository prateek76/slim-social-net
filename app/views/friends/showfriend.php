{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername() }} {% endblock %}

{% block content %}
<div>
	{% if auth %}
  <!--<span style="font-size: 24px;">Hello, {{ auth.getFullNameOrUsername() }}</span>-->
  
  {% if not auth.friends()|length %}

  		<p>{{ auth.getFullNameOrUsername() }} has no friends</p>

  {% else %}
  <div class="list-group" style="width: 18%;
    float: left;
    margin: 24px 0;
    margin-left: 10px;
    position: relative;
    max-width: 400px;
    margin-left: 50px;
    margin-top: 20px;">
  <a href="#" class="list-group-item disabled" style="color: #fff;
    												  cursor: not-allowed;
    												  background-color: #337ab7;">
    {{ auth.getFullNameOrUsername() }} friend list
  </a>
  {% for friend in auth.friends() %} 
  <a href="{{ urlFor('user.profile', {username: friend.username}) }}" class="list-group-item">{{ friend.username }}&nbsp&nbsp<span style="color: gray;font-size: 13px">{{ friend.email }}</span></a>
  {% endfor %}
  </div>
  		
  		
  {% endif %}

<div class="friend-req-status" style="width: 18%;
    float: left;
    margin: 24px 0;
    margin-left: 45%;
    position: relative;">
  <!--<span style="font-size: 24px;">status</span><br><br>-->
  
  	{% for user in users %}
  	{% if user.hasFriendRequestPending(auth) %}
  		<div class="alert alert-warning" style="max-width: 600px;text-align: center;max-height: 100px">
  			<p>Waiting for {{ user.getFullNameOrUsername() }} to accept your request</p>
  		</div>
  	{% elseif user.hasFriendRequestRecieved(auth) %}
  		<a href="{{ urlFor('friend.accept', {'username' : user.username}) }}" class="btn btn-primary">Accept friend request from {{ user.username }}</a>
  	{% elseif user.isFriendWith(auth) %}
  		<div class="alert alert-success" style="max-width: 600px;text-align: center">
  			<p>you and {{ user.getFullNameOrUsername() }} are friends</p>
  		</div>
  	{% endif %}
  	{% endfor %}
  	

{% endif %} 
</div>
</div>
{% endblock %}