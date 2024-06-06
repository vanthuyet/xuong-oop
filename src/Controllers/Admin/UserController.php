<?php

namespace Admin\Xuongoop\Controllers\Admin;

use Admin\Xuongoop\Commons\Controller;
use Admin\Xuongoop\Commons\Helper;
use Admin\Xuongoop\Models\Users;
use Exception;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private Users $user;

    public function __construct()
    {
        $this->user = new Users();
    }
    public function index()
    {
        try {
            // for ($i = 0; $i < 100; $i++) {
            //     $this->user->insert([
            //         'name' => "Nguyễn Văn $i",
            //         'email' => "a$i@gmail.com",
            //         'password' => password_hash('12345678', PASSWORD_DEFAULT)
            //     ]);
            [$users, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);
            // $totalPage = $this->user->count();
            $this->renderViewAdmin('users.index', [
                "users"     =>   $users,
                "totalPage" =>   $totalPage
            ]);
            // }
        } catch (Exception $e) {
            Helper::debug($e);
        }
    }

    public function create()
    {
        $this->renderViewAdmin("users.create",);
    }
    public function store()
    {
        $validator = new Validator;

        $validation = $validator->validate($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'role'                  => 'required',
            'confirm_password'      => 'required|same:password',
            'avatar'                => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location:' . url("/admin/users/create"));
            exit();
        } else {
            // validation passes

            $_SESSION['success'] = "Thêm mới thành công";

            $data = [
                'name'                  => $_POST['name'],
                'email'                 => $_POST['email'],
                'role'                  => $_POST['role'],
                'password'              => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];

            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] >  0) {
                $form = $_FILES['avatar']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['avatar']['namespace'];
            }

            if (move_uploaded_file($form, PATH_ROOT . $to)) {
                $data['avatar'] = $to;
            } else {
                $_SESSION['errors']['avatar'] = 'Không upload được';
                header('Location:' . url('admin/users/create'));
                exit;
            }

            $this->user->insert($data);
            $_SESSION['status'] = true;
            $_SESSION['msg'] = "Thao tác thành công";

            header('Location:' . url('admin/users'));
            exit;
        }
    }

    public function show($id)
    {
        $user = $this->user->findByID($id);

        $this->renderViewAdmin("users.show", [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        try {
            $user = $this->user->findByID($id);

            if (empty($user)) {
                throw new Exception('Model not found');
            }

            $this->renderViewAdmin("users.edit", [
                'user' => $user,

            ]);
        } catch (\Throwable $th) {
            echo "404 - NOT FOUND";
            die;
        }
    }
    public function update($id)
    {

        $user = $this->user->findByID($id);

        $validator = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'min:6',
            'avatar'                => 'uploaded_file:0,2M,png,jpg,jpeg',
            'role'                  => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location:' . url("admin/users/{$user['id']}/edit"));
            exit();
        } else {
            // validation passes



            $data = [
                'name'                  => $_POST['name'],
                'email'                 => $_POST['email'],
                'password'              => !empty($_POST['password'])
                    ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'],
                'role'                  => $_POST['role'],
            ];

            $flagUpload = false;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] >  0) {

                $flagUpload = true;
                $form = $_FILES['avatar']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['avatar']['name'];
            }

            if (move_uploaded_file($form, PATH_ROOT . $to)) {
                $data['avatar'] = $to;
            } else {
                $_SESSION['errors']['avatar'] = 'Không upload được';
                header('Location:' . url("admin/users/{$user['id']}/edit"));
                exit;
            }

            $this->user->update($id, $data);
            if (
                $flagUpload
                && $user['avatar']
                && file_exists(PATH_ROOT . $user['avatar'])
            ) {
                unlink(PATH_ROOT.$user['avatar']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = "Thao tác thành công";

            header('Location:' . url("admin/users/{$user['id']}/edit"));
            exit;
        }
    }
    public function delete($id)
    {
        $user = $this->user->findByID($id);

        if (
            $user['avatar']
            && file_exists(PATH_ROOT . $user['avatar'])
        ) {
            unlink(PATH_ROOT.$user['avatar']);
        }
        $this->user->delete($id);
        header('Location:' . url('admin/users'));
        exit();
    }
}
