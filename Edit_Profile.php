<?php
session_start(); // Start the session
// Retrieve data from session
$patient_name = $_SESSION['patient_name'] ?? '';
$age = $_SESSION['age'] ?? '';
$address = $_SESSION['address'] ?? '';
$mobile_number = $_SESSION['mobile_number'] ?? '';
$email = $_SESSION['email'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$blood_type = $_SESSION['blood_type'] ?? '';
$photo_path = $_SESSION['photo_path'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles if necessary -->
    <style>
        body {
            background: #fafafa;
            padding-top: 20px;
            margin-bottom: 50px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .jumbotron {
            background: #fff;
            padding: 2rem 1rem;
            border-radius: 12px;
            text-align: center;
            margin-top: -20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .profile-info {
            flex-grow: 1;
            margin-left: 20px;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h1, h3 {
            color: #3498db;
        }

        .btn-edit, .btn-save {
            background-color: #3498db;
            color: #ffffff;
            border: 2px solid #3498db;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1em;
            font-weight: bold;
        }

        .btn-save {
            background-color: #28a745;
            border: 2px solid #28a745;
        }

        .btn-edit:hover, .btn-save:hover {
            background-color: #ffffff;
            color: #3498db;
        }

        #photoInput {
            display: none;
        }

        .change-photo-label {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1em;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }

        .change-photo-label:hover {
            background-color: #ffffff;
            color: #3498db;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="profile-container">
            <div class="profile-pic">
                <?php
                if (!empty($photo_path)) {
                    echo "<img src='$photo_path' alt='Patient Photo' class='img-fluid'>";
                } else {
                    echo "No photo uploaded.";
                }
                ?>
            </div>
            <div class="profile-info">
                <h1><?php echo $patient_name; ?></h1>
                <h3><?php echo $age; ?> years old</h3>
                <p><?php echo $address; ?></p>
            </div>
        </div>

        <div class="jumbotron">
            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Add other form fields here -->

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number:</label>
                    <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>" required>
                </div>

                <div class="form-group">
                    <label for="blood_type">Blood Type:</label>
                    <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo $blood_type; ?>" required>
                </div>

                <label for="photoInput" class="change-photo-label">Change Profile Picture</label>
                <input type="file" id="photoInput" name="photo" accept="image/*">
                <button type="button" class="btn btn-edit" id="editBtn">Edit Profile</button>
                <button type="submit" class="btn btn-save" id="saveBtn" style="display:none;">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('editBtn').addEventListener('click', function () {
            // Enable form fields for editing
            document.getElementById('email').disabled = false;
            document.getElementById('mobile_number').disabled = false;
            document.getElementById('gender').disabled = false;
            document.getElementById('blood_type').disabled = false;

            // Toggle button visibility
            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'inline-block';
        });

        document.getElementById('photoInput').addEventListener('change', function () {
            // Enable the save button when a new photo is selected
            document.getElementById('saveBtn').style.display = 'inline-block';
        });
    </script>

    <script>
        // Check if the page URL has a query parameter indicating a successful save
        const urlParams = new URLSearchParams(window.location.search);
        const saveSuccess = urlParams.get('saveSuccess');

        // If the 'saveSuccess' parameter is present, reload the page after 3 seconds
        if (saveSuccess) {
            setTimeout(() => {
                location.reload();
            }, 3000); // 3000 milliseconds (3 seconds)
        }
    </script>

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
    @$email = $_POST["email"];
    @$mobile_number = $_POST["mobile_number"];
    @$gender = $_POST["gender"];
    @$blood_type = $_POST["blood_type"];

    // Update data in patient_profile table
    $sql = "UPDATE patient_profile SET email='$email', mobile_number='$mobile_number', gender='$gender', blood_type='$blood_type' WHERE patient_name='$patient_name'";

    if ($conn->query($sql) === TRUE) {
        // Update session variables
        $_SESSION['email'] = $email;
        $_SESSION['mobile_number'] = $mobile_number;
        $_SESSION['gender'] = $gender;
        $_SESSION['blood_type'] = $blood_type;

        // Check if a new photo is uploaded
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
                    // Update photo_path in patient_profile table
                    $sql_photo = "UPDATE patient_profile SET photo_path='$target_file' WHERE patient_name='$patient_name'";

                    if ($conn->query($sql_photo) === TRUE) {
                        // Update session variable
                        $_SESSION['photo_path'] = $target_file;
                    } else {
                        echo "Error updating photo path: " . $conn->error;
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file format. Please upload a valid image.";
            }
        }

        // Redirect with success parameter
        header('Location: Edit_Profile.php?saveSuccess=true');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
