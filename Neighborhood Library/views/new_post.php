<div class="container">
    <h1>New post</h1>

    <form role="form" action="http://sod73.asu.edu/~iferrei5/blog/index.php/post/submit" method="post">
        <div class="form-group">
            <label for="booktitle">Book Title</label>
            <?php echo form_error('booktitle'); ?>
            <input type="text" name="booktitle" class="form-control" id="booktitle" placeholder="The book title" value="<?php echo set_value('booktitle'); ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="posttitle">Post Title</label>
            <?php echo form_error('posttitle'); ?>
            <input type="text" name="posttitle" class="form-control" id="posttitle" placeholder="The post title" value="<?php echo set_value('posttitle'); ?>">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category">
                <?php foreach($categories as $category) { ?>
                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="userpost">Your post</label>
            <?php echo form_error('userpost'); ?>
            <textarea name="userpost" class="form-control" rows="3" id="userpost" placeholder="Your post"><?php echo set_value('userpost'); ?></textarea>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>

</body>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://sod73.asu.edu/~iferrei5/blog/dist/js/bootstrap.min.js"></script>

</html>