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
    <!-- <link rel="stylesheet" href="\bookStore\public\css\staff\books\bookIndex.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Index Book</title>

    <style>
        .bookmanage{
            display: flex;
        }

        .main-content {
            background-color: #ca122f;
            flex: 1;
            padding: 100px 0; 
        }

        html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /* display: flex; */
        flex-direction: column;
        }

        body {
        flex-direction: column;
        min-height: 100vh;
        }

        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        }
        
        .sidebar{
            width: 300px;
            height: 100vh;
            background-color: #faf9ea;
            color: #111014;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .name-user{
            text-align: center;
            padding-top: 15px;
            i{
                font-size: 80px;
                padding-bottom: 15px;
            }
        }

        hr{
            margin-top: 20px;
        }

        .btn{
            padding: 15px 30px 15px 5px;
            background-color: #faf9ea;
            border: none;
            font-size: 15px;
            width: 100%;
            border-radius: 10px;
            text-decoration: none;
            
        }

        .item-function{
            margin: 0px 20px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    
<div class="bookmanage">


    <!--Main content-->
    <div class="sidebar">
        <!-- <h2>THIS IS STAFF DASHBOARD</h2> -->
        <div class="name-user">
            <i class="fa-solid fa-circle-user"></i>
            <h3>WELCOME, <?php echo htmlspecialchars($username); ?></h3>
        </div>

        <hr>
        
        <br>

        <div class="function">
            <div class="item-function">
                <i class="fa-solid fa-book"></i>
                <a href="../books/bookIndex.php" class="btn">Book Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-receipt"></i>
                <a href="../orders/orderIndex.php" class="btn">Order Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-filter"></i>
                <a href="../createSalesReport.php" class="btn">Create Monthly Sales Report</a>
            </div>

        </div>
    </div>

    <div class="main-content">
        <div class="content-right">
        <div class="content1">

        </div>
        
        <h2>BOOK MANAGEMENT</h2>
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
    </div>
</div>
</body>
</html>