<?php
return array (
  'id' => 
  array (
    'name' => 'id',
    'type' => 'bigint unsigned',
    'size' => NULL,
    'scale' => NULL,
    'notnull' => true,
    'default' => NULL,
    'autoinc' => true,
    'primary' => true,
  ),
  'title' => 
  array (
    'name' => 'title',
    'type' => 'text',
    'size' => NULL,
    'scale' => NULL,
    'notnull' => true,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'release_year' => 
  array (
    'name' => 'release_year',
    'type' => 'varchar',
    'size' => 4,
    'scale' => NULL,
    'notnull' => true,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'genre' => 
  array (
    'name' => 'genre',
    'type' => 'varchar',
    'size' => 255,
    'scale' => NULL,
    'notnull' => false,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'duration_in_minutes' => 
  array (
    'name' => 'duration_in_minutes',
    'type' => 'int',
    'size' => NULL,
    'scale' => NULL,
    'notnull' => false,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'mpaa_rating' => 
  array (
    'name' => 'mpaa_rating',
    'type' => 'varchar',
    'size' => 255,
    'scale' => NULL,
    'notnull' => false,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'record_creation_date' => 
  array (
    'name' => 'record_creation_date',
    'type' => 'datetime',
    'size' => NULL,
    'scale' => NULL,
    'notnull' => true,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'record_last_modification_date' => 
  array (
    'name' => 'record_last_modification_date',
    'type' => 'datetime',
    'size' => NULL,
    'scale' => NULL,
    'notnull' => true,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
);
