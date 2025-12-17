<div class="container">
    <h1 class="heading">Question</h1>
    <div class="row">
       <div class="col-12 col-md-8">

            <?php
            include("./common/db.php");

            $query = "select * from questions where id=$qid";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $cid = $row["category_id"];
            echo "<h4 class='margin-bottom-15 question-title'>Question : " . $row['title'] . "</h4>
            <p class='margin-bottom-15'>" . $row['description'] . "</p>";
            include("answers.php");
            ?>
            <?php if (isset($_SESSION['user'])): ?>

                <form action="./server/requests.php" method="post">
                    <input type="hidden" name="question_id" value="<?php echo $qid; ?>">

                    <textarea name="answer" class="form-control margin-bottom-15" placeholder="your answer...."
                        required></textarea>
                    <button type="submit" name="submit_answer" class="btn btn-primary bls">
                        Write Your Answer
                    </button>
                </form>

            <?php else: ?>
                <div class="alert alert-warning">
                    Please <a href="?login=true">login</a> to write an answer.
                </div>
            <?php endif; ?>
        </div>

        <div class="col-4">
            <?php
            $categoryquery = "select name from category where id=$cid";
            $categoryresult = $conn->query($categoryquery);
            $categoryrow = $categoryresult->fetch_assoc();
            echo "<h1 class='heading'>" . ucfirst($categoryrow['name']) . "</h1>";
            $query = "select * from questions where category_id=$cid and id!=$qid";
            $result = $conn->query($query);
            foreach ($result as $row) {
                $id = $row["id"];
                $title = $row["title"];
                echo '<div class="row question-list">
            <h5><a href="?q-id=' . $id . '">' . $title . '</a></h5>
            </div>';
            }
            ?>
        </div>

    </div>
</div>