<?php
  class HandleHeader {
    public function invalid_auth(){
      header('HTTP/1.1 401 Unauthorized');
      header('Location: login.php?msg='.base64_encode('usuario ou senha invalida'));
    }

    public function expired_session(){
      header('HTTP/1.1 401 Unauthorized');
      header('Location: login.php?msg='.base64_encode('sessao expirada'));
    }

    public function unauthorized(){
      header('HTTP/1.1 401 Unauthorized');
      header('Location: login.php?msg='.base64_encode('nao autorizado'));
    }

    public function forbidden(){
      header('HTTP/1.1 403 Forbidden');
      header('Location: login.php?msg='.base64_encode('proibido'));
    }

    public function logged_out(){
      header('HTTP/1.1 200 Ok');
      header('Location: login.php?msg='.base64_encode('deslogado'));
    }

    public function logged_in(){
      header('HTTP/1.1 302 Found');
      header('Location: admin.php');
    }

    public function error(){
      header('HTTP/1.1 401 Unauthorized ');
      header('Location: login.php?msg='.base64_encode('houve um erro'));
    }
  }
?>