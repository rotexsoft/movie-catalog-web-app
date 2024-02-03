<?php
namespace MovieCatalog\Controllers;

use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;

/**
 * 
 * Description of MovieListings goes here
 * 
 */
class MovieListings extends \MovieCatalog\Controllers\MovieCatalogBase
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
    protected string $login_success_redirect_controller = 'movie-listings';
    
    public function __construct(
        ContainerInterface $container, 
        string $controller_name_from_uri, 
        string $action_name_from_uri,
        ServerRequestInterface $req, 
        ResponseInterface $res
    ) {
        parent::__construct($container, $controller_name_from_uri, $action_name_from_uri, $req, $res);
    }
    
    public function actionIndex() {
        
        $view_data = [];
        /** @var \MovieCatalog\Models\MoviesListings\MoviesListingsModel $model_obj */
        $model_obj = $this->getContainerItem(
            \MovieCatalog\Models\MoviesListings\MoviesListingsModel::class
        );
        
        // Grab all existing movie records.
        // Note that the variable $collection_of_movie_records will be available
        // in your index.php view (in this case ./src/views/movie-listings/index.php)
        // when $this->renderView('index.php', $view_data) is called.
        $view_data['collection_of_movie_records'] = 
                                    $model_obj->fetchRecordsIntoCollection();
        
        $response_format = sMVC_GetSuperGlobal('get', 'format', null);
        
        if( 
            $response_format !== null
            && !in_array( trim(mb_strtolower( ''.$response_format, 'UTF-8')), ['html', 'xhtml'] )
        ) {
            //handle other specified formats (non-html)
            if ( trim(mb_strtolower(''.$response_format, 'UTF-8')) === 'json' ) {
                
                // return response in json format
                $movie_listings_array = [];
                
                if( 
                    $view_data['collection_of_movie_records'] instanceof \MovieCatalog\Models\Collections\BaseCollection 
                    && count($view_data['collection_of_movie_records']) > 0 
                ) {
                    //convert collection of movie_listings records to an array of arrays
                    foreach ($view_data['collection_of_movie_records'] as $record) {

                        // $record->getData() gets the underlying associative array 
                        // containing a record's data
                        $movie_listings_array[] = $record->getData();
                    }
                }
                
                $this->response
                     ->getBody()
                     ->write($json = json_encode($movie_listings_array));

                // Ensure that the json encoding passed successfully
                if ($json === false) {
                    
                    throw new \RuntimeException(json_last_error_msg(), json_last_error());
                }
                
                return $this->response
                            ->withStatus(302)
                            ->withHeader('Content-Type', 'application/json;charset=utf-8');
                
            } else {
                
                // Unknown format specified, generate an error page
                $msg = "Unknown format `$response_format` specified";
                $this->forceHttp404($msg);
            }
            
        } else {
        
            //render the view first and capture the output
            $view_str = $this->renderView('index.php', $view_data);

            return $this->renderLayout( $this->layout_template_file_name, ['content'=>$view_str] );
        }
    }
    
    public function actionAdd() {
        
        // The call below is to get a response object for
        // redirecting the user to the login page if the
        // user is not currently logged in. You must be 
        // logged in in order to be able to add a new movie.
        // If the user is logged in, $login_response will
        // receive a value of false from
        // $this->getResponseObjForLoginRedirectionIfNotLoggedIn().
        $login_response = $this->getResponseObjForLoginRedirectionIfNotLoggedIn();
        
        if( $login_response instanceof \Psr\Http\Message\ResponseInterface ) {
            
            // redirect to login page
            return $login_response;
        }
        
        /** @var \MovieCatalog\Models\MoviesListings\MoviesListingsModel $model_obj */
        $model_obj = $this->getContainerItem(
            \MovieCatalog\Models\MoviesListings\MoviesListingsModel::class
        );
        $error_msgs = [];
        $error_msgs['form-errors'] = [];
        $error_msgs['title'] = []; // cannot be blank
        $error_msgs['release_year'] = []; // cannot be blank
        
        // create an associative array with keys being the names of the columns in the 
        // db table associated with the model and a default value of '' for each item 
        // in the array
        $default_data = $model_obj->getDefaultColVals();
        
        // remove item whose key is primary key column name
        // since primary key values are auto-generated
        unset($default_data[$model_obj->getPrimaryColName()]);
        
        // this is an integer field in the db
        $default_data['duration_in_minutes'] = '0'; 

        // create a new record with the default data generated above
        $record = $model_obj->createNewRecord($default_data);
        
        if( $this->request->getMethod() === 'POST' ) {
            
            // POST Request
            $has_field_errors = false;
            
            // Read the post data
            $posted_data = sMVC_GetSuperGlobal('post');
            
            if( mb_strlen( ''.$posted_data['title'], 'UTF-8') <= 0 ) {
                
                $error_msgs['title'][] = 'Title cannot be blank!';
                $has_field_errors = true;
            }
            
            if( mb_strlen( ''.$posted_data['release_year'], 'UTF-8') <= 0 ) {
                
                $error_msgs['release_year'][] = 'Year of Release cannot be blank!';
                $has_field_errors = true;
            }
     
            //load posted data into new record object
            $record->loadData($posted_data);

            if ( !$has_field_errors ) {
                
                // try to save
                if ( $record->save() !== false ) {

                    //successfully saved;
                    $rdr_path = $this->makeLink("movie-listings/index");
                    $this->setSuccessFlashMessage('Successfully Saved!');

                    // re-direct to the list all movies page
                    return $this->response
                                ->withStatus(302)
                                ->withHeader('Location', $rdr_path);
                    
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
        $view_data['movie_record'] = $record;
        
        $view_str = $this->renderView('add.php', $view_data);
        
        return $this->renderLayout('main-template.php', ['content'=>$view_str]);
    }
    
    public function actionEdit($id) {
        
        // The call below is to get a response object for
        // redirecting the user to the login page if the
        // user is not currently logged in. You must be 
        // logged in in order to be able to edit an 
        // existing movie. If the user is logged in, 
        // $login_response will receive a value of 
        // false from $this->getResponseObjForLoginRedirectionIfNotLoggedIn().
        $login_response = $this->getResponseObjForLoginRedirectionIfNotLoggedIn();
        
        if( $login_response instanceof \Psr\Http\Message\ResponseInterface ) {
            
            // redirect to login page
            return $login_response;
        }
        
        /** @var \MovieCatalog\Models\MoviesListings\MoviesListingsModel $model_obj */
        $model_obj = $this->getContainerItem(
            \MovieCatalog\Models\MoviesListings\MoviesListingsModel::class
        );
        $error_msgs = [];
        $error_msgs['form-errors'] = [];
        $error_msgs['title'] = [];
        $error_msgs['release_year'] = [];
        
        // fetch the record for the movie with the specified $id
        $record = $model_obj->fetchOneByPkey($id);
        
        if( !($record instanceof \MovieCatalog\Models\Records\BaseRecord) ) {
            
            // Could not find record for the movie with the specified $id
            $this->forceHttp404('Requested movie does not exist.');
        }
        
        if( $this->request->getMethod() === 'POST' ) {
            
            // POST Request
            $has_field_errors = false;
            
            // Read the post data
            $posted_data = sMVC_GetSuperGlobal('post');
            
            if( mb_strlen( ''.$posted_data['title'], 'UTF-8') <= 0 ) {
                
                $error_msgs['title'][] = 'Title Cannot be blank!';
                $has_field_errors = true;
            }
            
            if( mb_strlen( ''.$posted_data['release_year'], 'UTF-8') <= 0 ) {
                
                $error_msgs['release_year'][] = 'Year of Release Cannot be blank!';
                $has_field_errors = true;
            }
     
            //load posted data into new record object
            $record->loadData($posted_data);

            if ( !$has_field_errors ) {
                
                // try to save
                if ( $record->save() !== false ) {

                    //successfully saved;
                    $rdr_path = $this->makeLink("movie-listings/index");
                    $this->setSuccessFlashMessage('Successfully Saved!');

                    // re-direct to the list all movies page
                    return $this->response->withStatus(302)->withHeader('Location', $rdr_path);
                    
                } else {

                    //Record could not be saved.
                    $error_msgs['form-errors'][] = 'Save Failed!';
                } // if ( $record->save() !== false ) 
                
            } else {
                
                $error_msgs['form-errors'][] = 'Form contains error(s)!';
            } // if ( !$has_field_errors )
                
        } //if( $this->request->getMethod() === 'POST' )

        $view_data = [];
        $view_data['movie_record'] = $record;
        $view_data['error_msgs'] = $error_msgs;
        
        $view_str = $this->renderView('edit.php', $view_data);
        
        return $this->renderLayout('main-template.php', ['content'=>$view_str]);
    }
    
    public function actionDelete($id) {
        
        return $this->doDelete(
            $id,
            \MovieCatalog\Models\MoviesListings\MoviesListingsModel::class
        );
    }
    
    public function actionView($id) {
        
        $view_data = [];
        /** @var \MovieCatalog\Models\MoviesListings\MoviesListingsModel $model_obj */
        $model_obj = $this->getContainerItem(
            \MovieCatalog\Models\MoviesListings\MoviesListingsModel::class
        );
        
        // Grab record for the movie whose id was specified.
        // Note that the variable $movie_record will be available
        // in your view.php view (in this case ./src/views/movie-listings/view.php)
        // when $this->renderView('view.php', $view_data) is called.
        $view_data['movie_record'] = $model_obj->fetchOneByPkey($id);
        
        if( !($view_data['movie_record'] instanceof \MovieCatalog\Models\Records\BaseRecord) ) {
            
            // We could not find any movie with the specified id in the database.
            // Generate and return an http 404 resposne.
            $this->forceHttp404('Requested movie does not exist.');
        }
        
        //get the contents of the view first
        $view_str = $this->renderView('view.php', $view_data);

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
}
