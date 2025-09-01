<?php 
    include('C:\xampp\htdocs\bookStore\backend\bookSection\onSales.php');

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
    <h2>ON SALES</h2>
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
</body>
</html>