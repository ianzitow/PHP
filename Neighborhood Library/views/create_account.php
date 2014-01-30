<div class="container">
    <h1>Open your account!</h1>

    <form role="form" action="http://sod73.asu.edu/~iferrei5/blog/index.php/create/submit" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <?php echo form_error('firstname'); ?>
            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Your first name" value="<?php echo set_value('firstname'); ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <?php echo form_error('lastname'); ?>
            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Your last name" value="<?php echo set_value('lastname'); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <?php echo form_error('email'); ?>
            <input type="text" name="email" class="form-control" id="email" placeholder="Your email" value="<?php echo set_value('email'); ?>">
        </div>
        <div class="form-group">
            <label for="userid">User ID</label>
            <?php echo form_error('userid'); ?>
            <input type="text" name="userid" class="form-control" id="userid" placeholder="Your User ID" value="<?php echo set_value('userid'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <?php echo form_error('password'); ?>
            <input type="password" name="password" class="form-control" id="password" placeholder="Your password">
        </div>


        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>

</body>
</html>