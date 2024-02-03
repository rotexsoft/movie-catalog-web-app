<?php
declare(strict_types=1);

namespace MovieCatalog\Models\UsersAuthenticationsAccounts;

/**
 * @method UsersAuthenticationsAccountsCollection createNewCollection(\GDAO\Model\RecordInterface ...$list_of_records)
 * @method UserAuthenticationAccountRecord createNewRecord(array $col_names_n_vals = [])
 * @method ?UserAuthenticationAccountRecord fetchOneRecord(?object $select_obj=null, array $relations_to_include=[])
 * @method ?UserAuthenticationAccountRecord fetchOneByPkey($id, $relations_to_include = [])
 * @method UserAuthenticationAccountRecord[] fetchRecordsIntoArray(?object $select_obj=null, array $relations_to_include=[])
 * @method UserAuthenticationAccountRecord[] fetchRecordsIntoArrayKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 * @method UsersAuthenticationsAccountsCollection fetchRecordsIntoCollection(?object $select_obj=null, array $relations_to_include=[])
 * @method UsersAuthenticationsAccountsCollection fetchRecordsIntoCollectionKeyedOnPkVal(?\Aura\SqlQuery\Common\Select $select_obj=null, array $relations_to_include=[])
 */
class UsersAuthenticationsAccountsModel extends \MovieCatalog\Models\BaseModel {
    
    protected ?string $collection_class_name = UsersAuthenticationsAccountsCollection::class;
    
    protected ?string $record_class_name = UserAuthenticationAccountRecord::class;
    
    protected ?string $created_timestamp_column_name = 'record_creation_date';
    
    protected ?string $updated_timestamp_column_name = 'record_last_modification_date';
    
    protected string $primary_col = 'id';
    
    protected string $table_name = 'user_authentication_accounts';
    
    public function __construct(
        string $dsn = '', 
        string $username = '', 
        string $passwd = '', 
        array $pdo_driver_opts = [], 
        string $primary_col_name = '', 
        string $table_name = ''
    ) {
        $this->table_cols = include(__DIR__ . DIRECTORY_SEPARATOR . 'UsersAuthenticationsAccountsFieldsMetadata.php');
        
        parent::__construct($dsn, $username, $passwd, $pdo_driver_opts, $primary_col_name, $table_name);
        
        // Define relationships below here
        
        //$this->belongsTo(...)
        //$this->hasMany(...);
        //$this->hasManyThrough(...);
        //$this->hasOne(...)
    }
}
