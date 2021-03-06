<?php
include_once 'db.php';
include_once 'support.php';
session_start();

function user_redirect_if_not_authenticated() {
  if(!user_is_authenticated()) {
    add_location_header("?login=true");
    http_response_code(302);
    exit();
  }
}

function user_is_authenticated() {
  return isset($_SESSION['user_id']);
}

function user_is_candidate() {
  return in_array('Candidate', $_SESSION['user_roles']);
}

function user_is_employer() {
  return in_array('Employer', $_SESSION['user_roles']);
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
  if(!user_is_authenticated()) {
    die('no current user id');
  }

  return $_SESSION['user_id'];
}

function user_available_user_name($user_name) {
  return empty(_user_load_credentials($user_name));
}

function user_register($user_name, $password, $person, $roles) {
  $user_id = _insert_user($user_name, $password, $person);

  if(!empty($user_id)) {
    $inserted = _update_roles_for_user($user_id, $roles);
  } else {
    $inserted = false;
  }

  if ($inserted) {
    return $user_id;
  } else {
    return NULL;
  }
}

function _insert_user($user_name, $password, $person) {
  $salt = _user_generate_salt();
  $parameters = clone $person;

  $password = _user_hash_password($password, $salt);

  $connection = db_open();

  // insert
  $query = "
  INSERT INTO users
  (Username, Password, Salt, Email, Phone, FirstName, LastName, MiddleInitial, Suffix)
  VALUES
  (?,?,?,?,?,?,?,?,?)
  ";

  $statement = $connection->prepare($query);
  $statement->bind_param('sssssssss', $user_name, $password, $salt, $person->email, $person->phone, $person->first_name, $person->last_name, $person->middle_initial, $person->suffix);
  $statement->execute();
  $user_id = $connection->insert_id;
  $statement->close();

  return $user_id;
}

function _update_roles_for_user($user_id, $roles) {
  if(empty($roles)) {
    throw new Exception('Roles can not be empty');
  }

  $connection = db_open();

  //find role ids
  $role_ids = [];
  $query = 'select RoleID from roles where 1=2';
  foreach($roles as $role) {
    $query = $query . ' or RoleName = ?';
  }
  $statement = $connection->prepare($query);
  foreach($roles as $role) {
    $statement->bind_param('s', $role);
  }
  $statement->bind_result($role_id);
  $statement->execute();
  while ($statement->fetch()) {
    $role_ids[] = $role_id;
  }
  $statement->close();

  // delete current roles
  $query = 'delete from userroles where UserID = ?';
  $statement = $connection->prepare($query);
  $statement->bind_param('i', $user_id);
  $inserted = $statement->execute();
  $statement->close();

  //insert roles
  $query = 'insert into userroles (UserID, RoleID) values (?, ?)';
  $statement = $connection->prepare($query);
  foreach($role_ids as $role_id) {
    $statement->bind_param('ii', $user_id, $role_id);
    $statement->execute();
  }
  $statement->close();

  return true;
}

function _user_load_credentials($user_name) {
  $query = "
  SELECT UserID, Password, Salt
  FROM users
  WHERE lower(Username) = lower(?)
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
    $_SESSION['user_roles'] = _load_user_roles($credentials->user_id);
  }

  return $authenticated;
}

function _load_user_roles($user_id) {
  $connection = db_open();

  //find role ids
  $roles = [];
  $query = 'select RoleName from roles r join userroles ur on ur.RoleId = r.RoleId where ur.UserId = ?';
  $statement = $connection->prepare($query);
  $statement->bind_param('i', $user_id);
  $statement->bind_result($role);
  $statement->execute();
  while ($statement->fetch()) {
    $roles[] = $role;
  }
  $statement->close();

  return $roles;
}

function _user_generate_salt() {
  return uniqid();
}


function _user_hash_password($password, $salt) {
  return sha1($password . $salt);
}


?>
