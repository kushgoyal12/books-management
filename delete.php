<?php
    require_once "pdo.php";
    session_start();

    if ( isset($_POST['delete']) && isset($_POST['book_id']) ) {
        $sql = "DELETE FROM books WHERE book_id = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['book_id']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' ) ;
        return;
    }

    if ( ! isset($_GET['book_id']) ) {
        $_SESSION['error'] = "Missing book_id";
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->prepare("SELECT name, book_id FROM books where book_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['book_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for user_id';
        header( 'Location: index.php' ) ;
        return;
    }

?>
<p>Confirm: Deleting <?= htmlentities($row['name']) ?></p>

<form method="post">
    <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>">
    <input type="submit" value="Delete" name="delete">
    <a href="index.php">Cancel</a>
</form>
