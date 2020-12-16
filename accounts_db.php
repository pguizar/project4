<?php

function validate_login($email, $password) {
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

}
?>
