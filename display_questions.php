<!DOCTYPE html>
<html>
<head>
	<title>Display Questions</title>
  <link rel="stylesheet" href="design1.css">
      		
</head>
<body>
  <a href=".?action=display_question_form&userId=<?php echo $userId; ?>">Add Question</a>
  <a href=".?action=display_questions&userId=<?php echo $userId; ?>&listType=mine">My Questions</a>
  <a href=".?action=display_questions&userId=<?php echo $userId; ?>&listType=all">All Questions</a>

  <h1> Questions </h1>
  	<table>
  		<tr>
  			<th>Question Title</th>
  			<th> Body </th>
        		<th> Skills </th>

  		</tr>
  		<?php foreach ($questions as $question) : ?>
  			<tr>
  				<td><?php echo $question->getTitle(); ?></td>
  				<td><?php echo $question->getBody(); ?></td>
          <td><?php echo $question->getSkills(); ?></td>
          <td>
            <form action="." method="post">
              <input type="hidden" name="action" value="delete_question">


              <input type="hidden" name="questionId" value="<?php $question->getId(); ?>">
              <input type="hidden" name="userId" value="<?php echo $userId; ?>">

              <input type="submit" value="Delete">
          </td>
  			</tr>
  		<?php endforeach; ?>	
  	</table>

</body>

</html>
