<?php
  include_once('./utils/HandleCharacters.php');
  include_once('./utils/HandleTimes.php');
  include_once('./utils/RandomString.php');
  include_once('./utils/HandleHeader.php');
  include_once('./models/User.php');

  require 'vendor/autoload.php';

  include_once('./exceptions/RuleException.php');
  include_once('./exceptions/RuleExceptionCode.php');

  use Respect\Validation\Validator as v;

  use App\Rules\RuleException;
  use App\Rules\RuleExceptionCode as ve;

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

      $validations = [];

      if (!v::alpha()->validate($this->user_username)) {
        $validations['user_username'] = [ve::INVALID_USERNAME];
      }
      if (!v::alnum()->validate($this->user_password)) {
        $validations['user_password'] = [ve::INVALID_PASSWORD];
      }
      if (!v::numeric()->validate($this->timestamp_cookie)) {
        $validations['timestamp_cookie'] = [ve::INVALID_TIMESTAMP];
      }
      if (!v::numeric()->validate($this->user_codigo)) {
        $validations['user_codigo'] = [ve::INVALID_USER_CODE];
      }

      if (count($validations) > 0) {
        try {
          throw new RuleException(null, null, $validations);
        } catch(RuleException $err) {
          var_dump($err->get_errors());
        } catch (Exception $e) {        // ... mas não aqui.
          var_dump($e);
        }
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