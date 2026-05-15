<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
?>
<h4>View User</h4>
<ul class="collection">
    <li class="collection-item">
        <strong>Username:</strong> 
        <?= $user_record->username; ?>
    </li>
    <li class="collection-item">
        <strong>Date Created:</strong> 
        <?= $user_record->getDateCreated(); ?>
    </li>
    <li class="collection-item">
        <strong>Date Last Modified:</strong> 
        <?= $user_record->getLastModfiedDate(); ?>
    </li>
</ul>
<p>
    <a href="<?= $controller_object->makeLink( "users/index" ); ?>">View all Users</a>
    <?php if( $controller_object->isLoggedIn() ): ?>

        | <a href="<?= $controller_object->makeLink( "users/edit/" . $user_record->id ); ?>">Edit</a>
        | <a href="<?= $controller_object->makeLink( "users/delete/" . $user_record->id ); ?>">Delete</a>

    <?php endif; //if( isset($is_logged_in) && $is_logged_in )  ?>
</p>
