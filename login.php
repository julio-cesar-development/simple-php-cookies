<?php
include_once('./db/Database.php');
include_once('./controllers/Controller.php');

$database = new Database();
$db = $database->connect();
$controller = new Controller($db);

if ($_POST) {
  if ($_POST['username'] && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : 0;

    if (preg_match('/[^(a-z|0-9|_)]+/i', $username)) {
      $controller->handleHeader->unauthorized();
    } else {
      $username = $controller->handleCharacters->ant_sql($username);
      $password = md5($controller->handleCharacters->ant_sql_pass($password));
      $controller->user->username = $username;
      $result = $controller->user->get_user();

      if ($result && sizeof($result) > 0 && $result['password'] === $password
        && $result['codigo'] != null) {
        $controller->user->codigo = $result['codigo'];
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        $ip = ($_SERVER['REMOTE_ADDR']);
        $date = date('Y-m-d H:i:s');
        $hash = $controller->randomString->generate(30);
        $token = $username . '-' . $password . '-' . $hash . '-' . $controller->handleTimes->date_to_timestamp($date) . '-' . $controller->user->codigo;
        $controller->user->hash = $hash;
        $puthash = $controller->user->put_userhash();

        if ($puthash && $puthash->rowCount() > 0) {
          if ($remember == 1) {
            setcookie('blackdevs-cookie', $token, time() + (24 * 3600)); // 24 hours of validity (24 * 3600)
          } else {
            setcookie('blackdevs-cookie', $token); // until the end of session
          }
          $controller->handleHeader->logged_in();
        } else {
          $controller->handleHeader->error();
        }
      } else {
        $controller->handleHeader->invalid_auth();
      }
    }
  } else {
    $controller->handleHeader->invalid_auth();
  }
} else {
  ?>
  <html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="UTF-8" />
    <title>Login Cookies</title>
    <meta name="description" content="Sotware Center">
    <meta name="author" content="Julio Cesar">
  </head>
  <body>
    <center>
      <h2>Sistema de login com Cookies</h2>
      <form name="frm_cookie" method="POST" action="./login.php">
        <table border="0" cellpading="0" cellspacing="0" width="25%" style="margin-left: auto; margin-right: auto;">
          <tr>
            <td width="50%" height="25">
              Login:
            </td>
            <td width="50%" height="25">
              <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" size="12" width="100%" />
            </td>
          </tr>
          <tr>
            <td width="50%" height="25">
              Senha:
            </td>
            <td width="50%" height="25">
              <input type="password" name="password" size="12" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" width='100%' />
            </td>
          </tr>
          <tr>
            <td width="100%" height="25" colspan="2">
              <center>
                <input type="checkbox" name="remember" value="1" checked />Salvar cookie
              </center>
            </td>
          </tr>
          <tr>
            <td width="100%" height="25" colspan="2">
              <center>
                <input style="background-color: #000; color: #fff; padding: 5px 50px 5px 50px; text-decoration: none; border-radius: 0.3em; outline: none; cursor: pointer;" type="submit" name="btn_logar" value="Logar >>" />
              </center>
            </td>
          </tr>
          <tr>
            <td width="100%" height="25" colspan="2">
              <?php
              if (isset($_GET['msg'])) {
                $msg = base64_decode($_GET['msg']);
                ?>
                <center>
                  <div id="msg" style="transition: 0.5s; opacity: 1; background-color: #ededed; border-left: 2px #f22 solid; padding: 10px; margin-top: 20px;">
                    <code>
                      <?php
                        echo $msg;
                      ?>
                    </code>
                  </div>
                </center>
                <script>
                  setTimeout(() => {
                    document.getElementById('msg').style.opacity = '0';
                  }, 1500)
                  setTimeout(() => {
                    document.getElementById('msg').style.display = 'none';
                  }, 2000)
                </script>
              <?php
            }
            ?>
            </td>
          </tr>
        </table>
      </form>
    </center>
  </body>
  </html>
  <?php
}

if (isset($_COOKIE['blackdevs-cookie'])) {
  $isValid = $controller->validate();
  if ($isValid) {
    $controller->handleHeader->logged_in();
  }
}
?>