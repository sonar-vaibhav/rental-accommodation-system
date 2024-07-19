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

// Close the connection
mysqli_close($conn);
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
<style>
  #ownerTable {
    display: none;
  }
</style>
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
    <div class="row justify-content-center" style="margin: 0px;">
      <div class="col-md-6 col-xl-3 mb-4" style="margin: 0px;">
        <div class="card shadow border-start-info py-2">
          <div class="card-body">
            <div class="row align-items-center no-gutters">
              <div class="col me-2">
                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Your Average Rating</span></div>
                <div class="row g-0 align-items-center">
                  <div class="col-auto">
                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>
                        <?php echo $avgRating; ?>
                      </span></div>
                  </div>
                </div>
              </div>
              <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em"
                  height="1em" fill="currentColor" class="fa-2x text-gray-300"
                  style="color: var(--bs-warning);font-size: 40px;"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z">
                  </path>
                </svg></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
          <div class="card-body">
            <div class="row align-items-center no-gutters">
              <div class="col me-2">
                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Room&nbsp; owners rated you</span>
                </div>
                <div class="text-dark fw-bold h5 mb-0"><span>
                    <?php echo $totalRatings; ?>
                  </span></div>
              </div>
              <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em"
                  height="1em" fill="currentColor" class="fa-2x text-gray-300"
                  style="font-size: 42px;"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z">
                  </path>
                </svg></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-inline-flex" style="margin-top: 0px;margin-left: 36px;">
    <button class="btn btn-primary text-capitalize" type="button" style="background: var(--swiper-theme-color);"
      onclick="showTable();">
     Room Owners of you </button>
  </div>
  <div class="d-inline-flex" style="margin-top: 0px;margin-left: 36px;">
    <a class="btn btn-primary text-capitalize" type="button" style="background: var(--swiper-theme-color);"
      href="form.php">See Form</a>
  </div>

  <script>
    function showTable() {
      var table = document.getElementById('ownerTable');
      table.style.display = "block";
    }
  </script>

  <div style="margin: 35px;margin-top: 15px;" id="ownerTable">
    <div class="col">
      <div class="card shadow">
        <div class="card-header py-3">
          <p class="text-primary m-0 fw-bold">Room Owners</p>
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
                  <th>Mobile No.</th>
                  <th>Entered Date</th>
                  <th>Exited Date</th>
                  <th>Still a Tenant</th>
                </tr>
              </thead>
              <tbody id="searchResult">
                <?php
                include("../connection.php");
                $studid = $_SESSION['user_id'];
                $sql = "SELECT * FROM tenants WHERE stud_id = '$studid'";
                $result = $conn->query($sql);
                if (!$result) {
                  die("Invalid Query");
                }
                $hasData = false;
                while ($row = $result->fetch_assoc()) {
                  $hasData = true;
                  
                  $sql2 = "SELECT * FROM owners WHERE owner_id = '$row[owner_id]'";
                  $result2 = $conn->query($sql2);
                  while ($row2 = $result2->fetch_assoc()) {
                  echo "
                  <tr>
                      <td><img src='$row2[owner_photo]' alt='Room Owner Profile' width='80px' height='50px'></td>
                      <td>$row2[owner_fname]</td>
                      <td>$row2[owner_lname]</td>
                      <td>$row2[owner_phno]</td>
                      <td>$row[added_date]</td>
                      <td>";
                      echo ($row['removed_date'] === '0000-00-00') ? '' : $row['removed_date'];
                      echo "</td>
                      <td>$row[still_tenant]</td>
                  </tr>
                  ";
                  }
                }

                if (!$hasData) {
                  echo "
                     <tr>
                         <td colspan='5'> <b> No Data Found </b> </td>
                     </tr>
                 ";
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


  <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin: 0;margin-left: 30px;margin-right: 30px;">
    <?php foreach ($reviews as $review):
      $ownersql = "SELECT owner_photo,owner_fname,owner_lname FROM owners WHERE owner_id = '$review[owner_id]'";
      $ownerresult = mysqli_query($conn, $ownersql);
      $ownerdata = mysqli_fetch_assoc($ownerresult);
      $ownerphoto = $ownerdata['owner_photo'];
      $ownerfname = $ownerdata['owner_fname'];
      $ownerlname = $ownerdata['owner_lname'];

      ?>
      <div class="col">
        <div class="card" style="border-radius: 19px; padding: 15px; padding-top: 15px;">
          <div class="d-flex" style="margin-top: 0; margin-left: 8;">
            <img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="47" height="44"
              src="<?php echo $ownerphoto;?>" style="margin-left: 3px;">
            <div>
              <p class="fw-bold mb-0" style="margin-top: 11px; font-size: 18px;"><?php echo $ownerfname ." ". $ownerlname?></p>
            </div>
            <div class="d-inline-flex" style="height: 36px; margin: 3px; margin-left: 46px; margin-right: 38px;">
              <p class="d-inline-flex float-start" style="margin-left: 7px; margin-top: 1px; font-size: 20px;">
                <?php echo $review['str_rating']; ?> &nbsp; <i class="fa-solid fa-star" style="color: #FFD43B;margin-top: 5px;"></i>
              </p>
            </div>
          </div>

          <?php
          $originalDate = $review['str_date'];
          $dateTime = new DateTime($originalDate);
          $formattedDate = $dateTime->format('d-m-Y');
          ?>

          <div class="d-flex" style="margin-top: 0; margin-left: 0; text-align: justify;">
            <p class="text-start" style="font-size: 18px; margin-top: 17px; margin-left: 5px;"><span
                style="color: rgb(0, 0, 0);">Date :</span>&nbsp;
              <?php echo $formattedDate; ?>
            </p>
          </div>
          <div class="d-flex" style="margin-top: 0; margin-left: 0; text-align: justify;">
            <p class="text-start" style="margin-left: 5px; margin-top: 0px; font-size: 18px;"><span
                style="color: rgb(0, 0, 0);">
               Review : <?php echo $review['str_review']; ?>
              </span></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
</body>

</html>