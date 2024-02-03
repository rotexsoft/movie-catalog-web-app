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
  'username' => 
  array (
    'name' => 'username',
    'type' => 'varchar',
    'size' => 255,
    'scale' => NULL,
    'notnull' => false,
    'default' => NULL,
    'autoinc' => false,
    'primary' => false,
  ),
  'password' => 
  array (
    'name' => 'password',
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
