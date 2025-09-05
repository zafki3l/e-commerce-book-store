<?php 
    include_once('../../config.php');

    $result = include(ROOT_PATH . '/backend/searchBar/searchLogic.php');
    $books = $result['data'];
    $search = $result['search'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="../../public/css/layouts/homepage/homepage.css">
</head>
<body>
    <h2>Search results for: <i><?= htmlspecialchars($search) ?></i></h2>
    <div class="book-grid">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <img src="../../public/images/<?= htmlspecialchars($book['bookCover']) ?>" alt="<?= htmlspecialchars($book['bookName']) ?>">
                    <h3><?= htmlspecialchars($book['bookName']) ?></h3>
                    <p>Author: <?= htmlspecialchars($book['author']) ?></p>
                    <p>Price: <?= htmlspecialchars($book['price']) ?> VND</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books found!</p>
        <?php endif; ?>
    </div>
</body>
</html>
