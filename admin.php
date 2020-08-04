<?php
include_once('./db/Database.php');
include_once('./controllers/Controller.php');

$database = new Database();
$db = $database->connect();

$controller = new Controller($db);

if (isset($_COOKIE['blackdevs-cookie'])) {
  $isValid = $controller->validate();

  if ($isValid) {
    ?>
      <html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta charset="UTF-8"/>
        <title>Login Cookies</title>
        <meta name="description" content="Sotware Center">
        <meta name="author" content="Julio Cesar">
      </head>
      <body>
        <center>
          <h2>Sistema de login com Cookies</h2>
          <hr>
          <h4>Tempo</h4>
          <div>
            Corrente&nbsp;|&nbsp;<?php echo $controller->timestamp_now; ?>
          </div>
          <div>
            Expira&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;<?php echo $controller->timestamp_cookie; ?>
          </div>
          <br/><br/>
          <hr>
          <h4>Dados</h4>
          <table>
            <tr>
              <td>
                Username: <?php echo $controller->user_username; ?>
              </td>
              <tr/>
            <tr>
              <td>
                Password: <?php echo $controller->user_password; ?>
              </td>
              <tr/>
            <tr>
              <td>
                Hash: <?php echo $controller->user_hash; ?>
              </td>
              <tr/>
            <tr>
              <td>
                Timestamp Cookie: <?php echo $controller->timestamp_cookie; ?>
              </td>
              <tr/>
            <tr>
              <td>
                Codigo User: <?php echo $controller->user_codigo; ?>
              </td>
            </tr>
          </table>
          <br/><br/>
          <a style="background-color: #000; color: #fff; padding: 5px 50px 5px 50px;
            text-decoration: none; border-radius: 0.3em; outline: none; cursor: pointer;"
            href='./admin.php?acao=destruir'
          >
            Sair
          </a>
        </center>
      </body>
      </html>
    <?php
  }
} else {
  $controller->handleHeader->unauthorized();
}

if ($_GET) {
  if ($_GET['acao'] == 'destruir') {
    $puthash = $controller->logout();
    $controller->handleHeader->logged_out();
  }
}
?>