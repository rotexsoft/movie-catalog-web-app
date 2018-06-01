<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Da Numba 1 Movie Catalog App</title>
        <link rel="stylesheet" href="<?php echo s3MVC_MakeLink('/css/foundation/foundation.css'); ?>" />
        <script src="<?php echo s3MVC_MakeLink('/js/foundation/vendor/jquery.js'); ?>"></script>
        
        <style>
            /* style for menu items */
            ul.menu li.active-link,
            ul.menu li.active-link a{
                color: #2e8acd;
            }
            ul.menu li.active-link{
                background-color: orange;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text">Da Numba 1 Movie Catalog App</li>
                        <li <?php isset($controller_name_from_uri) && makeMenuItemActive('movie-listings', $controller_name_from_uri); ?> >
                            <a href="<?php echo s3MVC_MakeLink("movie-listings"); ?>">
                                Home
                            </a>
                        </li>
                        <li <?php isset($controller_name_from_uri) && makeMenuItemActive('users', $controller_name_from_uri); ?> >
                            <a href="<?php echo s3MVC_MakeLink("users"); ?>">Manage Users</a>
                            
                            <?php if( isset($is_logged_in) && $is_logged_in ): ?>
                                <ul class="menu vertical">
                                    <li><a href="<?php echo s3MVC_MakeLink("users/add"); ?>">Add New User</a></li>
                                </ul>
                            <?php endif; // if( isset($is_logged_in) && $is_logged_in ) ?>
                            
                        </li>
                    </ul> <!-- <ul class="dropdown menu" data-dropdown-menu> -->
                </div> <!-- <div class="top-bar-left"> -->

                <div class="top-bar-right">
                    <ul class="menu">
                        <li><input type="search" placeholder="Search"></li>
                        <li><button type="button" class="button">Search</button></li>
                        <li>&nbsp;</li>
                        <li>
                            <?php
                                if( !isset($controller_name_from_uri) ) {

                                    $controller_name_from_uri = 'movie-listings';
                                }

                                $login_action_path = s3MVC_MakeLink("/{$controller_name_from_uri}/login");
                                $logout_action_path = s3MVC_MakeLink("/{$controller_name_from_uri}/logout");
                            ?>
                            <?php if( isset($is_logged_in) && $is_logged_in ): ?>

                                <a class="button" href="<?php echo $logout_action_path; ?>">
                                    <strong>Log Out</strong>
                                </a>

                            <?php else: ?>

                                <a class="button" href="<?php echo $login_action_path; ?>">
                                    <strong>Log in</strong>
                                </a>

                            <?php endif; ?>
                        </li>
                    </ul> <!-- <ul class="menu"> -->
                </div> <!-- <div class="top-bar-right"> -->
            </div> <!-- <div class="top-bar"> -->
        </div> <!-- <div class="row"> -->

        <?php if( isset($last_flash_message) && $last_flash_message !== null  ): ?>

            <?php $last_flash_message_css_class = isset($last_flash_message_css_class)? $last_flash_message_css_class : ''; ?>

            <div class="row" style="margin-top: 1em;">
                <div class="callout <?php echo $last_flash_message_css_class; echo is_array($last_flash_message)? '' : ' text-center'; ?>"  data-closable>
                    <button class="close-button" data-close>&times;</button>
                    <p>
                        <?php if( is_array($last_flash_message) ): ?>
                            
                            <ul>
                            <?php foreach($last_flash_message as $curr_flash_msg): ?>
                        
                                <li><?php echo $curr_flash_msg; ?></li>
                        
                            <?php endforeach; // foreach($last_flash_message as $curr_flash_msg): ?>
                            </ul>
                        <?php else: ?>
                            <?php echo $last_flash_message; ?>
                        <?php endif; // if( is_array($last_flash_message) ): ?>
                    </p>
                </div> <!-- <div class="callout <?php echo $last_flash_message_css_class; echo is_array($last_flash_message)? '' : ' text-center'; ?>"  data-closable> -->
            </div> <!-- <div class="row" style="margin-top: 1em;"> -->

        <?php endif; //if( $last_flash_message !== null )?>

        <div class="row" style="margin-top: 1em;">
            <div class="small-12 columns">
                <?php if( isset($is_logged_in) && $is_logged_in ): ?>

                    <strong style="color: #7f8fa4;">
                        Logged in as <?php echo isset($logged_in_users_username) ? $logged_in_users_username : ''; ?>
                    </strong>

                <?php endif; ?>
            </div>
        </div>

        <div class="row" style="margin-top: 1em;">
            <div class="small-12 columns">
                <?php echo $content; ?>
            </div>
        </div>

        <footer class="row">
            <div class="small-12 columns">
                <hr/>
                <div class="row">
                    <div class="small-6 columns">
                        <p>Copyright &copy; <?php echo date('Y'); ?>. Da Numba 1 Movie Catalog App.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="<?php echo s3MVC_MakeLink('/js/foundation/vendor/what-input.js'); ?>"></script>
        <script src="<?php echo s3MVC_MakeLink('/js/foundation/vendor/foundation.min.js'); ?>"></script>
        <script> $(document).foundation(); </script>
    </body>
</html>

<?php
function makeMenuItemActive($links_controller_name, $controller_name_from_uri) {

    if( trim($controller_name_from_uri) === trim($links_controller_name) ) {

        echo 'class="active-link"';

    } else { echo ''; }
}
