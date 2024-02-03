<?php
declare(strict_types=1);

namespace MovieCatalog\Models\Records;

class BaseRecord extends \LeanOrm\Model\Record {

    public function getDateCreated(): string {
        
        $col = $this->getModel()->getCreatedTimestampColumnName();
        
        if( in_array($col, $this->getModel()->getTableColNames()) ) {
            
            return date('M j, Y g:i a T', strtotime($this->$col));
        }
        
        return '';
    }
    
    public function getLastModfiedDate(): string {
        
        $col = $this->getModel()->getUpdatedTimestampColumnName();
        
        if( in_array($col, $this->getModel()->getTableColNames()) ) {
            
            return date('M j, Y g:i a T', strtotime($this->$col));
        }
        
        return '';
    }
}
