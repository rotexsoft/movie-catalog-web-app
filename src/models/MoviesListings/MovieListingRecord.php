<?php
declare(strict_types=1);

namespace MovieCatalog\Models\MoviesListings;

/**
 * @property mixed $id bigint unsigned NOT NULL
 * @property mixed $title text NOT NULL
 * @property mixed $release_year varchar(4) NOT NULL
 * @property mixed $genre varchar(255)
 * @property mixed $duration_in_minutes int
 * @property mixed $mpaa_rating varchar(255)
 * @property mixed $record_creation_date datetime NOT NULL
 * @property mixed $record_last_modification_date datetime NOT NULL
 *
 * @method MoviesListingsModel getModel()
 */
class MovieListingRecord extends \MovieCatalog\Models\Records\BaseRecord {
    
    //put your code here
}
