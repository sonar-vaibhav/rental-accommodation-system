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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

    <script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?key=AsJ0L8LG5BBJlyvN33LFC-ne060sXKRaFSRFARj9u3is3Jd8fWCSwxQVY4gf5oy9'
        async defer></script>
    <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS (Include this if not already included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body id="page-top" onload="loadMapScenario()">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span class="text-capitalize">EZRooms</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i
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
                            class="nav-link" href="profile.php"><i class="fas fa-user"></i><span
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

                <!-- Add Room Related Code -->
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Manage Rooms</h3>
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em"
                                fill="currentColor" class="fa-sm text-white-50"
                                style="color: var(--bs-gray-100);"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z">
                                </path>
                            </svg>&nbsp; Add Room&nbsp;
                        </a>
                    </div>
                </div>

                <!--Add Room Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Fill room related details to Add
                                    Room</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="addRoom.php" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation">
                                    <div class="">
                                        <label class="form-label">Room Photos</label>
                                        <input type="file" class="form-control" name="roomPhoto[]"
                                            accept="image/png, image/jpg, image/jpeg" multiple required>

                                        <br>
                                        <label class="form-label">Room Rent</label>
                                        <input type="text" class="form-control" name="roomRent" required>
                                        <br>
                                        <label class="form-label">Room Address: </label>
                                        <textarea class="form-control" id="" rows="3" name="roomAdd"></textarea>
                                        <br>
                                        <label class="form-label">Preferred Gender for Room</label>
                                        <select class="form-select" name="roomGender" required>
                                            <option selected disabled value="">Select option</option>
                                            <option>Male</option>
                                            <option>Fe-Male</option>
                                        </select>
                                        <br>
                                        <label class="form-label">Room Status</label>
                                        <select class="form-select" name="roomStatus" required>
                                            <option selected disabled value="">Select option</option>
                                            <option>Available</option>
                                            <option>Not Available</option>
                                        </select>
                                        <br>
                                        <label class="form-label">Available Date</label>
                                        <input type="date" class="form-control" name="roomAvailableDate" required>
                                        <br>
                                        <label class="form-label">Room Type</label>
                                        <select class="form-select" name="roomType" required>
                                            <option selected disabled value="">Select option</option>
                                            <option>Shared</option>
                                            <option>Personal</option>
                                        </select>
                                        <br>

                                        <label class="form-label">No. of Beds in a Room</label>
                                        <input type="number" class="form-control" name="numOfBeds" required>
                                        <br>
                                        <label class="form-label">Click on the area of map to add location of the room :
                                        </label>

                                        <div id="map" style="height: 250px;"></div>
                                        <br>
                                        <label id="mapPoints" class="form-label">Co-ordinates are : (Not Selected
                                            Yet)</label>
                                        <input type="hidden" id="latitudeInput" name="lat" value="">
                                        <input type="hidden" id="longitudeInput" name="lng" value="">
                                        <br>
                                        <script>
                                            var map;
                                            var pushpin;

                                            function loadMapScenario() {
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(
                                                        function (position) {
                                                            var userLocation = new Microsoft.Maps.Location(position.coords.latitude, position.coords.longitude);
                                                            initializeMap(userLocation);
                                                        },
                                                        function (error) {
                                                            console.error('Error getting user location:', error);
                                                            var defaultLocation = new Microsoft.Maps.Location(20.918234106862784, 74.78039979244431);
                                                            initializeMap(defaultLocation);
                                                        }
                                                    );
                                                } else {
                                                    console.error('Geolocation is not supported by this browser.');
                                                    var defaultLocation = new Microsoft.Maps.Location(20.918234106862784, 74.78039979244431);
                                                    initializeMap(defaultLocation);
                                                }
                                            }

                                            function initializeMap(initialLocation) {
                                                map = new Microsoft.Maps.Map(document.getElementById('map'), {
                                                    credentials: 'AsJ0L8LG5BBJlyvN33LFC-ne060sXKRaFSRFARj9u3is3Jd8fWCSwxQVY4gf5oy9',
                                                    center: initialLocation,
                                                    zoom: 13
                                                });

                                                pushpin = new Microsoft.Maps.Pushpin(initialLocation, { draggable: true });
                                                map.entities.push(pushpin);

                                                Microsoft.Maps.Events.addHandler(map, 'click', function (event) {
                                                    var clickedLocation = event.location;
                                                    pushpin.setLocation(clickedLocation);
                                                    console.log('New pushpin position:', clickedLocation.latitude, clickedLocation.longitude);

                                                    var label = document.getElementById('mapPoints');
                                                    label.innerText = 'Co-ordinates are: Latitude ' + clickedLocation.latitude + ', Longitude ' + clickedLocation.longitude;

                                                    document.getElementById('latitudeInput').value = clickedLocation.latitude;
                                                    document.getElementById('longitudeInput').value = clickedLocation.longitude;
                                                });
                                            }
                                            loadMapScenario();
                                        </script>
                                        <!-- Room Aminities Fetching -->
                                        <label class="form-label">Select Room Aminities: </label>
                                        <div class="form-check"
                                            style="display: flex; flex-wrap: wrap; padding-left:10px;">
                                            <?php
                                            include '../connection.php';
                                            $sql = "SELECT * FROM room_aminities";
                                            $result = $conn->query($sql);
                                            if (!$result) {
                                                die("Invalid Query");
                                            }

                                            // Check if amenities are retrieved successfully
                                            if ($result) {
                                                // Display checkboxes for each amenity
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $amenityId = $row['ram_id'];
                                                    $amenityName = $row['ram_name'];

                                                    // Output Bootstrap checkbox code
                                                    echo '<div class="form-check" style="margin-right: 20px;">';
                                                    echo '<input class="form-check-input" type="checkbox" value="' . $amenityId . '" id="amenityCheck' . $amenityId . '" name="selectedAmenities[]">';
                                                    echo '<label class="form-check-label" for="amenityCheck' . $amenityId . '">' . $amenityName . '</label>';
                                                    echo '</div>';
                                                }
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else {
                                                // Handle error if amenities retrieval fails
                                                die("Error: " . mysqli_error($connection));
                                            }

                                            ?>
                                        </div>
                                        <br>
                                        <label class="form-label">Extra Aminities : </label>
                                        <textarea class="form-control" id="" rows="6" name="extraAmenities"></textarea>
                                        <br>
                                        <label class="form-label">Terms and Conditions about Rooms : </label>
                                        <textarea class="form-control" id="" rows="6" name="roomTNC"></textarea>
                                        <br>

                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" name="addRoom">Add Room</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin: 0px;margin-left: 4px;">
                    <?php
                    include '../connection.php';
                    // Assuming you have a function to fetch data from the database based on $tableName
                    $roomData = fetchDataFromDatabase($conn, 'rooms');
                    // Function to fetch data from the database based on $tableName
                    function fetchDataFromDatabase($conn, $tableName)
                    {
                        $owner_id = $_SESSION['user_id'];
                        // Define the SQL query based on the $tableName
                        $sql = "SELECT * FROM $tableName WHERE owner_id = '$owner_id'";

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

                                    <div class="carousel slide" data-bs-ride="false" id="<?php echo $carouselId; ?>"
                                        style="margin-top: 0;">
                                        <div class="carousel-inner">
                                            <?php foreach ($imageUrls as $index => $imageUrl): ?>
                                                <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                                                    <img height="300px" width="450px" class="w-100 d-block"
                                                        src="<?php echo $imageUrl['img_path']; ?>" alt="Room Image">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <div>
                                            <a class="carousel-control-prev" href="#<?php echo $carouselId; ?>"
                                                role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#<?php echo $carouselId; ?>"
                                                role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </div>

                                        <ol class="carousel-indicators">
                                            <?php foreach ($imageUrls as $index => $imageUrl): ?>
                                                <li data-bs-target="#<?php echo $carouselId; ?>"
                                                    data-bs-slide-to="<?= $index; ?>" <?= ($index === 0) ? 'class="active"' : ''; ?>></li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>

                                    <?php
                                    // Assuming you have a database connection in $conn
                                    include '../connection.php';
                                    // Example usage to get the average rating for a specific room (replace $roomId with the actual room ID)
                                    // $roomId; // Replace this with the actual room ID
                                    $averageRating = getAverageRating($conn, $roomId);

                                    $countRating = getCountRating($conn, $roomId);
                                    ?>

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
                                    <br>
                                    <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                                        <p class="d-inline-flex float-start"
                                            style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                                            Average Rating :&nbsp;
                                        </p>
                                        <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                                            <?php echo number_format($averageRating, 1); // Display the average rating with one decimal place ?>
                                        </p> &nbsp;
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                    </div>
                                    <br>
                                    <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                                        <p class="d-inline-flex float-start"
                                            style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                                            Total Students Rated :&nbsp;
                                        </p>
                                        <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                                            <?php echo $countRating; // Display the average rating with one decimal place ?>
                                        </p>
                                    </div>
                                    <br>
                                    <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px;">
                                        <p class="d-inline-flex float-start"
                                            style="margin: 0;margin-left: 0;margin-top: 0;margin-right: 3px;font-weight: bold;">
                                            Total Views :&nbsp;
                                        </p>
                                        <p class="d-inline-flex float-start" style="margin-top: 0;margin-left: 0;">
                                            <?php echo $room['room_views']; // Display the average rating with one decimal place ?>
                                        </p>
                                    </div>
                                    <br>
                                    <div style="height: 31px;margin: 0;margin-left: 0;margin-top: 14px; display: flow;">
                                        <!-- Add a data-target attribute with a unique ID for the modal -->
                                        <button class="btn btn-success btn-sm d-none d-sm-inline-block" style="float:left;"
                                            data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $roomId; ?>">
                                            Edit &nbsp;<i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- Modal -->

                                        <div class="modal fade" id="editModal_<?php echo $roomId; ?>" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modify room
                                                            related details to Edit Room</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php
                                                        // Assuming $room is the associative array containing existing room details
                                                        $room = fetchRoomDetailsById($conn, $room['room_id']);

                                                        ?>
                                                        <!-- Add your form elements here for editing room details -->
                                                        <form method="POST" action="updateRoom.php">
                                                            <form action="updateRoom.php" method="POST" enctype="multipart/form-data"
                                                                class="row g-3 needs-validation">
                                                                <div class="">

                                                                    <label class="form-label">Room Rent</label>
                                                                    <input type="text" class="form-control" name="roomRent"
                                                                        value="<?php echo $room['room_rent']; ?>" required>
                                                                    <br>
                                                                    <label class="form-label">Room Address:</label>
                                                                    <textarea class="form-control" id="" rows="3" name="roomAdd"><?php echo $room['room_add']; ?></textarea>

                                                                    <label class="form-label">Preferred Gender for
                                                                        Room</label>
                                                                    <select class="form-select" name="roomGender" required>
                                                                        <option disabled value="">Select option</option>
                                                                        <option <?php echo ($room['room_gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                                                                        <option <?php echo ($room['room_gender'] === 'Fe-Male') ? 'selected' : ''; ?>>Fe-Male</option>
                                                                    </select>
                                                                    <br>
                                                                    <label class="form-label">Room Status</label>
                                                                    <select class="form-select" name="roomStatus" required>
                                                                        <option selected disabled value="">Select option
                                                                        </option>
                                                                        <option <?php echo ($room['room_status'] === 'Available') ? 'selected' : ''; ?>>Available</option>
                                                                        <option <?php echo ($room['room_status'] === 'Not Available') ? 'selected' : ''; ?>>Not Available
                                                                        </option>
                                                                    </select>
                                                                    <br>
                                                                    <label class="form-label">Available Date</label>
                                                                    <input type="date" class="form-control"
                                                                        value="<?php echo $room['room_available_date']; ?>"
                                                                        name="roomAvailableDate" required>
                                                                    <br>
                                                                    <label class="form-label">Room Type</label>
                                                                    <select class="form-select" name="roomType"
                                                                        value="<?php echo $room['room_type']; ?>" required>
                                                                        <option selected disabled value="">Select option
                                                                        </option>
                                                                        <option <?php echo ($room['room_type'] === 'Shared') ? 'selected' : ''; ?>>Shared</option>
                                                                        <option <?php echo ($room['room_type'] === 'Personal') ? 'selected' : ''; ?>>Personal</option>
                                                                    </select>
                                                                    <br>

                                                                    <label class="form-label">No. of Beds in a Room</label>
                                                                    <input type="number" class="form-control"
                                                                        value="<?php echo $room['room_beds']; ?>"
                                                                        name="numOfBeds" required>
                                                                    <br>

                                                                    <!-- Room Aminities Fetching -->
                                                                    <label class="form-label">Select Room Amenities:</label>
                                                                    <div class="form-check"
                                                                        style="display: flex; flex-wrap: wrap; padding-left:10px;">
                                                                        <?php
                                                                        include '../connection.php';

                                                                        // Assuming you have the $roomId available in your code
                                                                        $roomId = $room['room_id'];

                                                                        // Fetch amenities associated with the room from room_aminities_link table
                                                                        $sqlAmenities = "SELECT ra.ram_id, ra.ram_name FROM room_aminities ra
                                                                                         JOIN room_aminities_link ral ON ra.ram_id = ral.ram_id
                                                                                         WHERE ral.room_id = '$roomId'";
                                                                        $resultAmenities = $conn->query($sqlAmenities);

                                                                        if (!$resultAmenities) {
                                                                            die("Invalid Query");
                                                                        }

                                                                        // Create an array to store the amenity IDs associated with the room
                                                                        $selectedAmenities = [];

                                                                        // Fetch the associated amenity IDs
                                                                        while ($rowAmenities = mysqli_fetch_assoc($resultAmenities)) {
                                                                            $selectedAmenities[] = $rowAmenities['ram_id'];
                                                                        }

                                                                        // Fetch all amenities from room_aminities table
                                                                        $sqlAllAmenities = "SELECT * FROM room_aminities";
                                                                        $resultAllAmenities = $conn->query($sqlAllAmenities);

                                                                        if (!$resultAllAmenities) {
                                                                            die("Invalid Query");
                                                                        }

                                                                        // Display checkboxes for all amenities
                                                                        while ($rowAllAmenities = mysqli_fetch_assoc($resultAllAmenities)) {
                                                                            $amenityId = $rowAllAmenities['ram_id'];
                                                                            $amenityName = $rowAllAmenities['ram_name'];

                                                                            // Check if the current amenity is associated with the room
                                                                            $isChecked = in_array($amenityId, $selectedAmenities) ? 'checked' : '';

                                                                            // Output Bootstrap checkbox code
                                                                            echo '<div class="form-check" style="margin-right: 20px;">';
                                                                            echo '<input class="form-check-input" type="checkbox" value="' . $amenityId . '" id="amenityCheck' . $amenityId . '" name="selectedAmenities[]" ' . $isChecked . '>';
                                                                            echo '<label class="form-check-label" for="amenityCheck' . $amenityId . '">' . $amenityName . '</label>';
                                                                            echo '</div>';
                                                                        }

                                                                        // Free result sets
                                                                        mysqli_free_result($resultAmenities);
                                                                        mysqli_free_result($resultAllAmenities);
                                                                        ?>
                                                                    </div>

                                                                    <br>
                                                                    <label class="form-label">Extra Aminities : </label>
                                                                    <textarea class="form-control" id="" rows="6"
                                                                        name="extraAmenities"><?php echo $room['room_am']; ?></textarea>
                                                                    <br>
                                                                    <label class="form-label">Terms and Conditions about
                                                                        Rooms : </label>
                                                                    <textarea class="form-control" id="" rows="6"
                                                                        name="roomTNC"><?php echo $room['room_tnc']; ?></textarea>
                                                                    <br>
                                                                        <input type="text" value="<?php echo $room['room_id'];?>" name="room_id" hidden>
                                                                </div>
                                                                <div class="col-12">
                                                                    <button class="btn btn-primary" type="submit"
                                                                        name="updateRoom">Submit</button>
                                                                </div>
                                                            </form>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <form action="" method="POST">
                                            <input type="text" value="<?php echo $room['room_id']; ?>" name="del_id" hidden>
                                            <button class="btn btn-danger btn-sm d-none d-sm-inline-block" type="submit"
                                                name="delete" style="float:right;">Delete &nbsp;
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    // include '../connection.php';
                    if (isset($_POST['delete'])) {

                        $delRoom = $_POST['del_id'];

                        $sql = "DELETE FROM rooms WHERE room_id = '$delRoom'";
                        // Execute the SQL query
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            // Query executed successfully, handle success (e.g., redirect or display a success message)
                            echo "
                            <script>
                            alert('Room deleted successfully!');
                            window.location.href = window.location.href;
                            </script>
                            ";
                        } else {
                            // Query failed, handle error (e.g., display an error message)
                            echo "Error deleting room: " . mysqli_error($your_database_connection);
                        }
                    }
                    ?>

                    <?php
                    include '../connection.php';
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
                    function getCountRating($conn, $roomId)
                    {
                        // Prepare the SQL query
                        $sql = "SELECT COUNT(*) AS total_rating FROM room_reviews WHERE room_id = '$roomId'";
                        // Execute the query
                        $result = mysqli_query($conn, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Fetch the result as an associative array
                            $row = mysqli_fetch_assoc($result);

                            // Free the result set
                            mysqli_free_result($result);

                            // Return the average rating
                            return $row['total_rating'];
                        } else {
                            // If the query failed, handle the error (you may log it or return an error message)
                            return false;
                        }
                    }

                    function fetchRoomDetailsById($conn, $roomId)
                    {
                        // Use prepared statements to prevent SQL injection
                        $stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
                        $stmt->bind_param("s", $roomId);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Fetch room details as an associative array
                        $room = $result->fetch_assoc();

                        // Close the prepared statement
                        $stmt->close();

                        return $room;
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>