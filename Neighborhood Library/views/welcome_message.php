<div class="container">
	<h1>Welcome!</h1>

    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> <b>Be careful!</b> This is a beta system!</div>

    <ul class="nav nav-tabs">
    <?php foreach ($categories as $category):?>
        <li <?php if ($type == $category->id) { ?>class="active"<?php } ?>><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome/index/<?php echo $category->id; ?>"><span class="glyphicon glyphicon-<?php echo $category->icon; ?>"></span> <?php echo $category->name; ?></a></li>
    <?php endforeach;?>
    </ul>

    <?php foreach ($posts as $post):?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://www.gravatar.com/avatar/<?php echo md5($authors[$post->author]->email) ?>?s=80" alt="Coming soon">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $authors[$post->author]->userID; ?></h4> reviewed <b><?php echo $post->book_title; ?></b> in <b><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/read/index/<?php echo $post->post_id; ?>"><?php echo $post->post_title; ?></a></b> @ <?php echo $post->date_published; ?>
                <h5><?php echo $post->post; ?></h5>
            </div>
        </div>
    <?php endforeach;?>

    <ul class="pagination">
        <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome/index/<?php echo $type; ?>/0">&laquo;</a></li>
        <?php for ($i = 0; $i < $pages; $i++): ?>
        <li <?php if($i == $cur_page) echo "class=\"active\""; ?>><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome/index/<?php echo $type; ?>/<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
        <?php endfor; ?>
        <li><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/welcome/index/<?php echo $type; ?>/<?php echo $pages - 1; ?>">&raquo;</a></li>
    </ul>

    <br>
    <?php if ($logged_in) { ?> <a href="http://sod73.asu.edu/~iferrei5/blog/index.php/post" class="btn btn-primary"> <span class="glyphicon glyphicon-pencil"></span> New post</a><?php } ?>
    <br><br><br>
</div>

</body>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://sod73.asu.edu/~iferrei5/blog/dist/js/bootstrap.min.js"></script>

</html>