<h4 style="margin-bottom: 20px;">Add New Movie</h4>

<form method="POST" 
      action="<?php echo s3MVC_MakeLink("movie-listings/add"); ?>" 
      enctype="multipart/form-data"
>

<?php printErrorMsg('form-errors', $error_msgs); //print form level error message(s) if any ?>

    <div class="row" id="row-title">
        <div class="small-3 columns">
            <label for="title" class="middle text-right">
                Title<span style="color: red;"> *</span>
            </label>                
        </div>
         
        <?php $input_elems_error_css_class = (count($error_msgs['title']) > 0)? ' class="is-invalid-input" ' : ''; ?>
        
        <div class="small-7 columns end">
            <input type="text" 
                   name="title" 
                   id="title" 
                   maxlength="1500" 
                   required="required"
                   <?php echo $input_elems_error_css_class; ?>
                   value="<?php echo $movie_record->title; ?>"
            >
            <?php printErrorMsg('title', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-release_year">
        <div class="small-3 columns">
            <label for="release_year" class="middle text-right">
                Year of Release<span style="color: red;"> *</span>
            </label>                
        </div>
         
        <?php $input_elems_error_css_class = (count($error_msgs['release_year']) > 0)? ' class="is-invalid-input" ' : ''; ?>
        
        <div class="small-7 columns end">
            <input type="number"
                   name="release_year" 
                   id="release_year"
                   maxlength="4"
                   min="1"
                   required="required"
                   <?php echo $input_elems_error_css_class; ?>
                   value="<?php echo $movie_record->release_year; ?>"
            >
            <?php printErrorMsg('release_year', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-genre">
        <div class="small-3 columns">
            <label for="genre" class="middle text-right">
                Genre
            </label>                
        </div>
        
        <div class="small-7 columns end">
            <input type="text"
                   name="genre" 
                   id="genre" 
                   maxlength="255"
                   value="<?php echo $movie_record->genre; ?>"
            >
        </div>
    </div>
    
    <div class="row" id="row-duration_in_minutes">
        <div class="small-3 columns">
            <label for="duration_in_minutes" class="middle text-right">
                Duration in Minutes
            </label>                
        </div>
        
        <div class="small-7 columns end">
            <input type="number" 
                   name="duration_in_minutes" 
                   id="duration_in_minutes"
                   min="0"
                   value="<?php echo $movie_record->duration_in_minutes; ?>"
            >
        </div>
    </div>
    
    <div class="row" id="row-genre">
        <div class="small-3 columns">
            <label for="genre" class="middle text-right">
                MPAA Rating
            </label>                
        </div>
        
        <div class="small-7 columns end">
            
            <?php $selected = 'selected="selected"'; ?>
            
            <select name="mpaa_rating" id="mpaa_rating">
                
                <option value="">----None----</option>
                
                <option value="G" title="General Audiences" 
                        <?php echo ($movie_record->mpaa_rating === "G") ? $selected : '' ; ?> 
                >
                    G
                </option>
                
                <option value="NR" title="Not Rated"
                        <?php echo ($movie_record->mpaa_rating === "NR") ? $selected : '' ; ?> 
                >
                    NR
                </option>
                
                <option value="PG" title="Parental Guidance"
                        <?php echo ($movie_record->mpaa_rating === "PG") ? $selected : '' ; ?> 
                >
                    PG
                </option>
                
                <option value="PG-13" title="Parents Strongly Cautioned"
                        <?php echo ($movie_record->mpaa_rating === "PG-13") ? $selected : '' ; ?> 
                >
                    PG-13
                </option>
                
                <option value="R" title="Restricted"
                        <?php echo ($movie_record->mpaa_rating === "R") ? $selected : '' ; ?> 
                >
                    R
                </option>
                
            </select>
        </div>
    </div>

    <div class="row">
        <div class="small-3 small-centered columns">
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
    // When Cancel button is clicked, redirect to list all movies page
    $('#cancel-button').on(
        'click',
        function( event ) {
            // Do this so that when the Cancel button is clicked 
            // the browser does not try to submit the form
            event.preventDefault(); 
            window.location.href = '<?php echo s3MVC_MakeLink("/movie-listings/index"); ?>';
        }
    );
</script>

<?php
function printErrorMsg($element_name, array $error_msgs) {

    if( isset($error_msgs[$element_name]) ) {

        foreach($error_msgs[$element_name] as $err_msg) {

            //spit out error message for $element_name
            echo "<div class=\"alert callout\">{$err_msg}</div>";

        } //foreach($error_msgs[$element_name] as $err_msg)
    } //if( array_key_exists($element_name, $error_msgs) )
}
