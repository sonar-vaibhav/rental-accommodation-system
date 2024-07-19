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
include '../connection.php';
$studId = $_SESSION['user_id'];
$sql = "SELECT * FROM student_reviews WHERE stud_id = '$studId'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Fetch the data as an associative array
  $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Free result set
  mysqli_free_result($result);
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$studId = $_SESSION['user_id'];
$calc = "SELECT AVG(str_rating) as avg_rating, COUNT(*) as total_ratings FROM student_reviews WHERE stud_id = '$studId'";
$result2 = mysqli_query($conn, $calc);

if ($result2) {
  $data = mysqli_fetch_assoc($result2);
  $avgRating = number_format($data['avg_rating'], 1);
  $totalRatings = $data['total_ratings'];
} else {
  // Handle the error or set default values
  $avgRating = 0;
  $totalRatings = 0;
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
  <link rel="stylesheet" href="assets/css/styles.min.css?h=a854b57ef9592cf677f3407274b69b24">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
</head>
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

  <div class="container" style="margin-top: 111px;">
  </div>

  <div style="margin: 35px;margin-top: 15px;" id="ownerTable">
    <div class="col">
      <div class="card shadow">
        <div class="card-header py-3">
          <p class="text-primary m-0 fw-bold">Requests made by you to Room Owner</p>
        </div>
        <div class="card-body">
          <div class="row">
          </div>
          <input type="search" class="form-control form-control-sm" id="ownerSearch" placeholder="Search by Name"
            style="font-size: 17px;" hidden>
          <br>
          <!-- DataTable -->
          <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
            <table id="dataTable">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="searchResult">
                <?php
                include("../connection.php");
                $userId = $_SESSION['user_id'];

                $sql2 = "SELECT * FROM request_call WHERE stud_id = '$userId'";
                $result2 = $conn->query($sql2);

                while ($rowRequest = $result2->fetch_assoc()) {
                  $sqlOwner = "SELECT * FROM owners WHERE owner_id = '$rowRequest[owner_id]'";
                  $resultOwner = $conn->query($sqlOwner);

                  if ($rowOwner = $resultOwner->fetch_assoc()) {
                    echo "
                      <tr>
                          <td><img src='$rowOwner[owner_photo]' alt='Room Owner Profile' width='80px' height='50px'></td>
                          <td>$rowOwner[owner_fname]</td>
                          <td>$rowOwner[owner_lname]</td>
                          <td>$rowOwner[owner_email]</td>
                          <td>";
                          if($rowRequest['req_status'] === 'accepted') {
                           echo "Accepted";
                           echo " &nbsp;";
                           echo " &nbsp;";
                           echo "<button style='margin-top:10px' class='btn btn-primary btn-sm' data-bs-toggle='modal' 
                                                data-bs-target='#profileModal_$rowOwner[owner_id]'>Profile &nbsp;<i
                                                    class='fa-solid fa-eye'></i>
                                            </button>";
                            echo "<div class='modal fade' id='profileModal_$rowOwner[owner_id]' tabindex='-1'
                            aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content' style='background-color:white;'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Room Owner Profile Details
                                        </h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal'
                                            aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='table-responsive table mt-2' id='dataTable-1' role='grid'
                                            aria-describedby='dataTable_info'>
                                            <table class='table my-0' id='dataTable'>
                                                <tbody>
                                                    ";
                                                        echo "
                                                                    <tr>
                                                                        <td> <img src='$rowOwner[owner_photo]' style='border-radius: 42px;width: 60px;height: 60px;'> 
                                                                        &nbsp; &nbsp; $rowOwner[owner_fname] $rowOwner[owner_lname]</td>
                                                                    </tr>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Contact No. : $rowOwner[owner_phno]</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mail : $rowOwner[owner_email]</td>
                                                                    </tr>
                                                                    ";

                                                    echo "
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                          } 
                          else {
                            echo "Pending";
                          }  
                          echo "</td>
                      </tr>
                      ";
                  }
                  
                }
                ?>

              </tbody>
            </table>
          </div>

          <script>
            $(document).ready(function () {
              // Initialize DataTable
              // $('#dataTable').DataTable();
              $('#dataTable').DataTable({
                "pageLength": 10, // Set the number of rows per page to 2
                "ordering": true, // Enable sorting
                // Add other options as needed
              });

              // Search functionality
              $('#ownerSearch').on('input', function () {
                var searchTerm = $(this).val();

                // Call the PHP script using AJAX
                $.ajax({
                  type: 'POST',
                  url: 'search_owners.php',
                  data: { search: searchTerm },
                  success: function (response) {
                    $('#searchResult').html(response);

                    // Refresh DataTable after updating the content
                    $('#dataTable').DataTable();
                  },
                  error: function (error) {
                    console.log(error);
                  }
                });
              });
            });
          </script>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
</body>

</html>