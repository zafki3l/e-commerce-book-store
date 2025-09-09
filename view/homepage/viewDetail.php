<?php 
    include_once(__DIR__ . '/../../config.php');    
    include_once(ROOT_PATH . '/backend/viewDetail.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($book['bookName']); ?></title>
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <link rel="stylesheet" href="../../public/css/homepage/viewDetail.css">
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>
    <div class="header">
        <ul type="none" class="user-menu">
            <div class="search-bar">
                <form action="\bookStore\view\homepage\searchResult.php" method="get">
                    <input type="text" name="search" placeholder="Search books..."/>
                </form> 
            </div>
        </ul>
    </div>

    <div class="main-content">
        <?php if ($book): ?>
            <div class="infor-book">
                <div class="img-book">
                    <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']); ?>" 
                        alt="<?php echo htmlspecialchars($book['bookName']); ?>">
                </div>
                <div class="text-infor">
                    <div class="name-book">
                        <h1><?php echo htmlspecialchars($book['bookName']); ?></h1>
                    </div>
                    <div class="content-infor">
                        <div class="brand-book">
                            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        </div>
                        <div class="content-summary">
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
                        </div>

                        <div class="buy-now">
                            <div class="price-book">
                                <h1><?php echo htmlspecialchars($book['price']); ?> VND</h1>
                            </div>
                            <div class="btn-order">
                                <form action="\bookStore\backend\buyNow.php" method="post">
                                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-buy-now">Buy now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        <?php else: ?>
            <p>Book not found!</p>
        <?php endif; ?>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>