<div class="container">
    <h1><?php echo $post->post_title; ?></h1>
    <div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://www.gravatar.com/avatar/<?php echo md5($authors[$post->author]->email) ?>?s=80" alt="Coming soon">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $authors[$post->author]->userID; ?> <b>wrote</b> the following review  about <b><?php echo $post->book_title; ?></b> @ <?php echo $post->date_published; ?></h4>
            <?php echo $post->post; ?>


        <?php foreach ($comments as $comment):?>
            <?php
                if(($comment->author - 1) < 0) $offset = 0;
                else $offset = $comment->author;
            ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://www.gravatar.com/avatar/<?php echo md5($authors[$offset]->email) ?>?s=80" alt="Coming soon">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $authors[$offset]->userID; ?> <b>said</b> @ <?php echo $comment->date_published; ?></h4>
                    <?php echo $comment->comment; ?>
                </div>
            </div>
        <?php endforeach;?>

        </div>
    </div>

    <br>
    <?php if(($post->author == $id) || ($user_type === "admin")) { ?>
    <a href="http://sod73.asu.edu/~iferrei5/blog/index.php/post/edit/<?php echo $post->post_id; ?>" class="btn btn-warning"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
    <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-remove"></span> Delete
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Deleting a Post</h4>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <a href="http://sod73.asu.edu/~iferrei5/blog/index.php/post/delete/<?php echo $post->post_id; ?>" class="btn btn-danger">Yes!</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php } ?>
    <br><br>

    <form role="form" method="post" action="../../comment/index/<?php echo $post->post_id; ?>">
        <div class="form-group">
            <label for="Name">Your name</label>
            <input type="text" name="name" class="form-control" id="Name" <?php if(!$logged_in) { ?> value="guest"<?php } else { ?>value="<?php echo $user; } ?>" disabled>
        </div>
        <div class="form-group">
            <label for="Comment">Your comment</label>
            <textarea class="form-control" rows="4" name="comment" id="Comment"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <br><br><br>
</div>

</body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=476434379073571";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://sod73.asu.edu/~iferrei5/blog/dist/js/bootstrap.min.js"></script>

</html>