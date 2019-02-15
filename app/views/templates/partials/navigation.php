<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="{{ urlFor('home') }}">Los balancos</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ urlFor('home') }}">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ urlFor('users.all') }}">All Users</a></li>
        {% if auth %}
        <li><a href="{{ urlFor('friends.con') }}">friends</a></li>
        <li><a href="{{ urlFor('forum.post') }}">Timeline</a></li>
        {% else %}
        <li><a href="{{ urlFor('login') }}">login</a></li>
        <li><a href="{{ urlFor('register') }}">register</a></li>
        {% endif %}
        {% if auth %}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ auth.getAvatarUrl({size :23}) }}"> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Profile</a></li>
            <li><a href="{{ urlFor('account.profile') }}">Edit Profile</a></li>
            {% if auth.isAdmin() %}
            <li role="separator" class="divider"></li>
            <li><a href="{{ urlFor('admin.example') }}">AdminOnly</a></li>
            {% endif %}
            <li role="separator" class="divider"></li>
            <li><a href="{{ urlFor('password.change') }}">Settings</a></li>
            <li><a href="{{ urlFor('logout') }}">Logout</a></li>
          </ul>
        </li>
        {% endif %}
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>