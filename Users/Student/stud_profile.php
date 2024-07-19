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

$stud_id = $_SESSION['user_id'];

// Displaying old data
$sql = "SELECT * FROM students WHERE stud_id = '$stud_id'";
$result = $conn->query($sql);

if (!$result) {
  die("Invalid Query");
}
while ($row = $result->fetch_assoc()) {
  $stud_photo = $row['stud_photo'];
  $stud_fname = $row['stud_fname'];
  $stud_lname = $row['stud_lname'];
  $gender = $row['stud_gender'];
  $stud_phno = $row['stud_phno'];
  $stud_email = $row['stud_email'];
  $stud_gender = $row['stud_gender'];
  $stud_edu_bg = $row['stud_edu_bg'];
  $stud_college_name = $row['stud_college_name'];
  $stud_hometown = $row['stud_hometown'];
  $stud_gd_name = $row['stud_gd_name'];
  $stud_gd_phno = $row['stud_gd_phno'];
  $stud_usernm = $row['stud_username'];
  $stud_password = $row['stud_password'];
}
?>


<?php
if (isset($_POST['save_photo'])) {
  if (isset($_FILES['stud_profile_photo']) && $_FILES['stud_profile_photo']['error'] === UPLOAD_ERR_OK) {
    // The file input field value has changed, process the new image
    $filename = $_FILES["stud_profile_photo"]["name"];
    $tempname = $_FILES["stud_profile_photo"]["tmp_name"];
    $folder = "../images/students/" . $filename;
    move_uploaded_file($tempname, $folder);

    // Update the database with the new image path
    $sql = "UPDATE students SET stud_photo = '$folder' WHERE stud_id = '$stud_id'";
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
    $folder = $dimg;
  }
}
?>

