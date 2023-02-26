<?php
namespace MovieCatalog\Controllers;

class Users extends \MovieCatalog\Controllers\MovieCatalogBase
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
    protected $login_success_redirect_controller = 'users';
    
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
        
        $view_data = [];
        $model_obj = $this->container->get('users_model');
        
        // Grab all existing user records.
        // Note that the variable $collection_of_user_records will be available
        // in your index.php view (in this case ./src/views/users/index.php)
        // when $this->renderView('index.php', $view_data) is called.
        $view_data['collection_of_user_records'] = 
                    $model_obj->fetchRecordsIntoCollection();
        
        //render the view first and capture the output
        $view_str = $this->renderView('index.php', $view_data);
        
        return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
    }
    
    public function actionView($id) {
        
        $model_obj = $this->container->get('users_model');
        $view_data = [];
        
        // Grab record for the user whose id was specified.
        // Note that the variable $user_record will be available
        // in your view.php view (in this case ./src/views/users/view.php)
        // when $this->renderView('view.php', $view_data) is called.
        $view_data['user_record'] = $model_obj->fetch($id);
        
        if( !($view_data['user_record'] instanceof \BaseRecord) ) {
            
            // We could not find any user with the specified id in the database.
            // Generate and return an http 404 resposne.
            return $this->generateNotFoundResponse(
                            $this->request, 
                            $this->response,
                            'Requested user does not exist.',
                            'Requested user does not exist.'
                        );
        }
        
        //get the contents of the view first
        $view_str = $this->renderView('view.php', $view_data);

        return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
    }
    
    public function actionAdd() {
        
        // The call below is to get a response object for
        // redirecting the user to the login page if the
        // user is not currently logged in. You must be 
        // logged in in order to be able to add a new user.
        // If the user is logged in, $login_response will
        // receive a value of false from
        // $this->getResponseObjForLoginRedirectionIfNotLoggedIn().
        $login_response = $this->getResponseObjForLoginRedirectionIfNotLoggedIn();
        
        if( $login_response instanceof \Psr\Http\Message\ResponseInterface ) {
            
            // redirect to login page
            return $login_response;
        }
        
        $model_obj = $this->container->get('users_model');
        $error_msgs = [];
        $error_msgs['form-errors'] = [];
        $error_msgs['username'] = [];
        $error_msgs['password'] = [];
        
        // create an associative array with keys being the names of the columns in the 
        // db table associated with the model and a default value of '' for each item 
        // in the array
        $default_data = array_combine( 
            $model_obj->getTableColNames(), 
            array_fill(0, count($model_obj->getTableColNames()), '') 
        );
        
        // remove item whose key is primary key column name
        // since primary key values are auto-generated
        unset($default_data[$model_obj->getPrimaryColName()]); 

        // create a new record with the default data generated above
        $record = $model_obj->createNewRecord($default_data);
        
        if( $this->request->getMethod() === 'POST' ) {
            
            // POST Request
            $has_field_errors = false;
            
            // Read the post data
            $posted_data = s3MVC_GetSuperGlobal('post');
            
            if( mb_strlen( ''.$posted_data['username'], 'UTF-8') <= 0 ) {
                
                $error_msgs['username'][] = 'Username Cannot be blank!';
                $has_field_errors = true;
                
            } else {
                
                // check that posted username is not already assigned to an
                // existing user
                $params = [
                    'where' => [['col'=>'username', 'op'=>'=', 'val'=>$posted_data['username']]]
                ];

                $existing_user_with_same_username = $model_obj->fetchOneRecord($params);
                
                if( $existing_user_with_same_username instanceof \BaseRecord ) {
                    
                    // username is already assigned to an existing user
                    $error_msgs['username'][] = 'Username already taken!';
                    $has_field_errors = true;
                }
            }
            
            if( mb_strlen( ''.$posted_data['password'], 'UTF-8') <= 0 ) {
                
                $error_msgs['password'][] = 'Password Cannot be blank!';
                $has_field_errors = true;
            }
     
            //load posted data into new record object
            $record->loadData($posted_data);

            if ( !$has_field_errors ) {
                
                // hash the password
                $record->password = password_hash($record->password, PASSWORD_DEFAULT);
                
                // try to save
                if ( $record->save() !== false ) {

                    //successfully saved;
                    $rdr_path = s3MVC_MakeLink("users/index");
                    $this->setSuccessFlashMessage('Successfully Saved!');

                    // re-direct to the list all users page
                    return $this->response->withHeader('Location', $rdr_path);
                    
                } else {

                    //Record could not be saved.
                    $error_msgs['form-errors'][] = 'Save Failed!';
                } // if ( $record->save() !== false ) 
                
            } else {
                
                $error_msgs['form-errors'][] = 'Form contains error(s)!';
            } // if ( !$has_field_errors )
                
        } //if( $this->request->getMethod() === 'POST' )

        $view_data = [];
        $view_data['error_msgs'] = $error_msgs;
        $view_data['user_record'] = $record;
        
        $view_str = $this->renderView('add.php', $view_data);
        
        return $this->renderLayout('main-template.php', ['content'=>$view_str]);
    }
    
    public function actionEdit($id) {
        
        // The call below is to get a response object for
        // redirecting the user to the login page if the
        // user is not currently logged in. You must be 
        // logged in in order to be able to edit an 
        // existing user. If the user is logged in, 
        // $login_response will receive a value of 
        // false from $this->getResponseObjForLoginRedirectionIfNotLoggedIn().
        $login_response = $this->getResponseObjForLoginRedirectionIfNotLoggedIn();
        
        if( $login_response instanceof \Psr\Http\Message\ResponseInterface ) {
            
            // redirect to login page
            return $login_response;
        }
        
        $model_obj = $this->container->get('users_model');
        $error_msgs = [];
        $error_msgs['form-errors'] = [];
        $error_msgs['username'] = [];
        $error_msgs['password'] = [];
        
        // fetch the record for the user with the specified $id
        $record = $model_obj->fetch($id);
        
        if( !($record instanceof \BaseRecord) ) {
            
            // Could not find record for the user with the specified $id
            return $this->generateNotFoundResponse(
                            $this->request, 
                            $this->response,
                            'Requested user does not exist.'
                        );
        }
        
        if( $this->request->getMethod() === 'POST' ) {
            
            // POST Request
            $has_field_errors = false;
            
            // Read the post data
            $posted_data = s3MVC_GetSuperGlobal('post');
            
            if( mb_strlen( ''.$posted_data['username'], 'UTF-8') <= 0 ) {
                
                $error_msgs['username'][] = 'Username Cannot be blank!';
                $has_field_errors = true;
                
            } else {
                
                // check that posted username is not already assigned to an
                // existing user (except the user with the value of $id)
                $params = [
                    'where' => [
                        [ 'col' => 'username', 'op' => '=', 'val'=>$posted_data['username'] ],
                        [ 'col' => 'id', 'op' => '!=', 'val' => $id ],
                    ]
                ];

                $existing_user_with_same_username = $model_obj->fetchOneRecord($params);
                
                if( $existing_user_with_same_username instanceof \BaseRecord ) {

                    // username is already assigned to an existing user
                    $error_msgs['username'][] = 'Username already taken!';
                    $has_field_errors = true;
                }
            }


            //load posted data into record object
            $record->username = $posted_data['username'];

            if ( !$has_field_errors ) {
                
                if( $posted_data['password'] !== '' && !password_verify(''.$posted_data['password'], $record->password) ) {
                  
                    // only hash the password if it's different from the exisitng 
                    // hashed password
                    $record->password = password_hash(''.$posted_data['password'], PASSWORD_DEFAULT);
                }
                
                // try to save
                if ( $record->save() !== false ) {

                    //successfully saved;
                    $rdr_path = s3MVC_MakeLink("users/index");
                    $this->setSuccessFlashMessage('Successfully Saved!');

                    // re-direct to the list all users page
                    return $this->response->withHeader('Location', $rdr_path);
                    
                } else {

                    //Record could not be saved.
                    $error_msgs['form-errors'][] = 'Save Failed!';
                } // if ( $record->save() !== false ) 
                
            } else {
                
                $error_msgs['form-errors'][] = 'Form contains error(s)!';
            } // if ( !$has_field_errors )
                
        } //if( $this->request->getMethod() === 'POST' )

        $view_data = [];
        $view_data['user_record'] = $record;
        $view_data['error_msgs'] = $error_msgs;
        
        $view_str = $this->renderView('edit.php', $view_data);
        
        return $this->renderLayout('main-template.php', ['content'=>$view_str]);
    }
    
    public function actionDelete($id) {
        
        return $this->doDelete($id, 'users_model');
    }
    
    public function actionInitUsers($password) {
        
        $view_str = ''; // will hold output to be injected into 
                        // the site layout file (i.e. 
                        // `./src/layout-templates/main-template.php`)
                        // when $this->renderLayout(...) is called
        
        $model_obj = $this->container->get('users_model');
        $num_existing_users = $model_obj->fetchValue(['cols'=>['count(*)']]);
        
        if( !is_numeric($num_existing_users) ) {
            
            // no need to add entries for the `record_creation_date`
            // and `record_last_modification_date` fields in the 
            // $user_data array below since leanorm will 
            // automatically populate those fields when
            // the new record is saved.
            $user_data = [
                'username' => 'admin', 
                'password' => password_hash($password , PASSWORD_DEFAULT)
            ];
            $user_record = $model_obj->createNewRecord($user_data);
            
            if( $user_record->save() !== false ) {
                
                $view_str = 'First user successfully initialized!';
                
            } else {
                
                $view_str = 'Error: could not create first user!';
            }
            
        } else if( 
            is_numeric($num_existing_users) 
            && ((int)$num_existing_users) > 0 
        ) {
            $view_str = 'First user already initialized!';
            
        } else {
            
            $view_str = 'Error: could not initialize first user!';
        }
        
        // The 'content' key in the array below will be available in
        // `./src/layout-templates/main-template.php` as $content
        // 
        // Note: $this->layout_template_file_name has a value of
        //       'main-template.php'
        return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
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
}
