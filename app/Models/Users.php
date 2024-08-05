<?php

use Traits\Database;
use Traits\Model;
use Traits\Validations;

/**
 * User Class
 */
class User {
    use Model, Database, Validations;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'passwords'
    ];
}