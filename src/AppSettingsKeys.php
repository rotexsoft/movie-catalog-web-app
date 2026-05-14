<?php

declare(strict_types=1);

namespace SlimSkeletonMvcApp;

/**
 * Contains constants that are to be used as keys to items in your application's settings array.
 *
 * @author rotimi
 */
class AppSettingsKeys extends \SlimMvcTools\AppSettingsKeys {

    // Add more public constants that you want to be keys 
    // for your application's settings array below
    public const DB_DSN = 'db_dsn';
    public const DB_USER = 'db_user_name';
    public const DB_PASS = 'db_password';
}
