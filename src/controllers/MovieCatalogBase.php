<?php
namespace MovieCatalog\Controllers;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;

/**
 * Description of MovieCatalogBase goes here
 */
class MovieCatalogBase extends \SlimMvcTools\Controllers\BaseController
{   
    /**
     * 
     * Will be used in actionLogin() to construct the url to redirect to upon successful login,
     * if $_SESSION[static::SESSN_PARAM_LOGIN_REDIRECT] is not set.
     * 
     * @var string
     */
    protected string $login_success_redirect_action = 'index';
    
    /**
     * 
     * Will be used in actionLogin() to construct the url to redirect to upon successful login,
     * if $_SESSION[static::SESSN_PARAM_LOGIN_REDIRECT] is not set.
     * 
     * @var string
     */
    protected string $login_success_redirect_controller = 'movie-catalog-base';
    
    public function __construct(
        ContainerInterface $container, 
        string $controller_name_from_uri, 
        string $action_name_from_uri,
        ServerRequestInterface $req, 
        ResponseInterface $res
    ) {
        parent::__construct($container, $controller_name_from_uri, $action_name_from_uri, $req, $res);
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
        $model_obj = $this->getContainerItem($model_key_name_in_container);
        
        // fetch the record
        $record = $model_obj->fetchOneByPkey($id);
        
        if( !($record instanceof \MovieCatalog\Models\Records\BaseRecord) ) {
            
            // Could not find record with the specified $id
            $this->forceHttp404(
                'Requested item could not be deleted. It does not exist.'
            );
        }
        
        // We will be redirecting to the default action of the current 
        // controller
        $rdr_path = $this->makeLink("{$this->controller_name_from_uri}");
        
        if ( $record->delete() === false ) {
            
            // Delete operation was not successful. Set error message.
            $this->setErrorFlashMessage('Could not Delete Record!');
            
        } else {
            
            // Delete operation was successful. Set success message.
            $this->setSuccessFlashMessage('Successfully Deleted!');
        }
        
        // Redirect to the default action of the current controller
        return $this->response->withStatus(302)->withHeader('Location', $rdr_path);
    }
    
    /**
     * @return \Psr\Http\Message\ResponseInterface|string
     */
    public function actionIndex() {
        
        //get the contents of the view first
        $view_str = $this->renderView('index.php', ['controller_object'=>$this]);
        
        return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
    }
    
    public function preAction(): ResponseInterface {
        
        // add code that you need to be executed before each controller action method is executed
        $response = parent::preAction();
        
        return $response;
    }
    
    public function postAction(ResponseInterface $response): ResponseInterface {
        
        // add code that you need to be executed after each controller action method is executed
        $new_response = parent::postAction($response);
        
        return $new_response;
    }
    
    public function renderLayout(string $file_name, array $data=[]): string {
        
        // define common layout variables
        $common_layout_data = [];
        $common_layout_data['last_flash_message'] = $this->getLastFlashMessage();
        $common_layout_data['last_flash_message_css_class'] = $this->getLastFlashMessageCssClass();
        
        return parent::renderLayout(
            $file_name, array_merge( $common_layout_data, $data ) 
        );
    }
    
    public function renderView(string $file_name, array $data=[]): string {
        
        // define common variables
        $common_layout_data = [];
        $common_layout_data['last_flash_message'] = $this->getLastFlashMessage();
        $common_layout_data['last_flash_message_css_class'] = $this->getLastFlashMessageCssClass();
        
        return parent::renderView(
            $file_name, array_merge( $common_layout_data, $data ) 
        );
    }
    
    protected function setErrorFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('red');
    }

    protected function setSuccessFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('teal lighten-2');
    }

    protected function setWarningFlashMessage($msg) {
        
        $this->setFlashMessage($msg);
        $this->setFlashMessageCssClass('deep-orange darken-1');
    }
    
    protected function setFlashMessage($msg) {

        $msg_key = 'curr_msg';
        $this->getContainerItem(\Slim\Flash\Messages::class)->addMessage($msg_key, $msg);
    }

    protected function getLastFlashMessage() {

        $msg_key = 'curr_msg';
        $messages = $this->getContainerItem(\Slim\Flash\Messages::class)->getMessage($msg_key);

        if( is_array($messages) && count($messages) === 1 ) {
            
            $messages = array_pop($messages);
        }
        return $messages;
    }

    protected function setFlashMessageCssClass($css_class) {

        $msg_key = 'curr_msg_css_class';
        $this->getContainerItem(\Slim\Flash\Messages::class)->addMessage($msg_key, 'card-panel pulse ' . $css_class);
    }

    protected function getLastFlashMessageCssClass() {

        $msg_key = 'curr_msg_css_class';
        $messages = $this->getContainerItem(\Slim\Flash\Messages::class)->getMessage($msg_key);
        
        if( is_array($messages) && count($messages) > 0 ) {
            
            $messages = array_pop($messages);
        }
        return $messages;
    }
}
