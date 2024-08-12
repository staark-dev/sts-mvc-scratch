<?php

/**
 * User Auth Management Class
 * @property $dbh
 */
use Http\{Request, Response};

class Auth extends Model {
    protected string $table = 'accounts'; // Default is 'users'
    protected array $allowedColumns = [
        'name',
        'email',
        'passwords'
    ];
    public array $errors = [];

    public function show(Request $request, Response $response): void {}

    public function store(Request $request, Response $response): void {}

    public function save(Request $request, Response $response): void {}

    public function update(Request $request, Response $response): void {}

    public function delete(Request $request, Response $response): void {}

    public function getUsers() {
        return $this->db->query_result_array("SELECT * FROM {$this->table} ORDER BY uID DESC LIMIT 0, 10");
    }

    public function findById(int &$id = null) {
        if(isset($_SESSION['user_session'])) {
            $stmt = $this->db->dbh->prepare("SELECT * FROM `{$this->table}` WHERE `uID` = :uID LIMIT 0,1");
            $ids = $_SESSION['user_session']['id'] ?? $id;
            $stmt->bindParam(':uID', $ids);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return [];
    }

    public function loginSave(): mixed
    {
        global $request;
        if($request->isPost()) {
            $data = $request->getBodyData();
            $stmt = $this->db->dbh->prepare("SELECT uID, name, email, type, status, passwords FROM `{$this->table}` WHERE `email` = :email LIMIT 0,1");
            $stmt->bindParam(':email', $data['user_email']);
            $stmt->execute();

            if($stmt->rowCount() >= 1) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);

                if(strcasecmp($data['user_password'], $user->passwords)  !== 0) {
                    //Sessions::put('login_errors', 'password', 'The entered password is incorrect!');
                    echo "The entered password is incorrect!";
                }

                if(strcasecmp($data['user_email'], $user->email) !== 0) {
                    //Sessions::put('login_errors', 'email', 'This email was not found, please check again!');
                    echo "This email was not found, please check again!";
                }

                if(strcasecmp($data['user_password'], $user->passwords)  == 0) {
                    //Sessions::delete('login_errors');

                    //Sessions::put('user', '', $user->name);
                    /*Sessions::set('user_session', [
                        "id" => $user->uID,
                        "user" => $user->name,
                        "status" => $user->status,
                        "admin" => (bool)$user->type
                    ]);*/

                    redirect('/');
                }
            } else {
                //Sessions::put('login_errors', 'user', 'The password or email is incorrect, please check again!');
                echo "The password or email is incorrect, please check again!";
                redirect('/auth/login');
            }
        }
        return false;
    }
}