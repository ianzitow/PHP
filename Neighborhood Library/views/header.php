<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Neighborhood Community Book Club</title>

    <!-- Bootstrap core CSS -->
    <link href="http://sod73.asu.edu/~iferrei5/blog/dist/css/bootstrap.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome" style="height: 50px;"><span class="glyphicon glyphicon-book"></span> Neighborhood Community Book Club</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome">Home</a></li>
            <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/events"><span class="glyphicon glyphicon-calendar"></span> Events</a></li>
            <?php if($user_type === "admin") { ?>
                <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/manager"><span class="glyphicon glyphicon-cog"></span> Manage Users</a></li>
            <?php } ?>
            <?php if (!$logged_in) { ?><li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/create"><span class="glyphicon glyphicon-asterisk"></span> Create Account</a></li><?php } ?>
        </ul>
        <?php if (!$logged_in) { ?>
            <form class="navbar-form navbar-right" action="http://sod73.asu.edu/~iferrei5/blog/index.php/login" method="post">
                <div class="form-group">
                    <input placeholder="User ID" name="userid" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <input placeholder="Password" name="password" class="form-control" type="password">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        <?php } else { ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Hello, <?php echo $user; ?>! <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/post">New Post</a></li>
                        <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/events">New Event</a></li>
                        <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        <?php } ?>

    </div><!-- /.navbar-collapse -->
</nav>