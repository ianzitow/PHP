<div class="container">
    <h1>Manager</h1>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Grant/Deny</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($users as $user) { ?>
            <?php if (($user->userID != "guest")&&($user->userID != "admin")) { ?>
                <tr <?php if ($user->access == "denied") echo "class=\"danger\""; else echo "class=\"success\""; ?>>
                    <td><?php echo $user->id ?></td>
                    <td><?php echo $user->userID ?></td>
                    <td><?php echo $user->firstname . " " . $user->lastname; ?></td>
                    <td><a href="http://sod73.asu.edu/~iferrei5/blog/index.php/manager/grant/<?php echo $user->id; ?>" class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span></a>
                        <a href="http://sod73.asu.edu/~iferrei5/blog/index.php/manager/deny/<?php echo $user->id; ?>" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
            <?php } ?>
        <?php } ?>

        </tbody>
    </table>



</body>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://sod73.asu.edu/~iferrei5/blog/dist/js/bootstrap.min.js"></script>

</html>