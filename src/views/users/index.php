<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
?>
<h4>All Users</h4>

<?php if( $collection_of_user_records instanceof \MovieCatalog\Models\Collections\BaseCollection && count($collection_of_user_records) > 0 ): ?>

    <ul>
        <?php foreach ($collection_of_user_records as $user_record): ?>

            <li>
                <?php echo $user_record->username; ?> | 
                <a href="<?= $controller_object->makeLink( "users/view/" . $user_record->id ); ?>">View</a> 

                <?php if( $controller_object->isLoggedIn() ): ?>

                    | <a href="<?= $controller_object->makeLink( "users/edit/" . $user_record->id ); ?>">Edit</a> |
                    <a href="<?= $controller_object->makeLink( "users/delete/" . $user_record->id ); ?>"
                       onclick="return confirm('Are you sure?');"
                    >
                        Delete
                    </a>

                <?php endif; //if( $controller_object->isLoggedIn() )  ?>
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
        document.getElementById('initialize-button').addEventListener('click', function(event) {
            
            var entered_password = document.getElementById('initialize-password').value;

            if( entered_password === '' ) {
                alert('Password cannot be empty!');
                return false;
            }

            window.location.href = 
                '<?= $controller_object->makeLink("/users/init-users"); ?>' + '/' + entered_password;
        });
    </script>

<?php endif; ?>
