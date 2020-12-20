<?php


class QuestionsDB {
	public static function get_users_questions ($userId) {
	global $db;
	$query = 'SELECT * FROM questions WHERE ownerid = :userId';
	$statement = $db->prepare($query);
	$statement->bindValue(':userId', $userId);
	$statement->execute();
	$questions = $statement->fetchAll();
	$statement->closeCursor();

	//
	$questionObjs = array();
	foreach ($questions as $question) {
		$question = new Questions($question['ownerid'], $question['title'], $question['body'], $question['skills']);
		array_push($questionObjs, $question);
	}


	return $questionObjs;
	}


	public static function get_all_questions(){
	global $db;

	$query = 'SELECT * FROM questions';
	$statement = $db->prepare($query);
	$statement->execute();

	$questions = $statement->fetchAll();
	$statement->closeCursor();

	//
	$questions = new Questions($questions['ownerid'], $questions['title'], $questions['body'], $questions['skills']);

	return $questions;

	}

	function create_question($title, $body, $skills, $userId) {
	global $db;

	$query = 'INSERT INTO questions (title, body, skills, ownerid) VALUES (:title, :body, :skills, :ownerid)';
	$statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->bindValue(':body', $body);
	$statement->bindValue(':skills', $skills);
	$statement->bindValue(':ownerid', $userId);
	$statement->execute();
	$statement->closeCursor();

	}
	function delete_question ($questionId) {
	global $db;

	$query = 'DELETE FROM questions WHERE id = :questionId';
	$statement = $db->prepare($query);
	$statement->bindValue(':questionId', $questionId);
	$statement->execute();
	$statement->closeCursor();

	}



}

/*function get_users_questions ($userId) {
	global $db;
	$query = 'SELECT * FROM questions WHERE ownerid = :userId';
	$statement = $db->prepare($query);
	$statement->bindValue(':userId', $userId);
	$statement->execute();

	$questions = $statement->fetchAll();
	$statement->closeCursor();

	return $questions;
}
function get_all_questions(){
	global $db;

	$query = 'SELECT * FROM questions';
	$statement = $db->prepare($query);
	$statement->execute();

	$questions = $statement->fetchAll();
	$statement->closeCursor();

	return $questions;

}

function create_question($title, $body, $skills, $userId) {
	global $db;

	$query = 'INSERT INTO questions (title, body, skills, ownerid) VALUES (:title, :body, :skills, :ownerid)';
	$statement = $db->prepare($query);
	$statement->bindValue(':title', $title);
	$statement->bindValue(':body', $body);
	$statement->bindValue(':skills', $skills);
	$statement->bindValue(':ownerid', $userId);
	$statement->execute();
	$statement->closeCursor();


}

function delete_question ($questionId) {
	global $db;

	$query = 'DELETE FROM questions WHERE id = :questionId';
	$statement = $db->prepare($query);
	$statement->bindValue(':questionId', $questionId);
	$statement->execute();
	$statement->closeCursor();

}
 */

?>
