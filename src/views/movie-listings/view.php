<h4>View Movie</h4>
<ul style="list-style: none;">
    <li>
        <strong>Title:</strong> 
        <?php echo $movie_record->title; ?>
    </li>
    <li>
        <strong>Year of Release:</strong> 
        <?php echo $movie_record->release_year; ?>
    </li>
    <li>
        <strong>Genre:</strong> 
        <?php echo $movie_record->genre; ?>
    </li>
    <li>
        <strong>Duration in Minutes:</strong> 
        <?php echo $movie_record->duration_in_minutes; ?>
    </li>
    <li>
        <strong>MPAA Rating:</strong> 
        <?php echo $movie_record->mpaa_rating; ?>
    </li>
    <li>
        <strong>Date Created:</strong> 
        <?php echo $movie_record->getDateCreated(); ?>
    </li>
    <li>
        <strong>Date Last Modified:</strong> 
        <?php echo $movie_record->getLastModfiedDate(); ?>
    </li>
</dl>
<p>
    <a href="<?php echo s3MVC_MakeLink( "movie-listings/index" ); ?>">View all Movies</a>
    <?php if( isset($is_logged_in) && $is_logged_in ): ?>

        | <a href="<?php echo s3MVC_MakeLink( "movie-listings/edit/" . $movie_record->id ); ?>">Edit</a> |
        <a href="<?php echo s3MVC_MakeLink( "movie-listings/delete/" . $movie_record->id ); ?>">Delete</a>

    <?php endif; //if( isset($is_logged_in) && $is_logged_in )  ?>
</p>
