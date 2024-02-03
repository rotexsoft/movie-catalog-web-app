<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
?>
<h4 style="margin-bottom: 20px;">Add New Movie</h4>

<form method="POST" 
      action="<?= $controller_object->makeLink("movie-listings/add"); ?>" 
      enctype="multipart/form-data"
>

<?php printErrorMsg('form-errors', $error_msgs); //print form level error message(s) if any ?>

    <div class="row" id="row-title">
        <div class="col s3 right-align">
            <label for="title" class="">
                Title<span style="color: red;"> *</span>
            </label>                
        </div>
        
        <div class="col s7">
            <input type="text" 
                   name="title" 
                   id="title" 
                   maxlength="1500" 
                   required="required"
                   value="<?= $movie_record->title; ?>"
            >
            <?php printErrorMsg('title', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-release_year">
        <div class="col s3 right-align">
            <label for="release_year" class="">
                Year of Release<span style="color: red;"> *</span>
            </label>                
        </div>
        
        <div class="col s7">
            <input type="number"
                   name="release_year" 
                   id="release_year"
                   maxlength="4"
                   min="1"
                   required="required"
                   value="<?= $movie_record->release_year; ?>"
            >
            <?php printErrorMsg('release_year', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-genre">
        <div class="col s3 right-align">
            <label for="genre" class="">
                Genre
            </label>                
        </div>
        
        <div class="col s7">
            <input type="text"
                   name="genre" 
                   id="genre" 
                   maxlength="255"
                   value="<?= $movie_record->genre; ?>"
            >
        </div>
    </div>
    
    <div class="row" id="row-duration_in_minutes">
        <div class="col s3 right-align">
            <label for="duration_in_minutes" class="">
                Duration in Minutes
            </label>                
        </div>
        
        <div class="col s7">
            <input type="number" 
                   name="duration_in_minutes" 
                   id="duration_in_minutes"
                   min="0"
                   value="<?= $movie_record->duration_in_minutes; ?>"
            >
        </div>
    </div>
    
    <div class="row" id="row-mpaa_rating">
        <div class="col s3 right-align">
            <label for="mpaa_rating" class="">
                MPAA Rating
            </label>                
        </div>
        
        <div class="col s7">
            
            <?php $selected = 'selected="selected"'; ?>
            
            <select name="mpaa_rating" id="mpaa_rating">
                
                <option value="">----None----</option>
                
                <option value="G" title="General Audiences" 
                        <?= ($movie_record->mpaa_rating === "G") ? $selected : '' ; ?> 
                >
                    G
                </option>
                
                <option value="NR" title="Not Rated"
                        <?= ($movie_record->mpaa_rating === "NR") ? $selected : '' ; ?> 
                >
                    NR
                </option>
                
                <option value="PG" title="Parental Guidance"
                        <?= ($movie_record->mpaa_rating === "PG") ? $selected : '' ; ?> 
                >
                    PG
                </option>
                
                <option value="PG-13" title="Parents Strongly Cautioned"
                        <?= ($movie_record->mpaa_rating === "PG-13") ? $selected : '' ; ?> 
                >
                    PG-13
                </option>
                
                <option value="R" title="Restricted"
                        <?= ($movie_record->mpaa_rating === "R") ? $selected : '' ; ?> 
                >
                    R
                </option>
                
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s3">
            <input type="submit" 
                   name="save-button" 
                   id="save-button" 
                   class="button" 
                   value="Save"
            >
            <input type="submit" 
                   name="cancel-button" 
                   id="cancel-button" 
                   class="button" 
                   value="Cancel"
            >
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});
    });
    
    // When Cancel button is clicked, redirect to list all users page
    document.getElementById('cancel-button').addEventListener('click', function(event) {

        // Do this so that when the Cancel button is clicked 
        // the browser does not try to submit the form
        event.preventDefault(); 
        window.location.href = '<?= $controller_object->makeLink("/movie-listings/index"); ?>';
    });
</script>

<?php
function printErrorMsg($element_name, array $error_msgs) {

    if( isset($error_msgs[$element_name]) ) {

        foreach($error_msgs[$element_name] as $err_msg) {

            //spit out error message for $element_name
            echo "<div style=\"padding: 0.5em;\" class=\"card red\">{$err_msg}</div>";

        } //foreach($error_msgs[$element_name] as $err_msg)
    } //if( array_key_exists($element_name, $error_msgs) )
}
