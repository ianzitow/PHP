<div class="container">
    <h1>Events</h1>

    <?php if(!empty($events)) { ?>
        <?php foreach ($events as $event) { ?>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><h3><?php echo $event->title; ?></h3></div>
                <div class="panel-body">
                    <p><?php echo $event->description; ?></p>
                </div>

                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><b>Posted by:</b> <?php echo $users[$event->userid]->userID; ?></li>
                    <li class="list-group-item"><b>Address:</b> <?php echo $event->address; ?></li>
                    <li class="list-group-item"><b>Date:</b> <?php echo $event->date; ?></li>
                </ul>
            </div>
        <?php } ?>
    <?php } else { ?>
        <h2>No events available!</h2>
    <?php } ?>

    <br><br>

    <?php if ($logged_in) { ?>
        <h3>Create one!</h3>
        <form role="form" action="http://sod73.asu.edu/~iferrei5/blog/index.php/events/submit" method="post">
            <div class="form-group">
                <label for="eventtitle">Title</label>
                <?php echo form_error('eventtitle'); ?>
                <input type="text" name="eventtitle" class="form-control" id="eventtitle" placeholder="The event title" value="<?php echo set_value('eventtitle'); ?>" size="100" />
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <?php echo form_error('date'); ?>
                <input type="text" name="date" class="form-control" id="date" placeholder="The event date" value="<?php echo set_value('date'); ?>">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <?php echo form_error('address'); ?>
                <input type="text" name="address" class="form-control" id="address" placeholder="The event address" value="<?php echo set_value('address'); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <?php echo form_error('description'); ?>
                <textarea name="description" class="form-control" rows="3" id="description" placeholder="Your description"><?php echo set_value('description'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    <?php } ?>

</body>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://sod73.asu.edu/~iferrei5/blog/dist/js/bootstrap.min.js"></script>

</html>