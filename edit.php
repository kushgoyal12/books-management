<?php
    require_once "pdo.php";
    session_start();

    if ( isset($_POST['name']) && isset($_POST['author_name']) && isset($_POST['book_id']) ) {

        if ( strlen($_POST['name']) < 1 || strlen($_POST['author_name']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: edit.php?book_id=".$_POST['book_id']);
            return;
        }

        $sql = "UPDATE books SET name = :name, author_name = :author_name WHERE book_id = :book_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':author_name' => $_POST['author_name'],
            ':book_id' => $_POST['book_id']));
        $_SESSION['success'] = 'Record updated';
        header( 'Location: index.php' ) ;
        return;
    }

    if ( ! isset($_GET['book_id']) ) {
    $_SESSION['error'] = "Missing book_id";
    header('Location: index.php');
    return;
    }

    $stmt = $pdo->prepare("SELECT * FROM books where book_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['book_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for book_id';
        header( 'Location: index.php' ) ;
        return;
    }

    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }

    $n = htmlentities($row['name']);
    $e = htmlentities($row['author_name']);
    $book_id = $row['book_id'];

?>

<html>
    <head>
        <link rel="stylesheet" href="./styles/app.css">
    </head>
</html>

<body>
    <div class="form">
        <div>
            <h2 style="text-align: center">Edit Book</h2>
        </div>
            <form method="post">
                <div>
                    <div class="enter">
                        <p>Name:
                        <input class="enter1" type="text" name="name" value="<?= $n ?>"></p>
                    </div>
                    <div class="enter">
                        <p>Author Name:
                        <input class="enter1" type="text" name="author_name" value="<?= $e ?>"></p>
                    </div>
                </div>

                <input type="hidden" name="book_id" value="<?= $book_id ?>">

                <div class="submitButton">
                    <button type="submit" class="submitButton1">Update</button>
                </div>
                
                <div class="cancelButton">
                    <button class="cancelButton1"><a class="cancelButton2" href="index.php">Cancel</a></button>
                </div>
            </form>
    </div>
</body>


