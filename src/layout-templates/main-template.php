<!doctype html>
<?php
    /** @var \Vespula\Locale\Locale $__localeObj */
    /** @var \Rotexsoft\FileRenderer\Renderer $this */
    /** @var \SlimMvcTools\Controllers\BaseController $controller_object */
    
    function makeMenuItemActive($links_controller_name, $controller_name_from_uri): string {

        return ( trim($controller_name_from_uri) === trim($links_controller_name) ) ? 'active' : '';
    }
?>

<html class="no-js" lang="<?= $__localeObj->getLanguageCode(); ?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <link rel="icon" type="image/png" href="<?= $controller_object->makeLink('/favicon-96x96.png'); ?>" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?= $controller_object->makeLink('/favicon.svg'); ?>" />
        <link rel="shortcut icon" href="<?= $controller_object->makeLink('/favicon.ico'); ?>" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $controller_object->makeLink('/apple-touch-icon.png'); ?>" />
        <link rel="manifest" href="<?= $controller_object->makeLink('/site.webmanifest'); ?>" />
        
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <title>Movie Catalog Web-app</title>
        
        <style>
            .container {
                width: 98%;
            }
            
            strong {
                font-weight: bold;
            }
            
            @media only screen and (min-width : 601px) and (max-width : 1260px) {
                .toast {
                    width: 100%;
                    border-radius: 0;
                }
            }

            @media only screen and (min-width : 1261px) {
                .toast {
                    width: 100%;
                    border-radius: 0; 
                }
            }

            @media only screen and (min-width : 601px) and (max-width : 1260px) {
                #toast-container {
                    min-width: 100%;
                    bottom: 0%;
                    top: 90%;
                    right: 0%;
                    left: 0%;
                } 
            }

            @media only screen and (min-width : 1261px) {
                #toast-container {
                    min-width: 100%;
                    bottom: 0%;
                    top: 90%;
                    right: 0%;
                    left: 0%; 
                } 
            }
        </style>
    </head>
    
    <body>
        
        <div class="navbar-fixed">
            
            <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
                            
                <li><a href="<?= $controller_object->makeLink("/users"); ?>">Manage Users</a></li>
                            
                <li class="divider"></li>
                
                <?php if( $controller_object->isLoggedIn() ): ?>
                        
                    <li><a href="<?= $controller_object->makeLink("/users/add"); ?>">Add New User</a></li>
                    
                <?php endif; // if( $controller_object->isLoggedIn() ) ?>
            </ul>
            
            <nav>
                <div class="nav-wrapper">
                    
                    <a href="<?= $controller_object->makeLink('/movie-listings'); ?>"
                       class="brand-logo" style="padding-left: 0.5em;">
                        <span class="hide-on-small-only">Movie Catalog Web-app</span>
                        <span class="hide-on-med-and-up">Tha Movies</span>
                    </a>
                    
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        
                        <li class="<?= makeMenuItemActive('movie-listings', $controller_object->getControllerNameFromUri()); ?>">
                            <a href="<?= $controller_object->makeLink('/movie-listings'); ?>">
                                <?= $__localeObj->gettext('main_template_text_home'); ?>
                            </a>
                        </li>
                        
                        <!-- Dropdown Trigger -->
                        <li class="<?= makeMenuItemActive('users', $controller_object->getControllerNameFromUri()); ?>">
                            <a class="dropdown-trigger" 
                               href="#!" data-target="dropdown1">
                                Users<i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                        
                        <?php if($controller_object->isLoggedIn()): ?>
                            <li style="padding-right: 0.5em;">
                                <a href="<?= $controller_object->makeLink("/{$controller_object->getControllerNameFromUri()}/logout"); ?>">
                                    <?= $__localeObj->gettext('base_controller_text_logout'); ?>
                                </a>&nbsp;
                            </li>
                        <?php else: ?>
                            <li style="padding-right: 0.5em;">
                                <a href="<?= $controller_object->makeLink("/{$controller_object->getControllerNameFromUri()}/login"); ?>">
                                    <?= $__localeObj->gettext('base_controller_text_login'); ?>
                                </a>&nbsp;
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            
        </div> <!-- <div class="navbar-fixed"> -->
        
        <ul class="sidenav" id="mobile-demo">
            <li>
                <a href="<?= $controller_object->makeLink('/movie-listings'); ?>">
                    <?= $__localeObj->gettext('main_template_text_home'); ?>
                </a>
            </li>

            <li><a href="<?= $controller_object->makeLink("/users"); ?>">Manage Users</a></li>

            <?php if( $controller_object->isLoggedIn() ): ?>

                <li><a href="<?= $controller_object->makeLink("/users/add"); ?>">Add New User</a></li>

            <?php endif; // if( $controller_object->isLoggedIn() ) ?>

            <?php if($controller_object->isLoggedIn()): ?>
                <li>
                    <a href="<?= $controller_object->makeLink("/{$controller_object->getControllerNameFromUri()}/logout"); ?>">
                        <?= $__localeObj->gettext('base_controller_text_logout'); ?>
                    </a>&nbsp;
                </li>
            <?php else: ?>
                <li>
                    <a href="<?= $controller_object->makeLink("/{$controller_object->getControllerNameFromUri()}/login"); ?>">
                        <?= $__localeObj->gettext('base_controller_text_login'); ?>
                    </a>&nbsp;
                </li>
            <?php endif; ?>
                
        </ul> <!-- <ul class="sidenav" id="mobile-demo"> -->
        
        <div class="container">

            <div class="row" style="margin-top: 1em; margin-left: 0.5em; margin-right: 0.5em;">
                <div class="s12">
                    <?php if( $controller_object->isLoggedIn() ): ?>

                        <strong style="color: #7f8fa4;">
                            Logged in as <?= $controller_object->getVespulaAuthObject()->getUsername(); ?>
                        </strong>

                    <?php endif; ?>
                </div>
            </div>

            <div class="row" style="margin-top: 1em; margin-left: 0.75em; margin-right: 0.75em;">
                <div class="s12">
                    <?php echo $content; ?>
                </div>
            </div>

            <div class="s12" style="margin-left: 0.5em; margin-right: 0.5em;">
                <footer>
                    <hr/>
                    <p style="color: #7f8fa4;">Copyright &copy; <?php echo date('Y'); ?>. Movie Catalog Web-app.</p>
                </footer>
            </div>
            
        </div>

        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                
                var elems = document.querySelectorAll('.dropdown-trigger');
                var instances = M.Dropdown.init(elems, { hover: false });

                var sideNavElems = document.querySelectorAll('.sidenav');
                var sideNavInstances = M.Sidenav.init(sideNavElems, {});
                
                // Flash Message display logic
                <?php if( isset($last_flash_message) && $last_flash_message !== null  ): ?>

                    var flash_toast_css = '<?= $this->escapeJs($last_flash_message_css_class ?? ''); ?>';
                    var flash_toast_messages = '';

                    <?php if( is_array($last_flash_message) ): ?>

                        <?php foreach($last_flash_message as $curr_flash_msg): ?>

                            flash_toast_messages += '<?= $this->escapeJs($curr_flash_msg); ?><br>';

                        <?php endforeach; // foreach($last_flash_message as $curr_flash_msg): ?>

                    <?php else: ?>

                        flash_toast_messages += '<?= $this->escapeJs($last_flash_message); ?><br>';

                    <?php endif; // if( is_array($last_flash_message) ): ?>
                        
                    M.toast({html: flash_toast_messages, displayLength: 15000, classes: flash_toast_css });

                <?php endif; //if( $last_flash_message !== null )?>
            });
        </script>
        
    </body>
</html>
