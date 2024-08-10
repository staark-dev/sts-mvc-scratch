<?php
use Http\{Request, Response};

/**
 * User Auth Management Class
 * @property $dbh
 */
class Auth extends Model {
    protected string $table = 'accounts'; // Default is 'users'
    protected array $allowedColumns = [
        'name',
        'email',
        'passwords'
    ];
    public array $errors = [];

    public function show(?Request $request, ?Response $response) {}

    public function store(?Request $request, ?Response $response) {}

    public function save(?Request $request, ?Response $response) {
        if($request->isPost()) {
            // TODO:
        }
    }

    public function update(?Request $request, ?Response $response) {}

    public function delete(?Request $request, ?Response $response) {}

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

    public function loginSave(): array
    {
        if($this->request->isPost()) {
            $this->errors = [];
            $data = $this->request->getBodyData();
            $stmt = $this->db->dbh->prepare("SELECT uID, name, email, type, status, passwords FROM `{$this->table}` WHERE `email` = :email LIMIT 0,1");
            $stmt->bindParam(':email', $data['user_email']);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);

                if(strcasecmp($data['user_password'], $user->passwords)  !== 0) {
                    $this->errors['login']['password'] = true;
                }

                if(strcasecmp($data['user_email'], $user->email) !== 0) {
                    $this->errors['login']['email'] = true;
                }

                if(strcasecmp($data['user_password'], $user->passwords)  == 0) {
                    $_SESSION['user'] = $user->name;
                    $_SESSION['user_session'] = array(
                        "id" => $user->uID,
                        "user" => $user->name,
                        "status" => $user->status,
                        "admin" => (bool)$user->type,
                        "expire" => time() * 5
                    );

                    $this->response->to('/');
                    exit;
                }
            } else {
                $this->errors['login']['user'] = true;
            }
            return $this->errors;
        }

        return $this->errors;
    }
}