<div>
<nav class="nav_header_elem_001">
<ul class="guest_002_parent">
  <a style="color: inherit;" href="{{ urlFor('home') }}"><li class="guest_002" style="font-size: 20px;font-family: arial">Home</li></a>
  <a style="color: inherit;" href="{{ urlFor('users.all') }}"><li class="guest_002" style="font-size: 20px;font-family: arial">All Users</li></a>
</ul>

  {% if auth %}
<ul class="auth_002_parent">
    <span style="margin-top: -10px;"><img class="user_avatar_002" src="{{ auth.getAvatarUrl({size :35}) }}" alt="Your Avatar"></span>
    <a style="color: inherit;" href="{{ urlFor('user.profile', {username: auth.username}) }}"><li class="auth_002" style="font-size: 20px;color:inherit;font-family: arial">Your profile</li></a>
    <a style="color: inherit;" href="{{ urlFor('account.profile') }}"><li class="auth_002" style="font-size: 20px;color:inherit;font-family: arial">Edit Profile</li></a>

    {% if auth.isAdmin() %}
      <a style="color: inherit;" href="{{ urlFor('admin.example') }}"><li class="auth_002" style="font-size: 20px;font-family: arial">AdminOnly</li></a>

    {% endif %}
    <a style="color: inherit;" href="{{ urlFor('logout') }}"><li class="auth_002" style="font-size: 20px;font-family: arial">Logout</li></a>
</ul>
  {% else %}
<ul class="guest_003_parent">
  <!--we dont want to show register and logini to all the users ??-->
  <!--So WE will append data to view-->
  <a style="color: inherit;" href="{{ urlFor('login') }}"><li class="guest_002" style="font-size: 20px;font-family: arial">Login</li></a>
  <a style="color: inherit;" href="{{ urlFor('register') }}"><li class="guest_002" style="font-size: 20px;font-family: arial">register</li></a>
  </ul>
  {% endif %}

</nav>
</div>
{% if auth %}
  <span style="font-size: 20px;font-family: arial">Hello, {{ auth.getFullNameOrUsername() }}</span><!--after this point update the user model in user.php to print first name and last name on loggin page-->
  <!--not showing profile pic here-->
  <br>
  <a href="{{ urlFor('password.change') }}"><span>Change Password</span></a>
{% endif %}

<br><br>


