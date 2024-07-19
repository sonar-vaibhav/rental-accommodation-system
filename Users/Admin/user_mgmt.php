<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // user is not logged in, redirect to login page or show an access denied message
    echo "
    <script>
        alert('Log In First to Access this Page');
        setTimeout(function() {
            window.location.href = 'login.html';
        }, 1000);
    </script>";
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span class="text-capitalize">EZRooms</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span
                                style="margin: -2px;margin-left: 6px;">Dashboard</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="manage%20room.php"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Manage Rooms</span></a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="user_mgmt.php"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 -64 640 640" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M592 288H576V212.7c0-41.84-30.03-80.04-71.66-84.27C456.5 123.6 416 161.1 416 208V288h-16C373.6 288 352 309.6 352 336v128c0 26.4 21.6 48 48 48h192c26.4 0 48-21.6 48-48v-128C640 309.6 618.4 288 592 288zM496 432c-17.62 0-32-14.38-32-32s14.38-32 32-32s32 14.38 32 32S513.6 432 496 432zM528 288h-64V208c0-17.62 14.38-32 32-32s32 14.38 32 32V288zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM320 336c0-8.672 1.738-16.87 4.303-24.7C308.6 306.6 291.9 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512h301.7C326.3 498.6 320 482.1 320 464V336z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">User Management</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span style="margin: -2px;margin-left: 6px;">Logout</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                
                            </li>
                        </ul>
                    </div>
                </nav>

                <?php
                include '../connection.php';

                // Default table names
                $selectedTable = 'students';

                // Check if the user selected a specific account type
                if (isset($_GET['account_type'])) {
                    $selectedTable = $_GET['account_type'];
                }

                $tableName = $selectedTable === 'students' ? 'students' : 'owners';

                ?>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Users</h3>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" aria-expanded="false"
                                data-bs-toggle="dropdown" type="button">Select User&nbsp;</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="?account_type=students">Students</a>
                                <a class="dropdown-item" href="?account_type=owners">Room Owners</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="table-responsive mt-2" id="dataTable-1" role="grid"
                                aria-describedby="dataTable_info">
                                <!-- Assuming you have a function to fetch data from the database based on $tableName -->
                                <?php $data = fetchDataFromDatabase($conn, $tableName); ?>

                                <table class="table table-bordered table-striped my-0" id="dataTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center d-block">Date of Registration</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center"><strong>Email</strong></th>
                                            <th class="text-center"><strong>Contact No.</strong></th>
                                            <th class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Function to check if a user is already approved
                                        function isUserApproved($conn, $selectedTable, $userId)
                                        {
                                            $approvalTable = ($selectedTable === 'students') ? 'user_stud' : 'user_owner';
                                            $idColumn = ($selectedTable === 'students') ? 'stud_id' : 'owner_id';

                                            $sql = "SELECT COUNT(*) as count FROM $approvalTable WHERE $idColumn = '$userId'";
                                            $result = mysqli_query($conn, $sql);

                                            if ($result) {
                                                $row = mysqli_fetch_assoc($result);
                                                return $row['count'] > 0;
                                            } else {
                                                return false;
                                            }
                                        }
                                        ?>
                                        <!-- Loop through $data to display rows -->
                                        <?php foreach ($data as $row): ?>
                                            <?php
                                            $idColumn = ($selectedTable === 'students') ? 'stud_id' : 'owner_id';
                                            $userId = $row[$idColumn];

                                            // Check if the user ID is already present in the approval table
                                            if (!isUserApproved($conn, $selectedTable, $userId)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['acs_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= isset($row['owner_username']) ? $row['owner_username'] : $row['stud_username'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // Check the table type and display name accordingly
                                                        if (isset($row['owner_fname'])) {
                                                            echo $row['owner_fname'] . ' ' . $row['owner_lname'];
                                                        } elseif (isset($row['stud_fname'])) {
                                                            echo $row['stud_fname'] . ' ' . $row['stud_lname'];
                                                        } else {
                                                            echo 'N/A'; // Adjust this as needed
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= isset($row['owner_email']) ? $row['owner_email'] : $row['stud_email'] ?>
                                                    </td>
                                                    <td>
                                                        <?= isset($row['owner_phno']) ? $row['owner_phno'] : $row['stud_phno'] ?>
                                                    </td>
                                                    <!-- Add other columns as needed -->

                                                    <td>
                                                        <?php
                                                        // Approve Button
                                                        $approveLink = "approve.php?id=" . urlencode($userId) . "&account_type=" . urlencode($selectedTable);
                                                        echo "<a style='margin-left:10px;' href=\"$approveLink\" class=\"btn btn-primary\" role=\"button\">Approve</a>";

                                                        // Delete Button
                                                        $deleteLink = "delete.php?id=" . urlencode($userId) . "&account_type=" . urlencode($selectedTable);
                                                        // echo "$deleteLink";
                                                        echo "<a style='margin-left:10px;' href=\"$deleteLink\" class=\"btn btn-danger\" name=\"delete\" role=\"button\">Delete</a>";

                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // Function to fetch data from the database based on $tableName
                function fetchDataFromDatabase($conn, $tableName)
                {
                    // Define the SQL query based on the $tableName
                    $sql = "SELECT * FROM $tableName";

                    // Execute the query
                    $result = mysqli_query($conn, $sql);

                    // Check if the query was successful
                    if ($result) {
                        // Fetch the data as an associative array
                        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        // Free the result set
                        mysqli_free_result($result);

                        // Return the fetched data
                        return $data;
                    } else {
                        // If the query failed, you may want to handle the error or log it
                        // For now, returning an empty array
                        return [];
                    }
                }
                ?>

            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © EZRooms 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>