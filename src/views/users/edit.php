<h4 style="margin-bottom: 20px;">Edit User</h4>

<form method="POST" 
      action="<?php echo s3MVC_MakeLink("users/edit/{$user_record->id}"); ?>" 
      enctype="multipart/form-data"
>

<?php printErrorMsg('form-errors', $error_msgs); //print form level error message(s) if any ?>

    <div class="row" id="row-username">
        
        <div class="small-3 columns">
            <label for="username" class="middle text-right">
                Username<span style="color: red;"> *</span>
            </label>                
        </div>
         
        <?php $input_elems_error_css_class = (count($error_msgs['username']) > 0)? ' class="is-invalid-input" ' : ''; ?>
        
        <div class="small-7 columns end">
            <input type="text" 
                   name="username" 
                   id="username" 
                   maxlength="255" 
                   required="required"
                   <?php echo $input_elems_error_css_class; ?>
                   value="<?php echo $user_record->username; ?>"
            >
            <?php printErrorMsg('username', $error_msgs); //print error message(s) if any ?>
        </div>
    </div>
    
    <div class="row" id="row-password">
        
        <div class="small-3 columns">
            <label for="password" class="middle text-right">
                Password<span style="color: red;"> *</span>
            </label>                
        </div>
         
        <?php $input_elems_error_css_class = (count($error_msgs['password']) > 0)? ' class="is-invalid-input" ' : ''; ?>
        
        <div class="small-7 columns end">
            <input type="password" 
                   name="password" 
                   id="password" 
                   maxlength="255" 
                   required="required"
                   <?php echo $input_elems_error_css_class; ?>
                   value="<?php echo $user_record->password; ?>"
            >
            <?php printErrorMsg('password', $error_msgs); //print error message(s) if any ?>
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
    // When Cancel button is clicked, redirect to list all users page
    $('#cancel-button').on(
        'click',
        function( event ) {
            // Do this so that when the Cancel button is clicked 
            // the browser does not try to submit the form
            event.preventDefault(); 
            window.location.href = '<?php echo s3MVC_MakeLink("/users/index"); ?>';
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
