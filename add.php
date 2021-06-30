<?php
    require_once "pdo.php";
    session_start();

    if ( isset($_POST['name']) && isset($_POST['author_name'])) {

        if ( strlen($_POST['name']) < 1 || strlen($_POST['author_name']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: add.php");
            return;
        }

        $sql = "INSERT INTO books (name, author_name)
                VALUES (:name, :author_name)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':author_name' => $_POST['author_name']));
        $_SESSION['success'] = 'Record Added';
        header( 'Location: index.php' ) ;
        return;
    }

    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="./styles/app.css">
    </head>
</html>

<body>
    <div class="form">
        <div>
            <h2 style="text-align: center">Add A New Book</h2>
        </div>
            <form method="post">
                <div>
                    <div class="enter">
                        <p>Name:
                        <input class="enter1" type="text" name="name"></p>
                    </div>
                    <div class="enter">
                        <p>Author Name:
                        <input class="enter1" type="text" name="author_name"></p>
                    </div>
                </div>

                <div class="submitButton">
                    <button type="submit" class="submitButton1">Add New</button>
                </div>
                
                <div class="cancelButton">
                    <button class="cancelButton1"><a class="cancelButton2" href="index.php">Cancel</a></button>
                </div>
            </form>
    </div>
</body>