<?php
if (isset($_POST['save_profile'])) {
  $fname = $_POST['stud_fn'];
  $lname = $_POST['stud_ln'];
  $un = $_POST['stud_un'];
  $gender = $_POST['gender'];
  $pass = $_POST['stud_pass'];

  $sql = "UPDATE students SET stud_fname= '$fname', stud_gender= '$gender', stud_lname= '$lname', stud_username = '$un', stud_password = '$pass' WHERE stud_id = '$stud_id'";
  $result = mysqli_query($conn, $sql);
  
  $sql2 = "UPDATE user_stud SET stud_username = '$un', stud_password = '$pass' WHERE stud_id = '$stud_id'";
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
  $mail = $_POST['stud_email'];
  $phno = $_POST['stud_phno'];

  $sql = "UPDATE students SET stud_email = '$mail', stud_phno = '$phno' WHERE stud_id = '$stud_id'";
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
<?php
if (isset($_POST['save_extra'])) {
  $gdname = $_POST['stud_gname'];
  $gdphno = $_POST['stud_gphno'];
  $edu = $_POST['stud_edu'];
  $clg = $_POST['stud_clg'];
  $home = $_POST['stud_home'];

  $sql = "UPDATE students SET `stud_edu_bg`='$edu',`stud_college_name`='$clg',`stud_hometown`='$home',`stud_gd_name`='$gdname',`stud_gd_phno`='$gdphno' WHERE stud_id = '$stud_id'";
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
  <title>Home - EZRooms</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=d3f7704f27950e30f79f7693f94faa7c">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic&amp;display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
  <link rel="stylesheet" href="assets/css/styles.min.css?h=a854b57ef9592cf677f3407274b69b24">
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
  <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-dark" id="mainNav">
    <div class="container"><a class="navbar-brand text-capitalize" href="index.php"
        style="font-weight: bold;font-style: italic;font-size: 23px;">EZRooms</a><button data-bs-toggle="collapse"
        data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
        style="color: rgba(247,247,247,0.55);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
          fill="currentColor" viewBox="0 0 16 16" class="bi bi-card-text" style="color: rgb(255,255,255);">
          <path
            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z">
          </path>
          <path
            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z">
          </path>
        </svg></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"></li>
          <li class="nav-item"><a class="nav-link text-capitalize" href="index.php"
              style="color: rgb(255,255,255);margin-top: 13px;">Home</a></li>
          <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="fav_rooms.php" style="color: rgb(255,255,255);margin-top: 13px;">Favorites Rooms</a></li>
          <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="profile_rating.php" style="color: rgb(255,255,255);margin-top: 13px;">Profile Ratings</a></li>
              <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="requests.php" style="color: rgb(255,255,255);margin-top: 13px;">Call Requests</a></li>
          <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="stud_profile.php" style="color: rgb(255,255,255);margin-top: 13px;">Profile</a></li>
          <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="logout.php" style="color: rgb(255,255,255);margin-top: 13px;">Logout&nbsp;</a></li>

          <?php
          // Assuming $_SESSION['stud_id'] is set after a successful login
          $stud_id = $_SESSION['user_id'];
          include("../connection.php");
          // Fetch student details using stud_id
          $sql = "SELECT stud_fname, stud_lname, stud_photo FROM students WHERE stud_id = '$stud_id'";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            if ($result->num_rows == 1) {
              $student = mysqli_fetch_assoc($result);
              $stud_username = $student['stud_fname'] . " " . $student['stud_lname'];
              $stud_photo = $student['stud_photo'];
            } else {
              // Handle the case when the student is not found
              $stud_username = 'N/A';
              $stud_photo = 'https://shorturl.at/ptQS8'; // Provide a default photo or handle it based on your requirements
            }
            mysqli_free_result($result);
          } else {
            // Handle the case when there's an error in the query
            $stud_username = 'N/A';
            $stud_photo = 'https://shorturl.at/ptQS8';
          }
          mysqli_close($conn);
          ?>
          <!-- HTML code to display the student name and photo -->
          <li class="nav-item text-capitalize" style="color: rgb(255, 255, 255);">
            <div class="d-inline-flex">
              <p style="margin-right: 11px; margin-top: 18px; height: 11px;"><em>
                  <?php echo $stud_username; ?>
                </em></p>
              <img class="border rounded-circle img-profile" src="<?php echo $stud_photo; ?>" width="60" height="52">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="content" style="margin-top: 100px;">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-lg-4">
          <div class="card mb-3">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="card-body text-center shadow">
                <img class="rounded-circle mb-3 mt-4" src="<?php echo $stud_photo; ?>" width="160" height="160">
                <div class="mb-3">
                  <input type="file" name="stud_profile_photo" accept="image/png, image/jpg, image/jpeg">
                  <br><br>
                  <button class="btn btn-primary btn-sm" type="submit" name="save_photo">Change Photo</button>
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
                          <input class="form-control" type="text" id="first_name" name="stud_fn" required
                            pattern="[A-Za-z\s]+" title="Please enter only letters" value="<?php echo $stud_fname; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="last_name"><strong>Last
                              Name</strong></label>
                          <input class="form-control" type="text" id="last_name" placeholder="Doe" name="stud_ln"
                            pattern="[A-Za-z\s]+" title="Please enter only letters" required
                            value="<?php echo $stud_lname; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div style="display: flex; flex-wrap: wrap;">
                        <label for=""><b>Select Gender : </b>&nbsp;</label>
                        <div class="form-check" style="margin-right: 10px;">
                          <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check" style="margin-right: 10px;">
                          <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check" style="margin-right: 10px;">
                          <input class="form-check-input" type="radio" name="gender" id="other" value="Other" <?php echo ($gender === 'Other') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="other">Other</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="email"><strong>Username</strong></label>
                          <input class="form-control" type="text" id="email" name="stud_un" required pattern="^[a-zA-Z0-9_]{3,20}$"
    title="Username must be 3-20 characters long and can contain letters, numbers, and underscores only"
                            value="<?php echo $stud_usernm; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="email"><strong>Password</strong></label>
                          <input class="form-control" type="text" id="email-1" name="stud_pass" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{4,}$"
    title="Password must be at least 4 characters long, contain at least one uppercase letter, one lowercase letter, and one special character"
                            value="<?php echo $stud_password; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <button class="btn btn-primary btn-sm" type="submit" name="save_profile">&nbsp;Save&nbsp;</button>
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
                          <input class="form-control" type="text" id="city" name="stud_phno"
                            value="<?php echo $stud_phno; ?>" pattern="\d{10}"
                            title="Please enter a 10-digit contact number" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="country"><strong>Email</strong></label>
                          <input class="form-control" type="email" id="email-2" name="stud_email"
                            value="<?php echo $stud_email; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
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

              <div class="card shadow mb-3" style="margin-top: 29px;">
                <div class="card-header py-3">
                  <p class="text-primary m-0 fw-bold">Students Profile</p>
                </div>
                <div class="card-body">
                  <form action="#" method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="first_name"><strong>Guardian
                              Name</strong></label>
                          <input class="form-control" type="text" id="first_name-1" name="stud_gname" required
                            pattern="[A-Za-z\s]+" title="Please enter only letters"
                            value="<?php echo $stud_gd_name; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="last_name"><strong>Guardian Contact
                              No.</strong></label>
                          <input class="form-control" type="text" id="last_name-1" placeholder="Doe" name="stud_gphno"
                            required pattern="\d{10}" title="Please enter a 10-digit contact number"
                            value="<?php echo $stud_gd_phno; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="email"><strong>Home Town</strong></label>
                          <input class="form-control" type="text" id="email-3" placeholder="jhon12" name="stud_home"
                            required pattern="[A-Za-z\s]+" title="Please enter only letters"
                            value="<?php echo $stud_hometown; ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="email"><strong>Current Educational
                              Status</strong></label>
                          <input class="form-control" type="text" id="email-4" placeholder="abcd" name="stud_edu"
                            required value="<?php echo $stud_edu_bg; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label class="form-label" for="email"><strong>College/School
                              Name</strong></label>
                          <input class="form-control" type="text" id="email-5" name="stud_clg" required
                            value="<?php echo $stud_college_name; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit"
                        name="save_extra">&nbsp;Save&nbsp;</button>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
</body>

</html>