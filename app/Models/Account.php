<?php
use Http\{Request, Response};
/**
 * User Account Management Class
 */
class Account extends Model {

    protected $table = 'accounts'; // Default is 'users'
    protected $allowedColumns = [
        'name',
        'email',
        'passwords'
    ];

    public function show(?Request $request, ?Response $response) {}

    public function store(?Request $request, ?Response $response) {}

    public function save(?Request $request, ?Response $response) {
        if($request->isPost()) {
            
        }
    }

    public function update(?Request $request, ?Response $response) {}

    public function delete(?Request $request, ?Response $response) {}

    public function getUsers() {
        return $this->db->query_result_array("SELECT * FROM {$this->table} ORDER BY uID DESC LIMIT 0, 10");
    }
}