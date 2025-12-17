<?php
session_start();
include("../common/db.php");
if (isset($_POST['signup'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $address = $_POST["address"];
    $user = $conn->prepare("insert into `users` 
(`id`,`username`,`email`,`password`,`address`) 
values (NULL,'$username','$email','$password','$address');
");

    $result = $user->execute();

    if ($result) {
        session_regenerate_id(true);
        $_SESSION["user"] = [
            "username" => $username
            ,
            "email" => $email,
            "user_id" => $user->insert_id
        ];
        header("location: /querynest");
    } else {
        echo "Signup failed";
    }
} else if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION["user"] = [
                "username" => $row["username"],
                "email" => $row["email"],
                "user_id" => $row["id"]
            ];
            header("location: /querynest");
        } else {
            echo "<h3 style='color:red'>Invalid Password</h3>";
        }

    } else {
        echo "<h3 style='color:red'>User not found</h3>";
    }
} else if (isset($_GET['logout'])) {
    session_unset();
    header("location: /querynest");
} else if (isset($_POST['ask'])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category_id = $_POST["category"];
    $user_id = $_SESSION['user']['user_id'];
    $question = $conn->prepare("insert into `questions` 
(`id`,`title`,`description`,`category_id`,`user_id`) 
values (NULL,'$title','$description','$category_id','$user_id');
");

    $result = $question->execute();
    $question->insert_id;
    if ($result) {

        header("location: /querynest");
    } else {
        echo "Question not added";
    }
} else if (isset($_POST['submit_answer'])) {

    if (!isset($_SESSION['user'])) {
        header("location: /querynest?login=true");
        exit();
    }

    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['user']['user_id'];

    $stmt = $conn->prepare(
        "INSERT INTO answers (answer, question_id, user_id) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sii", $answer, $question_id, $user_id);
    $stmt->execute();

    header("location: /querynest?q-id=$question_id");
    exit();
} else if (isset($_GET['delete_answer'])) {

    if (!isset($_SESSION['user'])) {
        header("location: /querynest?login=true");
        exit();
    }

    $answer_id = $_GET['delete_answer'];
    $user_id = $_SESSION['user']['user_id'];

    // delete only own answer
    $stmt = $conn->prepare(
        "DELETE FROM answers WHERE id = ? AND user_id = ?"
    );
    $stmt->bind_param("ii", $answer_id, $user_id);
    $stmt->execute();

    $qid = $_GET['q-id'];
    header("location: /querynest?q-id=$qid");
    exit();
} else if (isset($_GET['delete_question'])) {

    if (!isset($_SESSION['user'])) {
        header("location: /querynest?login=true");
        exit();
    }

    $question_id = $_GET['delete_question'];
    $user_id = $_SESSION['user']['user_id'];

    // delete answers first (IMPORTANT)
    $stmt = $conn->prepare(
        "DELETE FROM answers WHERE question_id = ?"
    );
    $stmt->bind_param("i", $question_id);
    $stmt->execute();

    // delete question (only owner)
    $stmt = $conn->prepare(
        "DELETE FROM questions WHERE id = ? AND user_id = ?"
    );
    $stmt->bind_param("ii", $question_id, $user_id);
    $stmt->execute();

    header("location: /querynest?u-id=$user_id");
    exit();
}







?>