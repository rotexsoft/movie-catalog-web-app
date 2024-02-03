<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
?>
<h4 style="margin-bottom: 20px;">Add New User</h4>

<form method="POST" 
      action="<?= $controller_object->makeLink("users/add"); ?>" 
      enctype="multipart/form-data"
>

<?php printErrorMsg('form-errors', $error_msgs); //print form level error message(s) if any ?>

    <div class="row" id="row-username">
        
        <div class="col s3 right-align">
            <label for="username" class="">
                Username<span style="color: red;"> *</span>
            </label>                
        </div>
         
        <?php $input_elems_error_css_class = (count($error_msgs['username']) > 0)? ' class="is-invalid-input" ' : ''; ?>
        
        <div class="col s7">
            <input type="text" 
                   name="username" 
                   id="username" 
                   maxlength="255" 
                   required="required"
                   <?= $input_elems_error_css_class; ?>
                   value="<?= $user_record->username; ?>"
            >
            <?php printErrorMsg('username', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-password">
        
        <div class="col s3 right-align">
            <label for="password" class="">
                Password<span style="color: red;"> *</span>
            </label>                
        </div>
        
        <div class="col s7">
            <input type="password" 
                   name="password" 
                   id="password" 
                   maxlength="255" 
                   required="required"
                   value="<?= $user_record->password; ?>"
            >
            <?php printErrorMsg('password', $error_msgs); //print error message(s) if any ?>
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
    // When Cancel button is clicked, redirect to list all users page
    document.getElementById('cancel-button').addEventListener('click', function(event) {

        // Do this so that when the Cancel button is clicked 
        // the browser does not try to submit the form
        event.preventDefault(); 
        window.location.href = '<?= $controller_object->makeLink("/users/index"); ?>';
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
