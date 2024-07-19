<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - EZRooms</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">

    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
    
</head>

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

<body id="page-top content" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57"
    style="--bs-primary: #000000;--bs-primary-rgb: 0,0,0;">

    <center>
        <button style="display: none;" id="printButton" class="btn btn-primary">Print to PDF</button>
    </center>
    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            // Select the content to be converted to PDF
            var content = document.getElementById('content');

            // Set options for the PDF generation
            var options = {
                margin: 1,
                filename: 'form.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };


            // Use html2pdf library to generate PDF
            html2pdf(content, options);
        });
    </script>

    <div id="content" style="margin: 15px;padding-bottom: 10px;">
        <div class="">
            <div class="col-lg-12">

                <?php
                // Assuming $_SESSION['stud_id'] is set after a successful login
                $stud_id = $_SESSION['user_id'];
                include("../connection.php");
                // Fetch student details using stud_id
                $sql = "SELECT * FROM students WHERE stud_id = '$stud_id'";
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
                ?>

                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold" style="color: var(--bs-indigo);">Student Profile</p>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-xl-2" style="width: 148px;">
                                    <div class="mb-3">
                                        <div class="mb-3" style="width: 124px;"><img class="rounded-circle mb-3 mt-4"
                                                src="<?php echo $stud_photo; ?>" width="115" height="104"
                                                style="margin: 0px;margin-top: 22px;"></div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Name:
                                                    :&nbsp;</strong></label><label class="form-label" for="last_name">
                                                <?php echo $student['stud_fname'] . " " . $student['stud_lname']; ?>
                                            </label></div>
                                        <div class="mb-3"><label class="form-label"
                                                for="last_name"><strong>Gender:&nbsp;</strong></label><label
                                                class="form-label" for="last_name">
                                                <?php echo $student['stud_gender']; ?>
                                            </label></div>
                                    </div>
                                    <div class="mb-3"><label class="form-label" for="last_name"><strong>Contact
                                                No.:</strong></label><label class="form-label" for="last_name">
                                            <?php echo $student['stud_phno']; ?>
                                        </label></div>
                                    <div class="mb-3"><label class="form-label"
                                            for="last_name"><strong>Email:</strong></label><label class="form-label"
                                            for="last_name">
                                            <?php echo $student['stud_email']; ?>
                                        </label></div>
                                    <div class="mb-3"><label class="form-label" for="last_name"><strong>Home
                                                Town:</strong></label><label class="form-label" for="last_name">
                                            <?php echo $student['stud_hometown']; ?>
                                        </label></div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Educational
                                                    Status:</strong></label><label class="form-label" for="last_name">
                                                <?php echo $student['stud_edu_bg']; ?>
                                        </div>
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>College
                                                    Name:</strong></label><label class="form-label" for="last_name">
                                                <?php echo $student['stud_college_name']; ?>
                                            </label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3"></div>
                        </form>
                    </div>
                </div>

                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Guardian Details</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Guardian
                                                    Name :</strong>&nbsp;</label><label class="form-label"
                                                for="last_name">
                                                <?php echo $student['stud_gd_name']; ?>
                                            </label></div>
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Guardian
                                                    Contact No.&nbsp;</strong></label><label class="form-label"
                                                for="last_name">
                                                <?php echo $student['stud_gd_phno']; ?>
                                            </label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">I
                                                <b>
                                                    <?php echo $student['stud_gd_name']; ?>
                                                </b>
                                                is ___________________________ (relation) of the
                                                <b>
                                                    <?php echo $student['stud_fname'] . " " . $student['stud_lname'] ?>
                                                </b>
                                                take responsibility that the
                                                <b>
                                                    <?php echo $student['stud_fname'] . " " . $student['stud_lname'] ?>
                                                </b>
                                                will follow the terms & condition you disccused with him along with a
                                                sign on this letter and take care of a room properly if any damage to
                                                property occurs we
                                                will gave the penalty of that.
                                            </label>
                                            <label class="form-label" for="last_name">
                                                <br>____________________<br>
                                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sign of
                                                Guardian</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="page-break card shadow mb-3" style="margin-top: 29px; page-break-before: always;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Student's Rating and Past Room Owners he Had</p>
                    </div>
                    <?php

                    $calc = "SELECT AVG(str_rating) as avg_rating, COUNT(*) as total_ratings FROM student_reviews WHERE stud_id = '$stud_id'";
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
                    <div class="card-body" style="height: 49px;">
                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Avg.
                                    Rating:</strong>&nbsp;</label><label class="form-label" for="last_name">
                                <?php echo $avgRating; ?>
                            </label></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="text-align:center;">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Owner Name</th>
                                        <th>Entered Date</th>
                                        <th>Exited Date</th>
                                        <th>Still a Tenant</th>
                                        <th>Rating</th>
                                        <th>Review</th>
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
                                                  <td>$row2[owner_fname] $row2[owner_lname]</td>
                                                  <td>$row[added_date]</td>
                                                  <td>";
                                            echo ($row['removed_date'] === '0000-00-00') ? '' : $row['removed_date'];
                                            echo "</td>
                                                  <td>$row[still_tenant]</td>
                                              
                                              ";

                                            $ratesql = "SELECT * FROM student_reviews WHERE owner_id = '$row[owner_id]' AND stud_id = '$stud_id'";
                                            $rateresult = $conn->query($ratesql);
                                            while ($raterow = $rateresult->fetch_assoc()) {
                                                echo "
                                                    <td>$raterow[str_rating]</td>
                                                    <td>$raterow[str_review]</td>
                                                </tr>
                                                ";
                                            }

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
                    </div>
                </div>


                <!-- Declaration Form -->
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Declaration (Room Owner can write T&amp;C in it and take a
                            sign of Student)</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <div id="checkboxes">
                                                <input type="checkbox" id="furnitureCheckbox" name="furnitureCheckbox">
                                                <label for="furnitureCheckbox">Respect and Care for
                                                    Furnishings</label><br>
                                                <input type="checkbox" id="parkingCheckbox" name="parkingCheckbox">
                                                <label for="parkingCheckbox">Parking Rules and Regulations</label><br>
                                                <input type="checkbox" id="lateFeeCheckbox" name="lateFeeCheckbox">
                                                <label for="lateFeeCheckbox">Late Fee Charges</label><br>
                                                <input type="checkbox" id="noticePeriodCheckbox"
                                                    name="noticePeriodCheckbox">
                                                <label for="noticePeriodCheckbox">Notice Period for Vacating the
                                                    Room</label><br>
                                                <input type="checkbox" id="noiseLevelCheckbox"
                                                    name="noiseLevelCheckbox">
                                                <label for="noiseLevelCheckbox">Maintain Appropriate Noise
                                                    Levels</label><br>
                                                <input type="checkbox" id="securityCheckbox" name="securityCheckbox">
                                                <label for="securityCheckbox">Responsible for Room Security</label><br>
                                                <input type="checkbox" id="commonAreaCheckbox"
                                                    name="commonAreaCheckbox">
                                                <label for="commonAreaCheckbox">Keep Common Areas Good</label><br>
                                                <input type="checkbox" id="cleanlinessCheckbox"
                                                    name="cleanlinessCheckbox">
                                                <label for="cleanlinessCheckbox">Maintain Cleanliness</label><br>
                                                <input type="checkbox" id="guestPolicyCheckbox"
                                                    name="guestPolicyCheckbox">
                                                <label for="guestPolicyCheckbox">Follow Guest Policy</label><br>
                                                <input type="checkbox" id="utilityUsageCheckbox"
                                                    name="utilityUsageCheckbox">
                                                <label for="utilityUsageCheckbox">Responsible Utility Usage</label><br>
                                                <input type="checkbox" id="damageResponsibilityCheckbox"
                                                    name="damageResponsibilityCheckbox">
                                                <label for="damageResponsibilityCheckbox">Take Responsibility for
                                                    Damages</label><br>
                                                <input type="checkbox" id="rentalPaymentCheckbox"
                                                    name="rentalPaymentCheckbox">
                                                <label for="rentalPaymentCheckbox">Timely Rental Payment</label><br>
                                                <input type="checkbox" id="takeCareOfRoomCheckbox"
                                                    name="takeCareOfRoomCheckbox">
                                                <label for="takeCareOfRoomCheckbox">Take Care of Room</label><br>
                                                <input type="checkbox" id="keepQuietCheckbox" name="keepQuietCheckbox">
                                                <label for="keepQuietCheckbox">Keep Quiet Hours</label><br>
                                                <input type="checkbox" id="noSmokingCheckbox" name="noSmokingCheckbox">
                                                <label for="noSmokingCheckbox">No Smoking in the Room</label><br>
                                                <input type="checkbox" id="noPetsCheckbox" name="noPetsCheckbox">
                                                <label for="noPetsCheckbox">No Pets Allowed</label><br>


                                                <button onclick="showSelectedTerms(event)">Done</button>
                                            </div>


                                            <div id="selectedTerms"></div>

                                            <script>
                                                function showSelectedTerms(event) {
                                                    event.preventDefault(); // Prevent the default form submission

                                                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                                    var selectedTerms = '';

                                                    checkboxes.forEach(function (checkbox) {
                                                        if (checkbox.checked) {
                                                            selectedTerms += '<p> &nbsp; <i class="fa-lg fa-regular fa-square-check"></i>&nbsp;&nbsp;' + checkbox.nextElementSibling.textContent + '</p>';
                                                        }
                                                    });

                                                    document.getElementById('checkboxes').style.display = 'none';
                                                    document.getElementById('printButton').style.display = 'block';
                                                    alert('Click "Print to PDF" button appeared on top-center of the Form');
                                                    document.getElementById('selectedTerms').innerHTML = selectedTerms;
                                                }
                                            </script>

                                            <p>________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br><br>
                                            </p>
                                            <label class="form-label"
                                                for="last_name"><br><strong>____________________</strong><br><strong>&nbsp;
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sign of
                                                    Student</strong>
                                            </label>
                                            <label class="form-label" for="last_name"><strong>&nbsp; &nbsp;
                                                    ___________________</strong><br><strong>&nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sign of Owner</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>