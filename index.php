<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Student Registration</h2>
        <form method="post" action="">
            <label for="studentname">Student Name:</label>
            <input type="text" name="studentname" required>

            <label for="studentid">Student ID:</label>
            <input type="text" name="studentid" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" required>

            <label for="courseid">Course ID:</label>
            <input type="text" name="courseid" required>

            <input type="submit" name="submit" value="Save Record">
        </form>

        <?php
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Connect to MySQL
        // Use port 3307 if your MySQL is running on that port
        $conn = new mysqli("localhost", "root", "", "studentdb", 3307);  // Add password if you have one

        // Check for connection error
        if ($conn->connect_error) {
            die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
        }

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Escape the input data to prevent SQL injection
            $studentname = $conn->real_escape_string($_POST['studentname']);
            $studentid = $conn->real_escape_string($_POST['studentid']);
            $dob = $conn->real_escape_string($_POST['dob']);
            $courseid = $conn->real_escape_string($_POST['courseid']);

            // Insert data into the database
            $sql = "INSERT INTO Students (studentname, studentid, dob, courseid)
                    VALUES ('$studentname', '$studentid', '$dob', '$courseid')";

            // Check if the query was successful
            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>Record saved successfully!</p>";
            } else {
                echo "<p class='error'>Error: " . $conn->error . "</p>";
            }
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
