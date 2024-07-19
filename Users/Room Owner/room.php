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

  <style>
  </style>
</head>
<script>document.body.style.zoom = "90%"</script>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">

  <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-dark" id="mainNav">
    <div class="container"><a class="navbar-brand text-capitalize" href="index.php"
        style="font-weight: bold;font-style: italic;font-size: 23px;color:white;">EZRooms</a><button data-bs-toggle="collapse"
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
              style="color: white;margin-top: 13px;">Go Back</a></li>

          
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

          <p class=" d-inline-flex float-start" style="margin-left: 7px; margin-top: 1px; font-size: 18px;">
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

      <!-- Extra Aminities -->
      <div class="row justify-content-start">
        <div class="col-md-auto">
          <div class="d-inline-flex" style="height: 31px;margin: 0;margin-left:0px;margin-top: 14px;">
            <p class="d-inline-flex float-start"
              style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 4px;font-weight: bold;font-size: 21px;">Extra
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

    
  <?php endforeach; ?>
</body>

</html>