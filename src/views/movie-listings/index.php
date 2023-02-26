<?php if( isset($is_logged_in) && $is_logged_in ): ?>

    <div class="row" style="margin-top: 1em;">
        <div class="small-6 columns">
            <h4>All Movies</h4>
        </div>
        <div class="small-6 columns text-right">
            <a class="button" href="<?php echo s3MVC_MakeLink( "movie-listings/index?format=json" ); ?>">
                <strong>Get Listings in JSON Format</strong>
            </a>
            <a class="button" href="<?php echo s3MVC_MakeLink( "movie-listings/add" ); ?>">
                <strong>+ Add new Movie Listing</strong>
            </a>
        </div>
    </div>

<?php endif; ?>

<?php if( $collection_of_movie_records instanceof \BaseCollection && count($collection_of_movie_records) > 0 ): ?>

    <ul>
    <?php foreach ($collection_of_movie_records as $movie_record): ?>

        <li>
            <?php echo $movie_record->title; ?> | 
            <a href="<?php echo s3MVC_MakeLink( "movie-listings/view/" . $movie_record->id ); ?>">View</a> 

            <?php if( isset($is_logged_in) && $is_logged_in ): ?>

                | <a href="<?php echo s3MVC_MakeLink( "movie-listings/edit/" . $movie_record->id ); ?>">Edit</a> |
                <a href="<?php echo s3MVC_MakeLink( "movie-listings/delete/" . $movie_record->id ); ?>"
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
    No Movies yet. Please <a href="<?php echo s3MVC_MakeLink( "movie-listings/add" ); ?>">Add</a> 
    one or more movie listing(s).
</p>

<?php endif; ?>
