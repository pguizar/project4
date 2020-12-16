<!DOCTYPE html>
<html>
<head>
  <title>New Question Form</title>
  <link rel="stylesheet" href="design1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">           
</head>
<body>
    <nav> 
      <ul>
        <li> <a href = "registration.php" > Registration Form </a> </li>
        <li> <a href = "login.php" > Login </a> </li>
      </ul>
  </nav>
  <div class= "form">
      <form action="index.php" method="POST">
        <input type="hidden" name="action" value="submit_question">
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
            <label for="title"> Question Name <i class="fa fa-question"></i>
            <input type="text" id="title" name="title" /> </label>
            <br />
            <label for="skills"> Question Skills (Separated by Commas):
            <input type="text" id="skills" name="skills" /> </label>
             <br> <br>
            <label for="body"> Question Body:</label> <br>
            <textarea name="body" rows="10" cols="30"> </textarea> 
             <br />
             <input type="submit" name="submit" value="Submit" class="submit" />
        </form>
 </div>
</body>
</html>
