<?php
namespace MovieCatalog\Controllers;
/**
 * 
 * Description of MovieCatalogBase goes here
 *
 * 
 */
class MovieCatalogBase extends \Slim3MvcTools\Controllers\BaseController
{   
    /**
     * 
     * Will be used in actionLogin() to construct the url to redirect to upon successful login,
     * if $_SESSION[static::SESSN_PARAM_LOGIN_REDIRECT] is not set.
     * 
     * @var string
     */
    protected $login_success_redirect_action = 'index';
    
    /**
     * 
     * Will be used in actionLogin() to construct the url to redirect to upon successful login,
     * if $_SESSION[static::SESSN_PARAM_LOGIN_REDIRECT] is not set.
     * 
     * @var string
     */
    protected $login_success_redirect_controller = 'movie-catalog-base';
    
    /**
     * 
     * @param \Psr\Container\ContainerInterface $container
     * @param string $controller_name_from_uri
     * @param string $action_name_from_uri
     * @param \Psr\Http\Message\ServerRequestInterface $req
     * @param \Psr\Http\Message\ResponseInterface $res
     * 
     */
    public function __construct(
        \Psr\Container\ContainerInterface $container, $controller_name_from_uri, $action_name_from_uri, 
        \Psr\Http\Message\ServerRequestInterface $req, \Psr\Http\Message\ResponseInterface $res
    ) {
        parent::__construct($container, $controller_name_from_uri, $action_name_from_uri, $req, $res);
    }
    
    public function actionIndex() {
        
        //get the contents of the view first
        $view_str = $this->renderView('index.php');
        
        return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
    }
    
    protected function doDelete($id, $model_key_name_in_container) {

        // The call below is to get a response object for
        // redirecting the user to the login page if the
        // user is not currently logged in. You must be 
        // logged in in order to be able to delete an 
        // existing record. If the user is logged in, 
        // $login_response will receive a value of 
        // false from $this->getResponseObjForLoginRedirectionIfNotLoggedIn().
        $login_response = $this->getResponseObjForLoginRedirectionIfNotLoggedIn();
        
        if( $login_response instanceof \Psr\Http\Message\ResponseInterface ) {
            
            // redirect to login page
            return $login_response;
        }

        // get model object
        $model_obj = $this->container->get($model_key_name_in_container);
        
        // fetch the record
        $record = $model_obj->fetch($id);
        
        if( !($record instanceof \BaseRecord) ) {
            
            // Could not find record with the specified $id
            return $this->generateNotFoundResponse(
                        $this->request, 
                        $this->response,
                        'Requested item could not be deleted. It does not exist.'
                    );
        }
        
        // We will be redirecting to the default action of the current 
        // controller
        $rdr_path = s3MVC_MakeLink("{$this->controller_name_from_uri}");
        
        if ( $record->delete() === false ) {
            
            // Delete operation was not successful. Set error message.
            $this->setErrorFlashMessage('Could not Delete Record!');
            
        } else {
            
            // Delete operation was successful. Set success message.
            $this->setSuccessFlashMessage('Successfully Deleted!');
        }
        
        // Redirect to the default action of the current controller
        return $this->response->withHeader('Location', $rdr_path);
    }
    
    public function preAction() {
        
        // add code that you need to be executed before each controller action method is executed
        $response = parent::preAction();
        
        return $response;
    }
    
    public function postAction(\Psr\Http\Message\ResponseInterface $response) {
        
        // add code that you need to be executed after each controller action method is executed
        $new_response = parent::postAction($response);
        
        return $new_response;
    }
    
    public function renderLayout($file_name, array $data=[]) {
        
        // define common layout variables
        $common_layout_data = [];
        $common_layout_data['content'] = 'Content Goes Here!';
        $common_layout_data['is_logged_in'] = $this->isLoggedIn();
        $common_layout_data['last_flash_message'] = $this->getLastFlashMessage();
        $common_layout_data['action_name_from_uri'] = $this->action_name_from_uri;
        $common_layout_data['controller_name_from_uri'] = $this->controller_name_from_uri;
        $common_layout_data['last_flash_message_css_class'] = $this->getLastFlashMessageCssClass();
        $common_layout_data['logged_in_users_username'] = 
                    $this->isLoggedIn() ? $this->container->get('vespula_auth')->getUsername() : '';
        
        return parent::renderLayout($file_name, array_merge( $common_layout_data, $data ) );
    }
    
    public function renderView($file_name, array $data=[]) {
        
        // define common view variables
        $common_layout_data = [];
        $common_layout_data['is_logged_in'] = $this->isLoggedIn();
        $common_layout_data['action_name_from_uri'] = $this->action_name_from_uri;
        $common_layout_data['controller_name_from_uri'] = $this->controller_name_from_uri;
        $common_layout_data['logged_in_users_username'] = 
            $this->isLoggedIn() ? $this->container->get('vespula_auth')->getUsername() : '';
        
        return parent::renderView($file_name, array_merge( $common_layout_data, $data ) );
    }
    
    protected function setErrorFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('alert');
    }

    protected function setSuccessFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('success');
    }

    protected function setWarningFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('warning');
    }
    
    protected function setFlashMessage($msg) {

        $msg_key = 'curr_msg';
        $this->container->get('slim_flash')->addMessage($msg_key, $msg);
    }

    protected function getLastFlashMessage() {

        $msg_key = 'curr_msg';
        $messages = $this->container->get('slim_flash')->getMessage($msg_key);

        if( is_array($messages) && count($messages) === 1 ) {
            
            $messages = array_pop($messages);
        }
        return $messages;
    }

    protected function setFlashMessageCssClass($css_class) {

        $msg_key = 'curr_msg_css_class';
        $this->container->get('slim_flash')->addMessage($msg_key, $css_class);
    }

    protected function getLastFlashMessageCssClass() {

        $msg_key = 'curr_msg_css_class';
        $messages = $this->container->get('slim_flash')->getMessage($msg_key);
        
        if( is_array($messages) && count($messages) > 0 ) {
            
            $messages = array_pop($messages);
        }
        return $messages;
    }
}
