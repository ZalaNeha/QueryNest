<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
?>

<div class="container">
   <div class="offset-sm-1">
      <h5>Answers:</h5>

      <?php
      $loggedUserId = $_SESSION['user']['user_id'] ?? null;
      $query = "select * from answers where question_id=$qid";
      $result = $conn->query($query);
      foreach ($result as $row) {
         $answer = $row['answer'];
         $answer_id = $row['id'];
         $answer_user_id = $row['user_id'];
         echo "<div class='row align-items-start '>
          <div class='col'>
            <p class='answer-wrapper '>$answer</p></div>";

         if ((int)$loggedUserId === (int)$answer_user_id) {
            echo "<div class='col-auto'>
               <a href='./server/requests.php?delete_answer=$answer_id&q-id=$qid'
                 class='btn btn-sm btn-outline-danger'
                 title='Delete'
                 onclick=\"return confirm('Delete this answer?')\">
                ✕
              </a></div>";
         }

         echo "</div>";
      }
      ?>
   </div>
</div>