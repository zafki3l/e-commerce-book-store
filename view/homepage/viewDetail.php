<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/viewDetail.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($book['bookName']); ?></title>
    <link rel="stylesheet" href="../../public/css/homepage/bookDetail.css">
</head>
<body>
    <?php if ($book): ?>
        <div class="book-detail">
            <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']); ?>" 
                 alt="<?php echo htmlspecialchars($book['bookName']); ?>">
            <h2><?php echo htmlspecialchars($book['bookName']); ?></h2>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Price:</strong> <?php echo htmlspecialchars($book['price']); ?> VND</p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>

            <form action="\bookStore\backend\buyNow.php" method="post">
                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-buy-now">Buy now</button>
            </form>
        </div>
    <?php else: ?>
        <p>Book not found!</p>
    <?php endif; ?>
</body>
</html>