<?php 
    include('C:\xampp\htdocs\bookStore\backend\bookSection\newbooks.php');
    session_start();
    $username = $_SESSION['username'] ?? ''; 

    $books = $result;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>WELCOME</h2>

        <!--NEW BOOKS-->
        <div class="book-grid">
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']) ?>" alt="<?php echo htmlspecialchars($book['bookName']) ?>">
                    <p><?php echo htmlspecialchars($book['author']) ?></p>
                    <h3><?php echo htmlspecialchars($book['bookName']) ?></h3>
                    <p><?php echo htmlspecialchars($book['price']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>