<?php
    require_once "pdo.php";
    session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="./styles/index.css">
    </head>
<body>
    <div class="addNewBook">
        <a class="addNewBookLink"  href="add.php">Add New</a>
    </div>
    
    <?php
        if ( isset($_SESSION['error']) ) {
            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
            unset($_SESSION['success']);
        }
        echo ('<div class="listOfBooks">');
        echo ('<h1 class="title"> List of Books </h1>');
        $stmt = $pdo->query("SELECT name, author_name, book_id FROM books");
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            echo "<hr>";
            echo '<div class="bookEntries">';
                echo '<div class="bookDetails">';
                    echo('<h2 class="bookName">');
                    echo(htmlentities($row['name']));
                    echo('</h2>');
                    echo('<br>');
                    echo('<p class="authorName">');
                    echo(htmlentities($row['author_name']));
                    echo('</p>');
                echo "</div>";

                echo '<div class="bookEditDelete">';
                    echo('<a class="editDelete" href="edit.php?book_id='.$row['book_id'].'">Edit</a> / ');
                    echo('<a class="editDelete" href="delete.php?book_id='.$row['book_id'].'">Delete</a>');
                echo "</div>";

            echo "</div>";
        }
    ?>

    </div>
</body>
</html>