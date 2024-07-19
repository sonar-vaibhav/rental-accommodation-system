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

if (isset($_GET['remove_fav'])) {
  echo "
          <script>alert('Room is Removed from Favorites');</script>
          ";
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
  <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
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
          include ("../connection.php");
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

  <div class="container py-4 py-xl-5" style="margin-top: 50px;">
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-top: 0px;" id="ogRoom">

      <?php
      include '../connection.php';
      if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or handle the session not being set
        // header("Location: login.php");
        echo "error";
        // exit();
      }
      // Function to fetch favorite rooms based on user ID
      function fetchFavoriteRooms($conn, $favTableName, $roomsTableName)
      {
        $studId = $_SESSION['user_id'];
        // Get the user ID from the session
      
        // Define the SQL query to fetch favorite rooms
        $sql = "SELECT $roomsTableName.* FROM $favTableName JOIN $roomsTableName ON $favTableName.room_id = $roomsTableName.room_id WHERE $favTableName.stud_id = '$studId'";

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

      // Use the function to fetch favorite rooms
      $roomData = fetchFavoriteRooms($conn, 'fav_rooms', 'rooms');

      ?>

      <!-- Display room data in the HTML card structure -->
      <?php foreach ($roomData as $room): ?>
        <div class="col">
          <div class="card" style="border-radius: 19px;">
            <!-- ... Rest of your HTML card structure ... -->
            <div class="card-body p-4" style="box-shadow: 0px 0px;">
              <?php
              $roomId = $room['room_id'];

              // Fetch image URLs from the database
              $imageUrls = fetchImageUrls($conn, $roomId);

              // Generate a unique carousel ID based on room ID
              $carouselId = 'carousel-' . $roomId;
              ?>

              <div class="carousel slide" data-bs-ride="false" id="<?php echo $carouselId; ?>" style="margin-top: 0;">
                <div class="carousel-inner">
                  <?php foreach ($imageUrls as $index => $imageUrl): ?>
                    <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                      <img height="300px" width="450px" class="w-100 d-block" src="<?php echo $imageUrl['img_path']; ?>"
                        alt="Room Image">
                    </div>
                  <?php endforeach; ?>
                </div>

                <div>
                  <a class="carousel-control-prev" href="#<?php echo $carouselId; ?>" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#<?php echo $carouselId; ?>" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                  </a>
                </div>

                <ol class="carousel-indicators">
                  <?php foreach ($imageUrls as $index => $imageUrl): ?>
                    <li data-bs-target="#<?php echo $carouselId; ?>" data-bs-slide-to="<?= $index; ?>" <?= ($index === 0) ? 'class="active"' : ''; ?>></li>
                  <?php endforeach; ?>
                </ol>
              </div>

              <div style="margin:10px; height:44px;">
                <a class="btn btn-primary d-inline-flex float-end" title="Un-Favorite"
                  href="deleteFav.php?roomId=<?php echo $room['room_id']; ?>"
                  style="background: var(--swiper-theme-color);padding: 8px 12px;margin: 1px;margin-top: 11px;margin-left: -1px;margin-right: 11px;"
                  title="Add to Favorites">
                  <i class="fa-solid fa-heart-circle-xmark"></i>
                </a>

                <button class="btn btn-primary d-inline-flex float-end" data-bs-toggle="modal"
                  data-bs-target="#exampleModal<?php echo $room['room_id']; ?>"
                  style="background: var(--swiper-theme-color);padding: 8px 12px;margin: 1px;margin-top: 11px;margin-left: -1px;margin-right: 11px;"
                  title="Complaint about Room">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                    class="bi bi-flag">
                    <path
                      d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z">
                    </path>
                  </svg>
                </button>

                <div class="modal fade" id="exampleModal<?php echo $room['room_id']; ?>" tabindex="-1"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Complaint about Room : </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="compAboutRoom.php" method="POST" enctype="multipart/form-data"
                          class="row g-3 needs-validation">
                          <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                          <label class="form-label">Type a Complaint / Report you have about the Selected Room : </label>
                          <textarea class="form-control" id="" rows="6" name="roomComp"></textarea>
                          <div class="col-12">
                            <button class="btn btn-primary" type="submit" name="compRoom">Add Complaint</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div style="height: 36px;margin: 3px;">
                <!-- Display room details such as rent, availability, etc. -->

                <?php
                // Assuming you have a database connection in $conn
                include '../connection.php';

                // Example usage to get the average rating for a specific room (replace $roomId with the actual room ID)
                $roomId; // Replace this with the actual room ID
                $averageRating = getAverageRating($conn, $roomId);
                ?>

                <!-- Display the average rating in the HTML -->
                <p class="d-inline-flex float-start" style="margin-left: 7px; margin-top: 1px; font-size: 20px;">
                  <?php echo number_format($averageRating, 1); // Display the average rating with one decimal place ?>
                </p>

                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                  class="bi bi-star-fill"
                  style="color: var(--bs-yellow);margin: 0;margin-left: 14px;height: 38px;width: 25px;">
                  <path
                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                  </path>
                </svg>
                <!-- Add more details as needed -->

                <p class="d-inline-flex float-end">
                  <?php echo $room['room_rent']; ?> / Month
                </p>
                <p class="d-inline-flex float-end" style="margin-right: 7px;margin-top: 1px;">Rs.</p>
              </div>

              <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                  Date of Room Uploaded : </p>

                <?php $originalDate = $room['room_upload_date']; // Replace this with your actual date variable
                
                  // Create a DateTime object from the original date
                  $dateTime = new DateTime($originalDate);

                  // Format the date as "DD MM YYYY"
                  $formattedDate = $dateTime->format('d-m-Y');
                  ?>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($formattedDate); ?>
                </p>
              </div>

              <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                  Available : </p>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($room['room_status'] == 'Available') ? 'Yes' : 'No'; ?>
                </p>
              </div>
              <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                  Room Type : </p>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($room['room_type']); ?>
                </p>
              </div>

              <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                  No. of Beds : </p>
                <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                  <?php echo ($room['room_beds']); ?>
                </p>
              </div>

              <div style="display: inline-flex; margin-left: -115px;">
                <?php
                // Assuming you have a database connection in $conn
                include '../connection.php';

                // Function to fetch owner details based on date
              

                // Example usage to fetch owner details for the specified owner_id
                $ownerId = $room['owner_id'];
                $ownerDetails = fetchOwnerDetails($conn, $ownerId);

                // Display the owner's photo, first name, and last name in the HTML
                $ownerPhoto = $ownerDetails ? $ownerDetails['owner_photo'] : 'https://shorturl.at/oEJ57';
                $ownerFullName = $ownerDetails ? $ownerDetails['owner_fname'] . ' ' . $ownerDetails['owner_lname'] : 'N/A';
                ?>

                <!-- Display the owner's photo, first name, and last name in the HTML -->
                <p class="d-inline-flex float-start"
                  style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                  <img src="<?php echo $ownerPhoto; ?>" alt="" style="border-radius: 31px; width: 60px; height: 60px;">
                </p>

                <p class="fw-bold mb-0" style="margin-top: 14px; margin-left: 12px;">
                  <?php echo $ownerFullName; ?>
                </p>
              </div>
              <br>

              <div style="height: 43px;margin: 0;margin-left: 0;margin-top: 23px;padding: 1px;">
                <a class="btn btn-warning text-capitalize d-inline-flex float-start" role="button" target="_blank"
                  href="room.php?room_id=<?php echo $room['room_id']; ?>" name="see_room">See Room</a>

                <form id="requestCallForm" action="reqCall.php" method="POST">
                  <input type="hidden" name="owner_id" value="<?php echo $room['owner_id']; ?>">
                  <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                  <button class="btn btn-success text-capitalize d-inline-flex float-end" type="submit">
                    Request Call 📞&nbsp;
                  </button>
                </form>
              </div>

            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <?php
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
      ?>

    </div>
  </div>


  <footer class="text-center" style="margin-top: 23px;">
    <div class="container text-muted py-4 py-lg-5">
      <ul class="list-inline"></ul>
      <ul class="list-inline">
        <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
            fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
            <path
              d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
            </path>
          </svg></li>
        <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
            fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
            <path
              d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
            </path>
          </svg></li>
        <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
            fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
            <path
              d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
            </path>
          </svg></li>
      </ul>
      <p class="mb-0">Copyright © 2023 EZRooms</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
</body>

</html>