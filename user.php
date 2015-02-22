<?php
include_once 'db.php';
session_start();

function user_is_authenticated() {
  return isset($_SESSION['user_id']);
}

function user_logout() {
  session_start();

  $_SESSION = array();

  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }

  // Finally, destroy the session.
  session_destroy();
}

function user_retrieve_current_id() {
  return $_SESSION['user_id'] or die('no current user id');
}

function user_available_user_name($user_name) {
  return empty(_user_load_credentials($user_name));
}

function user_register($user_name, $password, $person) {
  $salt = _user_generate_salt();
  $parameters = clone $person;

  $password = _user_hash_password($password, $salt);

  $query = "
  INSERT INTO users
  (Username, Password, Salt, Email, Phone, FirstName, LastName, MiddleInitial, Suffix)
  VALUES
  (?,?,?,?,?,?,?,?,?)
  ";

  $connection = db_open();

  $statement = $connection->prepare($query);

  $statement->bind_param('sssssssss', $user_name, $password, $salt, $person->email, $person->phone, $person->first_name, $person->last_name, $person->middle_initial, $person->suffix);
  $inserted = $statement->execute();

  $statement->close();

  return $inserted;
}

function _user_load_credentials($user_name) {
  $query = "
  SELECT UserID, Password, Salt
  FROM users
  WHERE Username = ?
  ";

  $connection = db_open();
  $statement = $connection->prepare($query);
  $statement->bind_param('s', $user_name);
  $statement->bind_result($user_id, $password_hash, $salt);
  $statement->execute();
  $statement->fetch();
  $statement->close();

  if(!empty($user_id)) {
    $credentials = new stdClass;
    $credentials->user_id = $user_id;
    $credentials->password_hash = $password_hash;
    $credentials->salt = $salt;
  } else {
    $credentials = NULL;
  }

  return $credentials;
}

function user_authenticate($user_name, $password) {

  $credentials = _user_load_credentials($user_name);

  $authenticated = !empty($credentials) && ($credentials->password_hash == _user_hash_password($password, $credentials->salt));

  if($authenticated) {
    $_SESSION['user_id'] = $credentials->user_id;
  }

  return $authenticated;
}

function _user_generate_salt() {
  return uniqid();
}


function _user_hash_password($password, $salt) {
  return sha1($password . $salt);
}


?>
