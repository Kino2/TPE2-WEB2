<?php

require_once './app/models/ApiUserModel.php';
require_once './app/views/ApiView.php';
require_once './app/helpers/ApiAuthHelper.php';

function base64url_encode($data){
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}


class AuthApiController{

    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct(){
        $this->model = new UserModel();
        $this->view = new APIView();
        $this->authHelper = new AuthHelper();

        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }
    public function getToken(){
        $basic = $this->authHelper->getAuthHeader();

        if (empty($basic)) {
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ", $basic);
        if ($basic[0] != "Basic") {
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }

        $userpass = base64_decode($basic[1]);
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];
        $account = $this->model->getUser($user);
        if ($user == $account->usuario && password_verify($pass, $account->password)) {
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => $account->id,
                'name' => $account->usuario,
                'exp' => time() + 3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "E1417", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
            $this->view->response($token, 200);
        } else {
            $this->view->response('No autorizado', 401);
        }
    }
}
