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
            window.location.href = '../../login.html';
        }, 1000);
    </script>";
  exit();
}
?>

<?php
include("../connection.php");

$owner_id = $_SESSION['user_id'];

// Displaying old data
$sql = "SELECT * FROM owners WHERE owner_id = '$owner_id'";
$result = $conn->query($sql);

if (!$result) {
  die("Invalid Query");
}
while ($row = $result->fetch_assoc()) {
  $owner_photo = $row['owner_photo'];
  $owner_fname = $row['owner_fname'];
  $owner_lname = $row['owner_lname'];
  $owner_phno = $row['owner_phno'];
  $owner_email = $row['owner_email'];
  $owner_usernm = $row['owner_username'];
  $owner_password = $row['owner_password'];
}
?>


<?php
if (isset($_POST['save_photo'])) {
  if (isset($_FILES['owner_profile_photo']) && $_FILES['owner_profile_photo']['error'] === UPLOAD_ERR_OK) {
    // The file input field value has changed, process the new image
    $filename = $_FILES["owner_profile_photo"]["name"];
    $tempname = $_FILES["owner_profile_photo"]["tmp_name"];
    $folder = "../images/owners/" . $filename;
    move_uploaded_file($tempname, $folder);

    // Update the database with the new image path
    $sql = "UPDATE owners SET owner_photo = '$folder' WHERE owner_id = '$owner_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "
          <script>
              alert('Data Updated');
              window.history.back();
          </script>";
    } else {
      echo "
          <script>
              alert('Error updating data');
              window.history.back();
          </script>";
    }
  } else {
    // The file input field value has not changed, use the previous image
    // $folder = $dimg;
  }
}
?>
<?php
if (isset($_POST['save_profile'])) {
  $fname = $_POST['owner_fn'];
  $lname = $_POST['owner_ln'];
  $un = $_POST['owner_un'];
  $pass = $_POST['owner_pass'];

  $sql = "UPDATE owners SET owner_fname= '$fname', owner_lname= '$lname', owner_username = '$un', owner_password = '$pass' WHERE owner_id = '$owner_id'";
  $result = mysqli_query($conn, $sql);

  $sql2 = "UPDATE user_owner SET owner_username = '$un', owner_password = '$pass' WHERE owner_id = '$owner_id'";
  $result2 = mysqli_query($conn, $sql2);

  if ($result && $result2) {
    echo "
            <script>
                alert('Data Updated');
                window.history.back();
            </script>";
  }
}
?>
<?php
if (isset($_POST['save_contact'])) {
  $mail = $_POST['owner_email'];
  $phno = $_POST['owner_phno'];

  $sql = "UPDATE owners SET owner_email = '$mail', owner_phno = '$phno' WHERE owner_id = '$owner_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "
            <script>
                alert('Data Updated');
                window.history.back();
            </script>";
  }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
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
                            </svg><span style="margin: -2px;margin-left: 6px;">Manage Rooms</span></a><a
                            class="nav-link" href="rate_students.php"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M45.63 79.75L52 81.25v58.5C45 143.9 40 151.3 40 160c0 8.375 4.625 15.38 11.12 19.75L35.5 242C33.75 248.9 37.63 256 43.13 256h41.75c5.5 0 9.375-7.125 7.625-13.1L76.88 179.8C83.38 175.4 88 168.4 88 160c0-8.75-5-16.12-12-20.25V87.13L128 99.63l.001 60.37c0 70.75 57.25 128 128 128s127.1-57.25 127.1-128L384 99.62l82.25-19.87c18.25-4.375 18.25-27 0-31.5l-190.4-46c-13-3-26.62-3-39.63 0l-190.6 46C27.5 52.63 27.5 75.38 45.63 79.75zM359.2 312.8l-103.2 103.2l-103.2-103.2c-69.93 22.3-120.8 87.2-120.8 164.5C32 496.5 47.53 512 66.67 512h378.7C464.5 512 480 496.5 480 477.3C480 400 429.1 335.1 359.2 312.8z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Rate Students</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="call%20back%20req.php"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Call Back Requests</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="message.php"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -64 640 640" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M592 288H576V212.7c0-41.84-30.03-80.04-71.66-84.27C456.5 123.6 416 161.1 416 208V288h-16C373.6 288 352 309.6 352 336v128c0 26.4 21.6 48 48 48h192c26.4 0 48-21.6 48-48v-128C640 309.6 618.4 288 592 288zM496 432c-17.62 0-32-14.38-32-32s14.38-32 32-32s32 14.38 32 32S513.6 432 496 432zM528 288h-64V208c0-17.62 14.38-32 32-32s32 14.38 32 32V288zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM320 336c0-8.672 1.738-16.87 4.303-24.7C308.6 306.6 291.9 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512h301.7C326.3 498.6 320 482.1 320 464V336z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Admin Message</span></a><a
                            class="nav-link active" href="profile.php"><i class="fas fa-user"></i><span
                                style="margin: -2px;margin-left: 6px;">Profile</span></a>
                                <a
                            class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i><span
                                style="margin: -2px;margin-left: 6px;">Logout</span></a>
                            </li>
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
                            <?php
                            // Assuming $_SESSION['stud_id'] is set after a successful login
                            $owner_id = $_SESSION['user_id'];
                            include("../connection.php");
                            // Fetch student details using stud_id
                            $sql = "SELECT owner_fname, owner_lname, owner_photo FROM owners WHERE owner_id = '$owner_id'";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                if ($result->num_rows == 1) {
                                    $owner = mysqli_fetch_assoc($result);
                                    $owner_username = $owner['owner_fname'] . " " . $owner['owner_lname'];
                                    $owner_photo = $owner['owner_photo'];
                                } else {
                                    // Handle the case when the student is not found
                                    $owner_username = 'N/A';
                                    $owner_photo = 'https://shorturl.at/ptQS8'; // Provide a default photo or handle it based on your requirements
                                }
                                mysqli_free_result($result);
                            } else {
                                // Handle the case when there's an error in the query
                                $owner_username = 'N/A';
                                $owner_photo = 'https://shorturl.at/ptQS8';
                            }
                            ?>

                            <!-- Profile Logo -->
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php echo $owner_username; ?>
                                        </span>
                                        <img class="border rounded-circle img-profile"
                                            src="<?php echo $owner_photo; ?>" style="height:50px; width:50px;">
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">

                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="card-body text-center shadow">
                                        <img class="rounded-circle mb-3 mt-4" src="<?php echo $owner_photo; ?>"
                                            width="160" height="160">
                                        <div class="mb-3">
                                            <input type="file" name="owner_profile_photo"
                                                accept="image/png, image/jpg, image/jpeg">
                                            <br><br>
                                            <button class="btn btn-primary btn-sm" type="submit"
                                                name="save_photo">Change Photo</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">User Profile</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="first_name"><strong>First
                                                                    Name</strong></label>
                                                            <input class="form-control" type="text" id="first_name"
                                                                name="owner_fn" required pattern="[A-Za-z\s]+"
                                                                title="Please enter only letters"
                                                                value="<?php echo $owner_fname; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="last_name"><strong>Last
                                                                    Name</strong></label>
                                                            <input class="form-control" type="text" id="last_name"
                                                                placeholder="Doe" name="owner_ln" pattern="[A-Za-z\s]+"
                                                                title="Please enter only letters" required
                                                                value="<?php echo $owner_lname; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="email"><strong>Username</strong></label>
                                                            <input class="form-control" type="text" id="email"
                                                                name="owner_un" required pattern="^[a-zA-Z0-9_]{3,20}$"
    title="Username must be 3-20 characters long and can contain letters, numbers, and underscores only"
                                                                value="<?php echo $owner_usernm; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="email"><strong>Password</strong></label>
                                                            <input class="form-control" type="text" id="email-1"
                                                                name="owner_pass" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{4,}$"
    title="Password must be at least 4 characters long, contain at least one uppercase letter, one lowercase letter, and one special character"
                                                                value="<?php echo $owner_password; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary btn-sm" type="submit"
                                                        name="save_profile">&nbsp;Save&nbsp;</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card shadow" style="margin-top: 24px;">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Contact</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="city"><strong>Contact
                                                                    No.</strong></label>
                                                            <input class="form-control" type="text" id="city"
                                                                name="owner_phno" value="<?php echo $owner_phno; ?> "
                                                                pattern="\d{10}"
                                                                title="Please enter a 10-digit contact number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="country"><strong>Email</strong></label>
                                                            <input class="form-control" type="email" id="email-2"
                                                                name="owner_email" value="<?php echo $owner_email; ?>"
                                                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                                                title="Please enter a valid email address" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit"
                                                        name="save_contact">&nbsp;Save&nbsp;</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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