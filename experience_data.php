<?php
include('connect_db.php');

// Fetch experience entries from the database
$result = $conn->query("SELECT job_title, company, location, start_date, end_date FROM experience");

// Check if there are any entries
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6">';
        echo '<div class="exp-col">';
        echo '<span>' . $row['start_date'] . ' to ' . ($row['end_date'] ? $row['end_date'] : 'Present') . '</span>';
        echo '<h3>' . $row['company'] . '</h3>';
        echo '<h4>' . $row['location'] . '</h4>';
        echo '<h5>' . $row['job_title'] . '</h5>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-md-12">';
    echo '<p>No experience entries found</p>';
    echo '</div>';
}

// Close the database connection
$conn->close();
?>
