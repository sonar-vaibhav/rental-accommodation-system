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

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9, shrink-to-fit=no">
  <title>Home - EZRooms</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=d3f7704f27950e30f79f7693f94faa7c">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic&amp;display=swap">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
  <link rel="stylesheet" href="assets/css/styles.min.css?h=a854b57ef9592cf677f3407274b69b24">
  <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
  <style>
    @media (max-width: 768px) {
      .myTableRow {
        display: inline-grid !important;
      }

      .container {
        margin-left: -10px;
      }

      .container>p,
      .container>div {
        margin-left: 10px;
      }

      .d-inline-flex {
        margin-left: 10px !important;
      }

      .para_data {
        margin-left: 20px !important;
      }

      .table {
        margin-left: 0px !important;
      }
    }
  </style>
</head>
<script>document.body.style.zoom = "90%"</script>

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

  <?php
  include '../connection.php';

  $roomID = $_GET['room_id'];
  if (isset($_GET['room_id'])) {
    $roomId = $_GET['room_id'];
    // increase view by 1
    $viewssql = "UPDATE rooms SET room_views = room_views + 1 WHERE room_id = '$roomId'";
    $viewsresult = mysqli_query($conn, $viewssql);
  }
  // Assuming you have a function to fetch data from the database based on $tableName
  $roomData = fetchDataFromDatabase($conn, 'rooms');
  // Function to fetch data from the database based on $tableName
  function fetchDataFromDatabase($conn, $tableName)
  {
    $rid = $_GET['room_id'];
    // Define the SQL query based on the $tableName
    $sql = "SELECT * FROM $tableName WHERE room_id = '$rid'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
      // Fetch the data as an associative array
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // Free the result se
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

  <?php foreach ($roomData as $room): ?>
    <!-- Room Images -->
    <!-- Add this JavaScript to your page -->
    <script>
      // Function to open the modal with the clicked image
      function openImageModal(imageUrl) {
        // Set the source of the modal image
        document.getElementById('modalImage').src = imageUrl;
        // Open the modal
        $('#imageModal').modal('show');
      }
    </script>

    <div class="container-lg" style="margin-top: 100px;">
      <div class="row">
        <div class="col-md-12" style="margin-bottom: 9px;">
          <?php
          include '../connection.php';
          $roomId = $room['room_id'];

          // Assuming you have a function to fetch image URLs from the database based on room_id
          function fetchImageUrls($conn, $roomId)
          {
            $sql = "SELECT img_path FROM room_img WHERE room_id = '$roomId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
              $imageUrls = mysqli_fetch_all($result, MYSQLI_ASSOC);
              mysqli_free_result($result);
              return $imageUrls;
            } else {
              return [];
            }
          }

          // Fetch image URLs from the database
          $imageUrls = fetchImageUrls($conn, $roomId);
          ?>

          <div class="carousel slide" data-bs-ride="false" id="carousel-1"
            style="margin-top: 0; width: <?= $largestWidth; ?>px; height: <?= $largestHeight; ?>px;">
            <div class="carousel-inner">
              <?php foreach ($imageUrls as $index => $imageUrl): ?>
                <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                  <img class="w-100 h-100 d-block" src="<?php echo $imageUrl['img_path']; ?>" alt="Room Image"
                    onclick="openImageModal('<?php echo $imageUrl['img_path']; ?>')">
                </div>
              <?php endforeach; ?>
            </div>

            <div>
              <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
              </a>
            </div>

            <ol class="carousel-indicators">
              <?php foreach ($imageUrls as $index => $imageUrl): ?>
                <li data-bs-target="#carousel-1" data-bs-slide-to="<?= $index; ?>" <?= ($index === 0) ? 'class="active"' : ''; ?>></li>
              <?php endforeach; ?>
            </ol>
          </div>

          <!-- Modal to display enlarged image -->
          <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <img id="modalImage" class="w-100" alt="Enlarged Image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br>
    <div class="container">
      <table class="table">
        <tr class="myTable">
          <th>
            <!-- Owner  -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <div style="display:contents;">
                  <?php
                  // Assuming you have a database connection in $conn
                  include '../connection.php';

                  // Function to fetch owner details based on owner_id
                  function fetchOwnerDetails($conn, $ownerId)
                  {
                    // Prepare the SQL query
                    $sql = "SELECT owner_fname, owner_lname, owner_photo FROM owners WHERE owner_id = '$ownerId'";

                    // Execute the query
                    $result = mysqli_query($conn, $sql);

                    // Check if the query was successful
                    if ($result) {
                      // Fetch the result as an associative array
                      $row = mysqli_fetch_assoc($result);

                      // Free the result set
                      mysqli_free_result($result);

                      // Return the owner details
                      return $row;
                    } else {
                      // If the query failed, handle the error (you may log it or return an error message)
                      return false;
                    }
                  }

                  // Example usage to fetch owner details for the specified owner_id
                  $ownerId = $room['owner_id'];
                  $ownerDetails = fetchOwnerDetails($conn, $ownerId);

                  // Display the owner's photo, first name, and last name in the HTML
                  $ownerPhoto = $ownerDetails ? $ownerDetails['owner_photo'] : 'https://shorturl.at/oEJ57';
                  $ownerFullName = $ownerDetails ? $ownerDetails['owner_fname'] . ' ' . $ownerDetails['owner_lname'] : 'N/A';
                  ?>


                  <p class="d-inline-flex float-start" style="margin-right: 3px;">
                    <img src="<?php echo $ownerPhoto; ?>" alt="owner_profile image"
                      style="border-radius: 31px; width: 60px; height: 60px;">
                  </p>

                  <p class="fw-bold mb-0" style="margin-top: 14px; margin-left: 68px;">
                    Owner : <?php echo $ownerFullName; ?>
                  </p>
                </div>
              </div>
            </div>

            <!-- Rating and Star -->
            <div class="row">
              <!-- Rent -->
              <div class="col-md-auto">
                <?php
                // Assuming you have a database connection in $conn
                include '../connection.php';

                // Function to get average rating for a room based on room_id
                function getAverageRating($conn, $roomId)
                {
                  // Prepare the SQL query
                  $sql = "SELECT AVG(rr_rating) AS average_rating FROM room_reviews WHERE room_id = '$roomId'";
                  // Execute the query
                  $result = mysqli_query($conn, $sql);

                  // Check if the query was successful
                  if ($result) {
                    // Fetch the result as an associative array
                    $row = mysqli_fetch_assoc($result);

                    // Free the result set
                    mysqli_free_result($result);

                    // Return the average rating
                    return $row['average_rating'];
                  } else {
                    // If the query failed, handle the error (you may log it or return an error message)
                    return false;
                  }
                }

                // Example usage to get the average rating for a specific room (replace $roomId with the actual room ID)
                $roomId; // Replace this with the actual room ID
                $averageRating = getAverageRating($conn, $roomId);
                ?>

                <p class="d-inline-flex float-start" style="margin-left: 7px; margin-top: 1px; font-size: 18px;">
                  <?php echo number_format($averageRating, 1); ?>
                  <i class="fas fa-star" style="color: #FFD43B;"></i>
                </p>

              </div>

              <div class="col-md-auto">
                <p class="d-inline-flex float-start" style="font-size: 18px;">
                  Rs.
                  <?php echo $room['room_rent']; ?> / Month
                </p>
              </div>
            </div>

            <!-- TYpe and beds -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <b>Type : &nbsp;</b>
                  <?php echo ($room['room_type']); ?>
                </p>
              </div>
              <div class="col-md-auto">
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <b>No. of Beds : &nbsp;</b>
                  <?php echo ($room['room_beds']); ?>
                </p>
              </div>
            </div>

            <!-- Date -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <?php $originalDate = $room['room_upload_date']; // Replace this with your actual date variable
                
                  // Create a DateTime object from the original date
                  $dateTime = new DateTime($originalDate);

                  // Format the date as "DD MM YYYY"
                  $formattedDate = $dateTime->format('d-m-Y');
                  ?>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <b>Availability Date :&nbsp; &nbsp;</b>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($formattedDate); ?>
                </p>
              </div>
            </div>

            <!-- Gender -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <b>Prefered Gender for a Student: &nbsp;</b>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($room['room_gender']); ?>
                </p>
              </div>
            </div>

          </th>
          <th>
            <!-- Aminities -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-top: 0;margin-right: 4px;font-weight: bold;font-size: 21px;">
                  Amenities
                </p>
                <br><br>
                <?php
                // Function to fetch amenities based on room_id
                function fetchAmenities($conn, $roomId)
                {
                  // Prepare the SQL query to join the link table and amenities table
                  $sql = "SELECT ra.ram_name FROM room_aminities_link ral
            INNER JOIN room_aminities ra ON ral.ram_id = ra.ram_id
            WHERE ral.room_id = '$roomId'";

                  // Execute the query
                  $result = mysqli_query($conn, $sql);

                  // Check if the query was successful
                  if ($result) {
                    // Fetch the result as an associative array
                    $amenities = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    // Free the result set
                    mysqli_free_result($result);

                    // Return the amenities data
                    return $amenities;
                  } else {
                    // If the query failed, handle the error (you may log it or return an error message)
                    return [];
                  }
                }

                // Example usage to fetch amenities for the specified room_id
                $roomId = $room['room_id'];
                $amenitiesData = fetchAmenities($conn, $roomId);

                // Display the amenities in the HTML
                if (!empty($amenitiesData)) {


                  echo '<table class="table table-striped table-hover" style="width: max-content;">';
                  foreach ($amenitiesData as $amenity) {
                    echo '
              <tbody>
                <tr><td>';
                    echo $amenity['ram_name'];
                    echo '</td></tr>
              </tbody>
            ';
                  }
                  echo '</table>';
                } else {
                  echo '<p>No amenities available for this room. Contact to Room Owner.</p>';
                }
                ?>
              </div>
            </div>

          </th>
          <th>
            <!-- Extra Aminities -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <div class="d-inline-flex" style="height: 31px;margin: 0;margin-left:0px;margin-top: 14px;">
                  <p class="d-inline-flex float-start"
                    style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 4px;font-weight: bold;font-size: 21px;">
                    Extra
                    Amenities</p>
                </div>

                <div style="margin: 0;margin-left: 0px;margin-top: 14px;">
                  <p class="para_data"
                    style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 4px;font-weight: bold;margin-bottom: 8px;">
                    <span style="font-weight: normal !important;">
                      <?php echo nl2br($room['room_am']); ?>
                    </span>
                  </p>
                </div>
              </div>
            </div>

            <!-- T&C for Rooms -->
            <div class="row justify-content-start">
              <div class="col-md-auto">
                <div class="d-inline-flex" style="height: 31px;margin: 0;margin-left:0px;margin-top: 14px;">
                  <p class="d-inline-flex float-start"
                    style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 4px;font-weight: bold;font-size: 21px;">
                    T&amp;C for this Room</p>
                </div>

                <div style="margin: 0;margin-left: 0px;margin-top: 14px;">
                  <p class="para_data"
                    style="margin: 0;margin-left: 40;margin-top: 0;margin-right: 4px;font-weight: bold;margin-bottom: 8px;">
                    <span style="font-weight: normal !important;">
                      <?php echo nl2br($room['room_tnc']); ?>
                    </span>
                  </p>
                </div>
              </div>
            </div>

          </th>
        </tr>
      </table>
    </div>

    <!-- Address -->
    <div class="container" style="margin-top: 20px;">
      <div class="d-inline-flex" style="height: 31px;margin: 0;margin-top: 14px;">
        <p class="d-inline-flex float-start"
          style="margin: 0;margin-left: 40;margin-top: 0;margin-right: 4px;font-weight: bold;">Room Address: </p>
        <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
          <?php echo ($room['room_add']); ?>
        </p>
      </div>
    </div>

    <!-- Geo Location -->
    <div class="container" style="margin-top:;">
      <div class="d-inline-flex" style="height: 31px;margin: 0;;margin-top: 14px;">
        <p class="d-inline-flex float-start"
          style="margin: 0;margin-left: 40;margin-top: 0;margin-right: 4px;font-weight: bold;font-size: 21px;">Location
        </p>
      </div>
    </div>

    <!-- Map -->
    <div class="container" style="margin-top: 20px;">
      <?php
      // Assuming $room['room_lat'] and $room['room_lng'] contain the latitude and longitude values
      $latitude = $room['room_lat'];
      $longitude = $room['room_lng'];
      ?>

      <div style="margin: 0; margin-left: 20px; margin-top: 14px;">
        <iframe allowfullscreen="" frameborder="0" loading="lazy" width="95%" height="400"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDpQZ6o4LvVrm5IA3yZzNlCx_2XYdJbHfU&q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&zoom=17">
        </iframe>
      </div>
    </div>

    <!-- Room Rating -->
    <div class="container" style="margin-top: 20px;">
      <h2 class="text-capitalize text-center section-heading"
        style="padding-top: 3px;padding-bottom: 13px;margin-bottom: 40px;margin-top: 58px;"><strong>Room's Ratings And
          Reviews</strong></h2>
    </div>

    <!-- Form -->
    <div class="container">
      <div class="row">
        <div class="col-md-6" style="padding: 35px;">
          <div class="table-responsive" style="height: fit-content;max-height: 500px;">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    <p class="d-inline-flex"><strong>Avg Rating :&nbsp;</strong></p>
                    <p class="d-inline-flex" style="margin-left: 6px;">
                      <?php echo number_format($averageRating, 1); // Display the average rating with one decimal place     ?>
                    </p>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Assuming you have a database connection in $conn
                include '../connection.php';

                if (isset($_GET['room_id'])) {
                  $roomId = $_GET['room_id'];
                }

                // Function to fetch reviews for a specific room_id
                function fetchRoomReviews($conn, $roomId)
                {
                  // Prepare the SQL query to fetch reviews
                  $sql = "SELECT rr_date, rr_rating, rr_review, stud_id FROM room_reviews WHERE room_id = '$roomId'";
                  // Execute the query
                  $result = mysqli_query($conn, $sql);
                  // Check for errors
                  if (!$result) {
                    die("Error: " . mysqli_error($conn));
                  }
                  // Fetch the result as an associative array
                  $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  // Free the result set
                  mysqli_free_result($result);
                  return $reviews;
                }
                // Function to fetch student information based on stud_id
                function fetchStudentInfo($conn, $stud_id)
                {
                  // Prepare the SQL query to fetch student information
                  $sql = "SELECT stud_fname, stud_lname, stud_photo FROM students WHERE stud_id = '$stud_id'";
                  // Execute the query
                  $result = mysqli_query($conn, $sql);
                  // Check if the query was successful
                  if ($result) {
                    // Fetch the result as an associative array
                    $studentInfo = mysqli_fetch_assoc($result);
                    // Free the result set
                    mysqli_free_result($result);
                    return $studentInfo;
                  } else {
                    // If the query failed, handle the error (you may log it or return an error message)
                    return [];
                  }
                }

                // Example usage to fetch and display reviews for a specific room_id
                $reviews = fetchRoomReviews($conn, $roomId);
                // Display the reviews
                foreach ($reviews as $review) {
                  $rr_date = $review['rr_date'];
                  $rr_rating = $review['rr_rating'];
                  $rr_review = $review['rr_review'];
                  $stud_id = $review['stud_id'];
                  // Fetch student information
                  $studentInfo = fetchStudentInfo($conn, $stud_id);
                  $stud_fname = $studentInfo['stud_fname'];
                  $stud_lname = $studentInfo['stud_lname'];
                  $stud_photo = $studentInfo['stud_photo'];
                  $originalDate = $review['rr_date'];
                  $dateTime = new DateTime($originalDate);
                  // Format the date as "DD MM YYYY"
                  $formattedDate = $dateTime->format('d-m-Y');
                  // Display the information as needed
                  echo '<tr>';
                  echo '<td>';
                  echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
                  echo "<img class='rounded-circle flex-shrink-0 me-3 fit-cover' width='47' height='44' src='$stud_photo' style='margin-left: 3px;'>";
                  echo '<div>';
                  echo "<p class='fw-bold mb-0' style='margin-top: 11px;'>$stud_fname $stud_lname</p>";
                  echo '</div>';
                  echo '<div class="d-inline-flex" style="height: 36px;margin: 3px;margin-left: 46px;margin-right: 38px;">
                        <p class="d-inline-flex float-start" style="margin-left: 7px;margin-top: 1px;font-size: 20px;">';
                  echo $rr_rating;
                  echo '</p><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                          viewBox="0 0 16 16" class="bi bi-star-fill"
                          style="color: var(--bs-yellow);margin: 0;margin-left: 14px;height: 38px;width: 25px;">
                          <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </div>';
                  // ... Display the rest of the information as needed
                  echo '</div>';
                  echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
                  echo "<p class='text-start' style='margin-left: 7px;margin-top: 14px;font-size: 20px;'><span style='color: rgb(0, 0, 0);'>$formattedDate</span></p>";
                  echo '</div>';
                  echo "<p class='text-start' style='margin-left: 7px;margin-top: 14px;font-size: 20px;'><span style='color: rgb(0, 0, 0);'>$rr_review</span></p>";
                  echo '</td>';
                  echo '</tr>';
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6">
          <div id="contact-1"
            style="background-image: url('assets/img/map-image.png?h=dde716a63e31eca254a82a274d4f56c0');">
            <div class="container" style="height: 302.234px;margin-top: 0px;">
              <div class="row">
                <div class="col-lg-12 text-center">
                  <h2 class="text-capitalize section-heading" style="margin-bottom: 27px;"><strong><em>Give your own
                        review</em></strong></h2>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <form action="addReview.php" method="POST" id="contactForm-1" name="contactForm">
                    <div class="card mb-5">
                      <div class="card-body p-sm-5">
                        <form method="post">
                          <form action="addReview.php" method="post">
                            <input hidden type="text" name="room_id" value="<?php echo $room['room_id']; ?>">
                            <div class="mb-3">
                              <label class="form-label">Rating :</label>
                              <div class="form-check d-inline-flex">
                                <input class="form-check-input" type="radio" id="rating-1" name="rating" value="1"
                                  style="margin-left: -4px;margin-right: 0px;">
                                <label class="form-check-label" for="rating-1"
                                  style="margin-left: 11px;margin-right: 0px;">1</label>
                              </div>

                              <div class="form-check d-inline-flex">
                                <input class="form-check-input" type="radio" id="rating-2" name="rating" value="2"
                                  style="margin-left: -4px;margin-right: 0px;">
                                <label class="form-check-label" for="rating-2"
                                  style="margin-left: 11px;margin-right: 0px;">2</label>
                              </div>

                              <div class="form-check d-inline-flex">
                                <input class="form-check-input" type="radio" id="rating-3" name="rating" value="3"
                                  style="margin-left: -4px;margin-right: 0px;">
                                <label class="form-check-label" for="rating-3"
                                  style="margin-left: 11px;margin-right: 0px;">3</label>
                              </div>

                              <div class="form-check d-inline-flex">
                                <input class="form-check-input" type="radio" id="rating-4" name="rating" value="4"
                                  style="margin-left: -4px;margin-right: 0px;">
                                <label class="form-check-label" for="rating-4"
                                  style="margin-left: 11px;margin-right: 0px;">4</label>
                              </div>

                              <div class="form-check d-inline-flex">
                                <input class="form-check-input" type="radio" id="rating-5" name="rating" value="5"
                                  style="margin-left: -4px;margin-right: 0px;">
                                <label class="form-check-label" for="rating-5"
                                  style="margin-left: 11px;margin-right: 0px;">5</label>
                              </div>
                            </div>

                            <div class="mb-3">
                              <textarea class="form-control" id="message-1" name="message" rows="6"
                                placeholder="Review"></textarea>
                            </div>
                            <div>
                              <button class="btn btn-primary d-block w-100" type="submit" name="submit">Submit
                                Review</button>
                            </div>
                          </form>
                        </form>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br>
    <br>
    <!-- Society Rating -->
    <div class="container" style="margin-top: 20px;">
      <h2 class="text-capitalize text-center section-heading"
        style="padding-top: 3px;padding-bottom: 13px;margin-bottom: 40px;margin-top: 58px;font-size: 30px;">
        <strong>Nearby Society reviews of room</strong>
      </h2>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-6" style="padding: 35px;">
          <div class="table-responsive" style="height: fit-content;max-height: 500px;">
            <table class="table">
              <thead>
                <tr></tr>
              </thead>
              <tbody>
                <?php
                // Assuming you have a database connection in $conn
                include '../connection.php';

                if (isset($_GET['room_id'])) {
                  $roomId = $_GET['room_id'];
                }

                // Function to fetch reviews for a specific room_id
                function fetchSocReviews($conn, $roomId)
                {
                  // Prepare the SQL query to fetch reviews
                  $sql = "SELECT * FROM society_reviews WHERE room_id = '$roomId'";
                  // Execute the query
                  $result = mysqli_query($conn, $sql);
                  // Check for errors
                  if (!$result) {
                    die("Error: " . mysqli_error($conn));
                  }
                  // Fetch the result as an associative array
                  $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                  // Free the result set
                  mysqli_free_result($result);
                  return $reviews;
                }
                // Function to fetch student information based on stud_id
              

                // Example usage to fetch and display reviews for a specific room_id
                $reviews = fetchSocReviews($conn, $roomId);
                // Display the reviews
                foreach ($reviews as $review) {
                  $rr_date = $review['sr_date'];
                  $rr_rating = $review['sr_rating'];
                  $rr_area = $review['sr_area'];
                  $rr_review = $review['sr_review'];
                  $stud_id = $review['stud_id'];
                  // Fetch student information
                  $studentInfo = fetchStudentInfo($conn, $stud_id);
                  $stud_fname = $studentInfo['stud_fname'];
                  $stud_lname = $studentInfo['stud_lname'];
                  $stud_photo = $studentInfo['stud_photo'];
                  $originalDate = $review['sr_date'];
                  $dateTime = new DateTime($originalDate);
                  // Format the date as "DD MM YYYY"
                  $formattedDate = $dateTime->format('d-m-Y');
                  // Display the information as needed
                  echo '<tr>';
                  echo '<td>';
                  echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
                  echo "<img class='rounded-circle flex-shrink-0 me-3 fit-cover' width='47' height='44' src='$stud_photo' style='margin-left: 3px;'>";
                  echo '<div>';
                  echo "<p class='fw-bold mb-0' style='margin-top: 11px;'>$stud_fname $stud_lname</p>";
                  echo '</div>';
                  echo '<div class="d-inline-flex" style="height: 36px;margin: 3px;margin-left: 46px;margin-right: 38px;">
                        <p class="d-inline-flex float-start" style="margin-left: 7px;margin-top: 1px;font-size: 20px;">';
                  echo $rr_rating;
                  echo '</p>
                        </svg>
                      </div>';
                  // ... Display the rest of the information as needed
                  echo '</div>';
                  echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
                  echo "<p class='text-start' style='margin-left: 7px;margin-top: 14px;font-size: 20px;'><span style='color: rgb(0, 0, 0);'>$formattedDate</span></p>";
                  echo '</div>';
                  echo "<p class='text-start' style='margin-left: 7px;margin-top: 14px;font-size: 20px;'><span style='color: rgb(0, 0, 0);'>Area : $rr_area</span></p>";
                  echo "<p class='text-start' style='margin-left: 7px;margin-top: 14px;font-size: 20px;'><span style='color: rgb(0, 0, 0);'>Review : $rr_review</span></p>";
                  echo '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-6">
          <div id="contact-2"
            style="background-image: url('assets/img/map-image.png?h=dde716a63e31eca254a82a274d4f56c0');">
            <div class="container" style="height: 302.234px;margin-top: 0px;">
              <div class="row">
                <div class="col-lg-12 text-center">
                  <h2 class="text-capitalize section-heading" style="margin-bottom: 27px;"><strong><em>Give your own
                        review</em></strong></h2>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <form action="addSR.php" method="POST" id="contactForm-2" name="contactForm">
                    <div class="card mb-5">
                      <div class="card-body p-sm-5">
                        <div class="d-flex mb-3">
                          <input hidden type="text" name="room_id" value="<?php echo $room['room_id']; ?>">
                          <label class="form-label">Rate Society :&nbsp;</label>
                          <div class="form-check" style="margin-right: 8px;">
                            <input class="form-check-input" type="radio" id="poor" name="rating" value="Poor">
                            <label class="form-check-label" for="poor">Poor</label>
                          </div>
                          <div class="form-check" style="margin-right: 8px;">
                            <input class="form-check-input" type="radio" id="good" name="rating" value="Good">
                            <label class="form-check-label" for="good">Good</label>
                          </div>
                          <div class="form-check" style="margin-right: 8px;">
                            <input class="form-check-input" type="radio" id="very_good" name="rating" value="Very Good">
                            <label class="form-check-label" for="very_good">Very Good</label>
                          </div>
                        </div>
                        <div class="mb-3"><input class="form-control" type="text" id="name-4" name="area_name"
                            placeholder="Area Name"></div>
                        <div class="mb-3">
                          <div class="mb-3"><textarea class="form-control" id="message-2" name="message" rows="6"
                              placeholder="Review"></textarea></div>
                        </div>
                        <div><button class="btn btn-primary d-block w-100" type="submit" name="submit">Send </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</body>

</html>