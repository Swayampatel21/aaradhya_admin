<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Patient Profile Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background: linear-gradient(135deg, #f0f5f5,  #e0ebeb);
                padding-top: 20px;
                margin-bottom: 50px;
            }

            .container {
                max-width: 900px;
                margin: auto;
            }

            h1, h3 {
                text-align: center;
                color: #3498db;
            }

            .jumbotron {
                background: linear-gradient(135deg, #3498db, #2c3e50);
                color: #ffffff;
                padding: 2rem 1rem;
                border-radius: 12px;
                text-align: center;
                margin-top: -20px;
                margin-bottom: 50px;
            }

            .form-container {
                max-width: 600px;
                margin: auto;
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            label {
                /*font-weight: bold;*/
                color: black;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-control {
                border-radius: 5px;
            }

            .btn-submit {
                background-color: #3498db;
                color: #ffffff;
                border: 2px solid #3498db;
                padding: 14px 24px;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
                font-size: 1.2em;
                font-weight: bold;
                margin-top: 30px;
                display: inline-block;
            }

            .btn-submit:hover {
                background-color: #ffffff;
                color: #3498db;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-container">
                <p class="jumbotron" style="font-size: 20px;">PROFILE</p>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="patient_name">Patient Name:</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mobile_number">Mobile Number:</label>
                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Female" required>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blood_type">Blood Type:</label>
                            <select class="form-control" id="blood_type" name="blood_type" required>
                                <option value="select">Select any one</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Upload Your Photo:</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                    </div>

                    <button type="submit" style="font-size: 15px;" class="btn btn-submit jumbotron">SAVE</button>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ah";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    @$patient_name = $_POST["patient_name"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $mobile_number = $_POST["mobile_number"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $blood_type = $_POST["blood_type"];

    $_SESSION['patient_name'] = @$patient_name;
    $_SESSION['age'] = $age;
    $_SESSION['address'] = $address;
    $_SESSION['mobile_number'] = $mobile_number;
    $_SESSION['email'] = $email;
    $_SESSION['gender'] = $gender;
    $_SESSION['blood_type'] = $blood_type;

    // Check if 'photo' key is set and not null
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] != 4) { // Check if the file was uploaded
        // Handle file upload
        $img = $_FILES['photo']['name'];
        $temp_image = $_FILES['photo']['tmp_name'];

        // Specify the target directory for uploads
        $upload_dir = "UPLOAD/";

        // Make sure the directory exists, create it if not
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Specify the target file path
        $target_file = $upload_dir . basename($img);

        // Check if the file has a valid image extension
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $valid_extensions)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($temp_image, $target_file)) {
                // Insert data into patient_profile table
                $sql = "INSERT INTO patient_profile (patient_name, age, address, mobile_number, email, gender, blood_type, photo_path)
                        VALUES ('$patient_name', $age, '$address', '$mobile_number', '$email', '$gender', '$blood_type', '$target_file')";

                if ($conn->query($sql) === TRUE) {
                    // Store image path in session
                    $_SESSION['photo_path'] = $target_file;

                    echo "Record inserted successfully. Image: $img";
                    echo "<a href='Edit_Profile.php'>click for view profile</a>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format. Please upload a valid image.";
        }
    } else {
        echo "Please choose a file to upload.";
    }
}

// Close connection
$conn->close();
?>
