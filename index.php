<?php
require('pdo.php');
require('account.php');
require('questions.php');
require('accounts_db.php');
require('questions_db.php');


session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login';
    }
}
switch ($action) {
    case 'show_login': {
        if($_SESSION['userId']) {
            header('Location: .?action=display_questions');
        } else {
        include('login.php');
    }
        break;
    }
    case 'validate_login': {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if ($email == NULL || $password == NULL){
            echo 'Email and password not included';
        } else {
            $user = AccountsDB::validate_login($email, $password);
            $userId = $user->getId();
            if ($userId == false) {
                header('Location: index.php?action=display_registration.php');
            } 
            else {
                //echo "Valid login";
                $_SESSION['userId'] = $userId;
                header("Location: .?action=display_questions");
            }   
        }
        break;
    }
    case 'display_registration': {
        include('registration.php');
        break;
    }
    case 'submit_registration': {

    }
    case 'display_questions': {
        $userId = $_SESSION['userId'];
        $listType = filter_input(INPUT_GET, 'listType');
        if ($userId == NULL || $userId < 0) {
            header('Location: .?action=display_login');
        } 
        else 
        {
            $questions = QuestionsDB::get_users_questions($userId);
            
            //??? v
            $questions = ($listType === 'all') ? QuestionsDB::get_all_questions() : QuestionsDB::get_users_questions($userId);
            include('display_questions.php');
        }
        break;
    }
    case 'display_question_form': {
        $firstName = filter_input(INPUT_POST, 'fName');
        $userId = filter_input(INPUT_GET, 'userId');
        if ($userId == NULL || $userId < 0){
            header('Location: .?action=display_login');
        }
        else
        {
            include('newQuestionForm.php');
        }
        break;
    }
        
    case 'submit_question': {
        $userId = filter_input(INPUT_POST, 'userId');
        $title = filter_input(INPUT_POST, 'title');
        $body = filter_input(INPUT_POST, 'body');
        $skills = filter_input(INPUT_POST, 'skills');


        if ($userId == NULL || $title == NULL || $body == NULL || $skills == NULL){
            echo "All fields are required";
        }
        else
        {
            QuestionsDB::create_question($title, $body, $skills, $userId);
            header("Location: .?action=display_questions");
        }
        break;

    }
    case 'delete_question': {
        $questionId = filter_input(INPUT_POST, 'questionId');
        $userId = filter_input(INPUT_POST, 'userId');
        if($questionId == NULL || $userId == NULL) {
            echo 'All Fields are required';
        }
        else {
            QuestionsDB::delete_question($questionId);
            header("Location: .?action=display_questions");
        }
        break;
    }
    case 'logout' : {
        session_destroy();
        $_SESSION = array();
        $name = session_name();
        $expire = strtotime('-1 year');

        $params = session_get_cookie_params();

        setcookie($name, '', $expire, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        header('Location: index.php');
        break;
    }
    } 
?>
