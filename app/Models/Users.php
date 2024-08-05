<?php

use Traits\Model;

/**
 * User Class
 */
class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'passwords'
    ];
}