<?php
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/books/findBook.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();

    $username = $_SESSION['username'];
    $bookList = getFindBook($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\bookIndex.css">
    <title>Index Book</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS BOOK MANAGEMENT</h2>
        <h3>WELCOME, <?php echo htmlspecialchars($username); ?></h3>
        <form action="bookIndex.php" method="post">
            <input type="text" name="book" id="book" placeholder="Find book by name, author, or id">
            <input type="submit">
        </form>
        <br>
        <a href="addBook.php">Add book</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Book Cover</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bookList as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['id']) ?></td>
                        <td><?php echo htmlspecialchars($book['bookName']) ?></td>
                        <td><?php echo htmlspecialchars($book['author']) ?></td>
                        <td><?php echo htmlspecialchars($book['publisher']) ?></td>
                        <td><?php echo htmlspecialchars($book['category']) ?></td>
                        <td><?php echo htmlspecialchars($book['description']) ?></td>
                        <td><?php echo htmlspecialchars($book['price']) ?></td>
                        <td><?php echo htmlspecialchars($book['quantity']) ?></td>
                        <td><?php echo htmlspecialchars((($book['status'] > 0) ? "In stock" : "Out stock")) ?></td>
                        <td><?php echo htmlspecialchars($book['bookCover']) ?></td>
                        <td><?php echo htmlspecialchars($book['created_at']) ?></td>
                        <td><?php echo htmlspecialchars($book['update_at']) ?></td>
                        <td>
                            <a href="editBook.php?id=<?php echo htmlspecialchars($book['id']) ?>">Edit</a>
                            <form action="../../../backend/books/deleteBook.php" method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>