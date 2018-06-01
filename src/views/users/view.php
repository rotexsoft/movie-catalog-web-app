<h4>View User</h4>
<ul style="list-style: none;">
    <li>
        <strong>Username:</strong> 
        <?php echo $user_record->username; ?>
    </li>
    <li>
        <strong>Date Created:</strong> 
        <?php echo $user_record->getDateCreated(); ?>
    </li>
    <li>
        <strong>Date Last Modified:</strong> 
        <?php echo $user_record->getLastModfiedDate(); ?>
    </li>
</dl>
<p>
    <a href="<?php echo s3MVC_MakeLink( "users/index" ); ?>">View all Users</a>
    <?php if( isset($is_logged_in) && $is_logged_in ): ?>

        | <a href="<?php echo s3MVC_MakeLink( "users/edit/" . $user_record->id ); ?>">Edit</a> |
        <a href="<?php echo s3MVC_MakeLink( "users/delete/" . $user_record->id ); ?>">Delete</a>

    <?php endif; //if( isset($is_logged_in) && $is_logged_in )  ?>
</p>
