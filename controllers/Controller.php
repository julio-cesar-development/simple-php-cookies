<?php
  include_once('./utils/HandleCharacters.php');
  include_once('./utils/HandleTimes.php');
  include_once('./utils/RandomString.php');
  include_once('./utils/HandleHeader.php');
  include_once('./models/User.php');

  use Respect\Validation\Validator as v;

  require __DIR__ . '/../vendor/autoload.php';

  class Controller {
    private $db;
    public $user;
    public $isValid;
    public $handleCharacters;
    public $handleTimes;
    public $randomString;
    public $handleHeader;
    public $data;
    public $cookie_parts;
    public $user_codigo;
    public $user_username;
    public $user_password;
    public $user_hash;
    public $timestamp_cookie;
    public $timestamp_now;

    public function __construct($db){
      $this->db = $db;
      $this->handleCharacters = new HandleCharacters();
      $this->handleTimes = new HandleTimes();
      $this->randomString = new RandomString();
      $this->handleHeader = new HandleHeader();
      // New user creating
      $this->user = new User($db);
    }

    public function validate(){
      $this->isValid = false;

      $this->date = date('Y-m-d H:i:s');
      $this->cookie_parts = explode('-', $_COOKIE['blackdevs-cookie']);

      // cookie parts handling
      $this->user_username = $this->cookie_parts[0];
      $this->user_password = $this->cookie_parts[1];
      $this->user_hash = $this->cookie_parts[2];
      $this->timestamp_cookie = (int) $this->cookie_parts[3] + (24 * 3600); // 24 hours of validity (24 * 3600)
      $this->user_codigo = (int) $this->cookie_parts[4];

      if (!v::alpha()->validate($this->user_username)) {
        $this->handleHeader->forbidden();
      }
      if (!v::alnum()->validate($this->user_password)) {
        $this->handleHeader->forbidden();
      }
      if (!v::numeric()->validate($this->timestamp_cookie)) {
        $this->handleHeader->forbidden();
      }
      if (!v::numeric()->validate($this->user_codigo)) {
        $this->handleHeader->forbidden();
      }

      // setting user attributes
      $this->user->codigo = $this->user_codigo;
      $this->user->username = $this->user_username;
      $this->user->hash = $this->user_hash;

      $result = $this->user->get_user();

      if($result && sizeof($result) > 0 && $result['password'] === $this->user_password && $result['hash'] === $this->user_hash){
        $this->timestamp_now = $this->handleTimes->date_to_timestamp($this->date);
        if($this->timestamp_now < $this->timestamp_cookie){
          $this->isValid = true;
        }else{
          $this->logout();
          $this->handleHeader->expired_session();
        }
      }else{
        $this->handleHeader->invalid_auth();
      }
      return $this->isValid;
    }

    public function logout(){
      unset($_COOKIE['blackdevs-cookie']);
      setcookie('blackdevs-cookie', null, time() - 3600);
      $this->isValid = false;
      $this->user->hash = null;
      $puthash = $this->user->put_userhash();
      return $puthash;
    }
  }
?>