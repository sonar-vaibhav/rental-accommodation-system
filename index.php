<!DOCTYPE html>
<html lang="en">

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
  <style>
    body {
      overflow-x: hidden;
      margin: 0px;
      padding: 0px;
      background-image: url('assets/img/room.png?h=0e8c6442902a4f66a3e0842888ab0847');
      background-repeat: no-repeat;
      background-size: 100%;
    }

    @media only screen and (max-width: 980px) {

      /* Adjust background-size for smaller screens */
      body {
        background: none;
        text-decoration-color: white;
      }

      h1,
      h2,
      p {
        color: white !important;
      }

      header.masthead {
        padding-top: 0px;
      }

      header {
        background-image: url('assets/img/room.png?h=0e8c6442902a4f66a3e0842888ab0847');
      }

      #mycont {
        display: block;
      }

    }
  </style>
</head>

<style>
  @keyframes addUnderline {
  0% {
    transform: scaleX(0);
  }
  50% {
    transform: scaleX(1);
  }
  100% {
    transform: scaleX(0);
  }
}

.link-animation {
  position: relative;
  text-decoration: none;
  color: white;
}

.link-animation::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 100%;
  height: 2px;
  background-color: #f05f40;
  animation: addUnderline 1.5s infinite;
}

</style>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
  <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-dark" id="mainNav">
    <div class="container"><a class="navbar-brand text-capitalize" href="index.php"
        style="font-weight: bold;font-style: italic;font-size: 23px;">EZRooms</a><button data-bs-toggle="collapse"
        data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
        style="color: var(--bs-gray-100);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
          fill="currentColor" viewBox="0 0 16 16" class="bi bi-card-text">
          <path
            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z">
          </path>
          <path
            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z">
          </path>
        </svg></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link text-capitalize" href="see_rooms.php"
              style="color: rgb(255,255,255);">Visit Rooms</a></li>
          <li class="nav-item text-capitalize" style="color: rgb(255,255,255);"><a class="nav-link text-capitalize"
              href="login.html" style="color: rgb(255,255,255);">Log in</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="text-center text-white d-flex masthead">

    <div class="row align-items-start" id="mycont">
      <div class="col" style="margin-top: 80px;">
        <div class="container my-auto">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <h1 class="text-uppercase" style="font-size:2rem;"><strong class="text-capitalize">Welcome to
                  <em>EZRooms</em></strong></h1>
              <hr>
            </div>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-capitalize text-center text-faded mb-5" style="font-size:1rem;">Start your Journey With
              EZRooms, Where
              Students Discover Their Accommodation, And Room Owners Showcase Rental Accommodations.
              EZRooms Simplify The Rental Process, Connecting Students With The Perfect Living Spaces And Offers Room
              Owners
              To
              Effortlessly Showcase Their Rental Accommodations. Making Student Life Comfortable And Stress-Free Is What EZRooms
              Is
              All
              About."</p>

            <p class="text-capitalize text-center text-faded mb-5" style="font-size:1rem; margin-top:10px;">Are you a
              student ? <a class="link-animation" href="see_rooms.php">Visit Rooms</a>
              <br>
              Are you a Room Owner ? <a class="link-animation" href="login.html">List your own room</a>
            </p>

            <p class="text-center text-faded mb-5" style="font-size:1rem; margin-top:20px;">For any
              query contact us on: <u>Admin@EZRooms.com</u></p>
          </div>
        </div>
      </div>
      <div class="col" style="margin-top: 80px;">
        <div class="row">
          <div class="col-md-12">
            <h2 class="text-center section-heading" style="margin-bottom: 20px;color: white;">
              <strong>What is EZRooms ?</strong>
            </h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <p class="text-capitalize text-center text-faded mb-5" style="font-size:1rem;">EZRooms makes finding and
              showcasing rental rooms easy. Students can discover their perfect room, while property owners effortlessly
              showcase their spaces. <br><br>It's a simple, smart way for students to find a room and for owners to
              connect with them. EZRooms, where finding and showcasing rooms is as easy as it gets.

            </p>
          </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 justify-content-center" style="margin-top: 20px;">
          <?php
          include "connection.php";
          // Fetch the actual numbers from the database
          $roomsQuery = "SELECT COUNT(*) AS roomCount FROM rooms";
          $roomResult = mysqli_query($conn, $roomsQuery);
          $roomCount = mysqli_fetch_assoc($roomResult)['roomCount'];

          $ownersQuery = "SELECT COUNT(*) AS ownerCount FROM owners";
          $ownerResult = mysqli_query($conn, $ownersQuery);
          $ownerCount = mysqli_fetch_assoc($ownerResult)['ownerCount'];

          $studentsQuery = "SELECT COUNT(*) AS studentCount FROM students";
          $studentResult = mysqli_query($conn, $studentsQuery);
          $studentCount = mysqli_fetch_assoc($studentResult)['studentCount'];
          ?>
          <div class="col">
            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
              <div class="px-3">
                <h2>
                  <?php echo $roomCount; ?>+ <i class="fas fa-home" style="color:primary;"></i>
                </h2>
                <p class=""> &nbsp; Rooms Listed</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
              <div class="px-3">
                <h2 class="">
                  <?php echo $studentCount; ?>+ <i class="fas fa-user-graduate"></i>
                </h2>
                <p class="">&nbsp; Students</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
              <div class="px-3">
                <h2>
                  <?php echo $ownerCount; ?>+ <i class="fas fa-user-alt"></i>
                </h2>
                <p class="">Room Owners</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.min.js?h=e2d48538e86d2e7e5bae0de2d5caf630"></script>
</body>

</html>