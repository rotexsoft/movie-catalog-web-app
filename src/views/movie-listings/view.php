<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
?>
<h4>View Movie</h4>
<ul class="collection">
    <li class="collection-item">
        <strong>Title:</strong> 
        <?= $movie_record->title; ?>
    </li>
    <li class="collection-item">
        <strong>Year of Release:</strong> 
        <?= $movie_record->release_year; ?>
    </li>
    <li class="collection-item">
        <strong>Genre:</strong> 
        <?= $movie_record->genre; ?>
    </li>
    <li class="collection-item">
        <strong>Duration in Minutes:</strong> 
        <?= $movie_record->duration_in_minutes; ?>
    </li>
    <li class="collection-item">
        <strong>MPAA Rating:</strong> 
        <?= $movie_record->mpaa_rating; ?>
    </li>
    <li class="collection-item">
        <strong>Date Created:</strong> 
        <?= $movie_record->getDateCreated(); ?>
    </li>
    <li class="collection-item">
        <strong>Date Last Modified:</strong> 
        <?= $movie_record->getLastModfiedDate(); ?>
    </li>
</ul>
<p>
    <a href="<?= $controller_object->makeLink( "movie-listings/index" ); ?>">View all Movies</a>
    
    <?php if( $controller_object->isLoggedIn() ): ?>

        | <a href="<?= $controller_object->makeLink( "movie-listings/edit/" . $movie_record->id ); ?>">Edit</a> 
        | <a href="<?= $controller_object->makeLink( "movie-listings/delete/" . $movie_record->id ); ?>">Delete</a>

    <?php endif;  ?>
</p>
