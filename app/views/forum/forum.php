{% extends 'templates/default.php' %}

{% block title %} forum {% endblock %}

{% block content %}
	{% if auth %}
	<form action="{{ urlFor('post.post') }}" method="post">
	<div class="form-group" style="width: 500px;margin: 0 auto;">
		<textarea style="resize: none;" rows="5" cols="5" class="form-control" name="post"></textarea>
		<div class="form-group">
			<br>
			<button
			style="color: black;
				   background-color: #e6e6e6a1;
				   background-image: none;
				   border-color: #007bff;
				   outline: none;" 
			type="submit" class="btn btn-success btn-lg btn-block">post</button>
		</div>

		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</div>
	</form>
	{% endif %}
	{% for post in posts|reverse %}
	<div class="post_parent">
		<div class="post_head">post by <span style="color: #000">{{ auth.username }}</span><span style="font-size: 11px;
    												 color: #312121;"> {{ post.created_at|date }}</span></div>
		<div style="max-height: 400px;
    				overflow-y: auto;
    				padding: inherit;
    				font-weight: 600" class="post_post">{{ post.post }}</div>
		<div style="min-height: 60px;background-color: gray;
				    background-color: gray;
				    padding-top: 5px;
				    padding-left: 5px;
				    padding-right: 5px;
				    padding-bottom: 5px" class="post_comment">
			<div style="height: 30px;padding: 10px;padding-bottom: 27px;background-color: #a7d6ff7a"><span>{{ random(200) }} likes</span>&nbsp<a href="{{ urlFor('forum.post') }}"><span class="glyphicon glyphicon-thumbs-up"></span></a>&nbsp<a href="#"><span class="glyphicon glyphicon-thumbs-down"></span></a></div><br>
			<div style="height: 40px;background-color: #fff;border-radius: 50px;">
				<form action="{{ urlFor('comment.post') }}" method="post">
					<textarea style="   width: 75%;
									    border-radius: 50px 0 0 50px;
									    background: #f3f3f3;
									    outline: none;
									    padding: 5px;
									    max-height: 40px;
									    resize: none;" name="comment" class="comm-here" placeholder="write your comment here ..."></textarea>
					<span><button style="	position: absolute;
										    border-radius: 0px 50px 53px 0px;
										    width: 117px;
										    height: 41px;" class="btn btn-primary" type="submit"><span style="font-size: 25px" class="glyphicon glyphicon-send"></span></button></span>
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
					<input type="hidden" name="testid" value="{{ post.post_id }}">
				</form>
			</div>
		</div>
		
		<div style="background: #0000001a;
    				padding: inherit;padding-bottom: 0px" class="show_comments">
    				<div>comments</div>
    				<br>
			{% for comment in comments|reverse %}
			{% if comment.parent_id == post.post_id %}
			<div style="background: #fff;
					    border-radius: 50px;
					    padding: 20px;
    					word-wrap: break-word;" class="comment"><span><a href="{{ urlFor('user.profile', {username: post.post_username}) }}">{{ comment.post_username }} </a></span><span>{{ comment.post }}</span><span style="font-size: 11px;
    						   color: grey;"> {{ comment.created_at|date }}</span></div>
					    <br>
			{% endif %}
			{% endfor %}
		</div>
	</div>
	{% endfor %}

{% endblock %}