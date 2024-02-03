<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
    use \MovieCatalog\Models\Collections\BaseCollection;
?>
<?php if( $controller_object->isLoggedIn() ): ?>

    <div class="row" style="margin-top: 1em;">
        <div class="col s6">
            <h4>All Movies</h4>
        </div>
        <div class="col s6  right-align">
            <a class="btn" href="<?php echo $controller_object->makeLink( "movie-listings/add" ); ?>">
                <strong>+ Add new Movie Listing</strong>
            </a>
        </div>
    </div>

<?php endif; ?>

<?php if( $collection_of_movie_records instanceof BaseCollection && count($collection_of_movie_records) > 0 ): ?>

    <ul>
    <?php foreach ($collection_of_movie_records as $movie_record): ?>

        <li>
            <?php echo $movie_record->title; ?> | 
            <a href="<?php echo $controller_object->makeLink( "movie-listings/view/" . $movie_record->id ); ?>">View</a> 

            <?php if( $controller_object->isLoggedIn() ): ?>

                | <a href="<?php echo $controller_object->makeLink( "movie-listings/edit/" . $movie_record->id ); ?>">Edit</a> |
                <a href="<?php echo $controller_object->makeLink( "movie-listings/delete/" . $movie_record->id ); ?>"
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
    No Movies yet. Please <a href="<?php echo $controller_object->makeLink( "movie-listings/add" ); ?>">Add</a> 
    one or more movie listing(s).
</p>

<?php endif; ?>
