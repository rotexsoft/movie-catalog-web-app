<?php
declare(strict_types=1);

namespace MovieCatalog\Models\MoviesListings;

/**
 * @method MoviesListingsCollection createNewCollection(\GDAO\Model\RecordInterface ...$list_of_records)
 * @method MovieListingRecord createNewRecord(array $col_names_n_vals = [])
 * @method ?MovieListingRecord fetchOneRecord(?object $select_obj=null, array $relations_to_include=[])
 * @method ?MovieListingRecord fetchOneByPkey($id, $relations_to_include = [])
 * @method MovieListingRecord[] fetchRecordsIntoArray(?object $select_obj=null, array $relations_to_include=[])
 * @method MovieListingRecord[] fetchRecordsIntoArrayKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 * @method MoviesListingsCollection fetchRecordsIntoCollection(?object $select_obj=null, array $relations_to_include=[])
 * @method MoviesListingsCollection fetchRecordsIntoCollectionKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 */
class MoviesListingsModel extends \MovieCatalog\Models\BaseModel {
    
    protected ?string $collection_class_name = MoviesListingsCollection::class;
    
    protected ?string $record_class_name = MovieListingRecord::class;
    
    protected ?string $created_timestamp_column_name = 'record_creation_date';
    
    protected ?string $updated_timestamp_column_name = 'record_last_modification_date';
    
    protected string $primary_col = 'id';
    
    protected string $table_name = 'movie_listings';
    
    public function __construct(
        string $dsn = '', 
        string $username = '', 
        string $passwd = '', 
        array $pdo_driver_opts = [], 
        string $primary_col_name = '', 
        string $table_name = ''
    ) {
        $this->table_cols = include(__DIR__ . DIRECTORY_SEPARATOR . 'MoviesListingsFieldsMetadata.php');
        
        parent::__construct($dsn, $username, $passwd, $pdo_driver_opts, $primary_col_name, $table_name);
        
        // Define relationships below here
        
        //$this->belongsTo(...)
        //$this->hasMany(...);
        //$this->hasManyThrough(...);
        //$this->hasOne(...)
    }
}
