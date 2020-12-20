<?php

class AccountsDB{
	public static function validate_login($email, $password) {
	global $db;
	$query = 'SELECT * FROM accounts WHERE email = :email AND password = :password';
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email);
	$statement->bindValue(':password', $password);
	$statement->execute();
	$user = $statement->fetch();

	$statement->closeCursor();

	if (count($user) > 0) {
		$user = new Account($user['id'], $user['email'], $user['fname'], $user['lname'], $user['birthday'], $user['password']);
		return $user;
	} else {
		return false;
		}
	
	}


	public static function get_user($userId) {
	global $db;
	$query = 'SELECT * FROM accounts WHERE id = :userId';

	$statement = $db->prepare($query);
	$statement->bindValue(':userId', $userId);
	$statement->execute();
	$user = $statement->fetch();

	$statement->closeCursor();

	$user = new Account($user['id'], $user['email'], $user['fname'], $user['lname'], $user['birthday'], $user['password']);

}
}

/*function validate_login($email, $password) {
	global $db;
	$query = 'SELECT * FROM accounts WHERE email = :email AND password = :password';
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email);
	$statement->bindValue(':password', $password);
	$statement->execute();
	$user = $statement->fetch();

	$statement->closeCursor();

	if(count($user) > 0){
		return $user['id'];
	}else{
		return false;
	}

} 
function get_user($userId) {
	global $db;
	$query = 'SELECT * FROM accounts WHERE id = :userId';

	$statement = $db->prepare($query);
	$statement->bindValue(':userId', $userId);
	$statement->execute();
	$user = $statement->fetch();

	$statement->closeCursor();

} */
?>
