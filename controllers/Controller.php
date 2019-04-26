<?php
  include_once('./utils/HandleCharacters.php');
  include_once('./utils/HandleTimes.php');
  include_once('./utils/RandomString.php');
  include_once('./utils/HandleHeader.php');
  include_once('./models/User.php');

  class Controller {
    private $db;
    public $user;
    public $isValid;
    public $handleCharacters;
    public $handleTimes;
    public $randomString;
    public $handleHeader;
    public $data;
    public $valueCookieExploded;
    public $user_codigo;
    public $user_username;
    public $user_password;
    public $user_hash;
    public $timestampCookie;
    public $timestampNow;

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

      $this->data = date('Y-m-d H:i:s');
      $this->valueCookieExploded = explode('-', $_COOKIE['blackdevs-cookie']);

      // cookie parts handling
      $this->user_username = $this->valueCookieExploded[0];
      $this->user_password = $this->valueCookieExploded[1];
      $this->user_hash = $this->valueCookieExploded[2];
      $this->timestampCookie = (int) $this->valueCookieExploded[3] + (24 * 3600); // 24 hours of validity (24 * 3600)
      $this->user_codigo = $this->valueCookieExploded[4];

      // setting user attributes
      $this->user->codigo = $this->user_codigo;
      $this->user->username = $this->user_username;
      $this->user->hash = $this->user_hash;

      $result = $this->user->get_user();

      if($result && sizeof($result) > 0 && $result['password'] === $this->user_password && $result['hash'] === $this->user_hash){
        $this->timestampNow = $this->handleTimes->data_to_timestamp($this->data);
        if($this->timestampNow < $this->timestampCookie){
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