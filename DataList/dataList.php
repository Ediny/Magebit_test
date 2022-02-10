<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email list</title>
    <meta name="description" content="Magebit test page">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/index.css">

</head>

<body>

    <div class="main-screen flex-center">
        <h1>Email list</h1>
        <div class="email-control-wrapper flex-center">

            <div class="email-control-buttons flex-center">
                <div>
                    <form class="search-wrapper" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="search-bar">
                            <input type="text" name="input-search" class="input-search">
                            <button name="search" class="btn-search" type="submit">Search</button>
                        </div>
                        <!-- // Search input -->
                        <input type="submit" value="Export CSV" name="csv" form="main-form">
                        <!-- // CSV export button -->
                        <div id="sorting-btns">
                            <span>Sort by:</span>
                            <input type="submit" name='date' value="Date">
                            <input type="submit" name='name' value='Name'>
                        </div>
                        <!-- // Sorting buttons -->

                    </form>
                </div>
            </div>
        </div>
        <form id="main-form" action="../PHP/export-csv.php" method="POST" enctype="multipart/form-data">
            <div class="email-list-wrapper flex-center">
                <table>
                    <thead>
                        <th></th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php

                        require_once '../PHP/fetchTasks.php';

                        //determine which page number visitor is currently on  
                        if (!isset($_GET['page'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $controler = new Fetch();

                        // Sets the Order
                        if (isset($_POST['name'])) {
                            $controler->setOrder('email_name');
                        } else {
                            $controler->setOrder(('date'));
                        }

                        // Fetches all results
                        $rows = $controler->fetch();

                        if (!empty($rows)) {
                            foreach ($rows as $row) {

                        ?>
                                <tr>
                                    <td><input type="checkbox" name="check_list[]" value="<?php echo $row['id'] ?>" /></td>
                                    <td><?php echo $row['email_name'] ?></td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td class="btn-delete"><a href="../PHP/delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "You have no emails";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php

            // Tried to make pagenation work with no results
            require_once '../PHP/fetchTasks.php';

            $pager = new Fetch();
            $number = $pager->getNumber();
            //display the link of the pages in URL  
            for ($page = 1; $page <= $number; $page++) {
                echo '<a href = "dataList2.php?page=' . $page . '">' . $page . ' </a>';
            }

            ?>
        </form>
    </div>
</body>

</html>
