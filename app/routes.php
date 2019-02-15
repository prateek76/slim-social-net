<?php

require INC_ROOT . '/app/routes/home.php';

//initial routes
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';

//profile routes
require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';

//admin routes
require INC_ROOT . '/app/routes/admin/example.php';

//error routes
require INC_ROOT . '/app/routes/errors/404.php';

//passwordchange&recover route
require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';

//edit profile routes
require INC_ROOT . '/app/routes/account/profile.php';

//forum routes and comment routes
require INC_ROOT . '/app/routes/forum/forum.php';
require INC_ROOT . '/app/routes/forum/comment.php';

//friends routes
require INC_ROOT . '/app/routes/friends/addfriends.php';
require INC_ROOT . '/app/routes/friends/acceptfriends.php';
require INC_ROOT . '/app/routes/friends/showfriend.php';