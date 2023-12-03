<?php
include('connect_db.php');

// Fetch education entries from the database
$result = $conn->query("SELECT degree, program, institute, cgpa_gpa FROM education");

// Check if there are any entries
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6">';
        echo '<div class="edu-col">';
        echo '<h3>' . $row['degree'] . '</h3>';
        echo '<p>';
        echo $row['program'] . '<br>';
        echo $row['institute'] . '<br>';
        echo 'CGPA/GPA - ' . $row['cgpa_gpa'];
        echo '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No education entries found</p>';
}

// Close the database connection
$conn->close();
?>
