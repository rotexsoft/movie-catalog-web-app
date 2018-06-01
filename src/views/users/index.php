<h4>All Users</h4>

<?php if( $collection_of_user_records instanceof \BaseCollection && count($collection_of_user_records) > 0 ): ?>

<ul>
    <?php foreach ($collection_of_user_records as $user_record): ?>
            
        <li>
            <?php echo $user_record->username; ?> | 
            <a href="<?php echo s3MVC_MakeLink( "users/view/" . $user_record->id ); ?>">View</a> 
            
            <?php if( isset($is_logged_in) && $is_logged_in ): ?>
            
                | <a href="<?php echo s3MVC_MakeLink( "users/edit/" . $user_record->id ); ?>">Edit</a> |
                <a href="<?php echo s3MVC_MakeLink( "users/delete/" . $user_record->id ); ?>"
                   onclick="return confirm('Are you sure?');"
                >
                    Delete
                </a>
                
            <?php endif; //if( isset($is_logged_in) && $is_logged_in )  ?>
        </li>
    
    <?php endforeach; ?>
</ul>

<?php else: ?>

<p>
    No user(s) exist. <br>
    Initialize the system with an <strong>admin</strong> user with a password of: 
    <input id="initialize-password" type="password" style="width: 25%; display:inline;">.
    <input id="initialize-button" type="submit" value="Initialize">
</p>

<script>
    // When the Initialize button is clicked, redirect to 
    // /users/init-users/<entered_password>, where <entered_password> 
    // is the value entered into the password text-box
    $('#initialize-button').on(
        'click',
        function( event ) {
            
            var entered_password = $('#initialize-password').val();
            
            if( entered_password === '' ) {
                
                alert('Password cannot be empty!');
                return false;
            }
            
            window.location.href = 
                '<?php echo s3MVC_MakeLink("/users/init-users"); ?>' 
                + '/' + entered_password;
        }
    );
</script>

<?php endif; ?>
