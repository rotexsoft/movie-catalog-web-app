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
        
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <title>Da Numba 1 Movie Catalog App</title>
        
        <style>
            .container {
                width: 98%;
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
                       class="brand-logo">
                        Da Numba 1 Movie Catalog App
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

            <div class="row" style="margin-top: 1em;">
                <div class="s12">
                    <?php if( $controller_object->isLoggedIn() ): ?>

                        <strong style="color: #7f8fa4;">
                            Logged in as <?= $controller_object->getVespulaAuthObject()->getUsername(); ?>
                        </strong>

                    <?php endif; ?>
                </div>
            </div>

            <div class="row" style="margin-top: 1em;">
                <div class="s12">
                    <?php echo $content; ?>
                </div>
            </div>

            <div class="s12">
                <footer>
                    <hr/>
                    <p>Copyright &copy; <?php echo date('Y'); ?>. Da Numba 1 Movie Catalog App.</p>
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
