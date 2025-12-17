<div class="container">

  <div class="row">
    <div class="col-12 col-md-8">

      <h1 class="heading">Questions</h1>
      <?php

      include("./common/db.php");

      if (isset($_GET["c-id"])) {
        $cid = $_GET["c-id"];
        $query = "select * from questions where category_id=$cid";
      } else if (isset($_GET["u-id"])) {
        $uid = $_GET["u-id"];
        $query = "select * from questions where user_id=$uid";
      } else if (isset($_GET["latest"])) {
        $query = "select * from questions  order by id desc";
      } else if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $query = "select * from questions  where `title` LIKE '%$search%'";
      } else {
        $query = "select * from questions";
      }
      $result = $conn->query($query);
      foreach ($result as $row) {
        $title = $row['title'];
        $id = $row['id'];
        $loggedUserId = $_SESSION['user']['user_id'] ?? null;
        echo "<div class='question-list d-flex justify-content-between align-items-center'>
        <h5 class='mb-0'>
            <a href='?q-id=$id'>$title</a>
        </h5>";

        /* show delete only on My Questions page */
        if (isset($_GET['u-id']) && (int) $loggedUserId === (int) $row['user_id']) {
          echo "
    <a href='./server/requests.php?delete_question=$id'
       class='btn btn-sm btn-danger'
       onclick=\"return confirm('Delete this question?')\">
       Delete
    </a>";
        }

        echo "</div>";
      }

      ?>
    </div>

    <div class="col-12 col-md-4 mt-4 mt-md-0">

      <?php
      include('category-list.php');
      ?>
    </div>

  </div>
</div>