<?php
////////////////////////////////////////////////////////////////////////////////
// ./config/app-settings-dist.php is used to generate ./config/app-settings.php 
// when setting up your app in a new environment.
// 
// When you run composer install or update, composer will create a new 
// ./config/app-settings.php file (if it doesn't already exist) by copying 
// ./config/app-settings-dist.php.
// 
// ./config/app-settings-dist.php is expected to be committed into version control, 
// so just put placeholder/dummy values for sensitive settings like db credentials 
// in ./config/app-settings-dist.php.
// 
// You should NEVER commit ./config/app-settings.php (which will contain the real 
// values of all settings specific to an environment your app will run in) into 
// version control, since it's expected to contain sensitive information like db 
// passwords, etc.
////////////////////////////////////////////////////////////////////////////////

return [
    ////////////////////////////////////////////////////////////////////////////
    //
    //  Put environment specific settings below.
    //  You can access the settings via your app's container
    //  object (e.g. $c) like this: $c->get(\SlimMvcTools\ContainerKeys::APP_SETTINGS)['specific_setting_1']
    //  where `specific_setting_1` can be replaced with the actual setting name.
    // 
    ////////////////////////////////////////////////////////////////////////////
    
    ///////////////////////////////
    // Slim PHP Related Settings
    //////////////////////////////
    'displayErrorDetails' => (sMVC_GetCurrentAppEnvironment() !== SMVC_APP_ENV_PRODUCTION), // should be always false in production
    'logErrors' => true,
    'logErrorDetails' => true,
    'addContentLengthHeader' => true,
    /////////////////////////////////////
    // End of Slim PHP Related Settings
    /////////////////////////////////////

    /////////////////////////////////////////////
    // Your App's Environment Specific Settings
    /////////////////////////////////////////////
    'app_base_path' => '', // https://www.slimframework.com/docs/v4/start/web-servers.html#run-from-a-sub-directory
    'error_template_file'=> SMVC_APP_ROOT_PATH. DIRECTORY_SEPARATOR 
                            . 'src' . DIRECTORY_SEPARATOR 
                            . 'layout-templates' . DIRECTORY_SEPARATOR 
                            . 'error-template.php',
    'use_mvc_routes' => true,
    'mvc_routes_http_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    'auto_prepend_action_to_action_method_names' => true,
    'default_controller_class_name' => \MovieCatalog\Controllers\MovieListings::class,
    'default_action_name' => 'actionIndex',
    
    'error_handler_class' => \SlimSkeletonMvcApp\AppErrorHandler::class,
    
    'html_renderer_class' => \SlimMvcTools\HtmlErrorRenderer::class,
    'json_renderer_class' => \SlimMvcTools\JsonErrorRenderer::class,
    'log_renderer_class'  => \SlimMvcTools\LogErrorRenderer::class,
    'xml_renderer_class' => \SlimMvcTools\XmlErrorRenderer::class,
    
    
    // add other stuff like DB credentials, api keys, etc below
    'db_dsn' => '',
    'db_user_name' => 'user',
    'db_password' => 'pass!',
    
    ////////////////////////////////////////////////////
    // End of Your App's Environment Specific Settings
    ////////////////////////////////////////////////////
];
