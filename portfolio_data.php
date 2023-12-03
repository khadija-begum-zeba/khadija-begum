<?php
include('connect_db.php');

// Fetch portfolio entries from the database
$result = $conn->query("SELECT category, project_name, image_path FROM portfolio");

// Check if there are any entries
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-4 col-md-6 portfolio-item ' . $row['category'] . '">';
        echo '<div class="portfolio-wrap">';
        echo '<figure>';
        echo '<img src="' . $row['image_path'] . '" class="img-fluid" alt="">';
        echo '<a href="' . $row['image_path'] . '" data-lightbox="portfolio" data-title="' . $row['project_name'] . '" class="link-preview" title="Preview"><i class="fa fa-eye"></i></a>';
        echo '<a class="portfolio-title" href="#">' . $row['project_name'] . ' <span>' . $row['category'] . '</span></a>';
        echo '</figure>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No portfolio entries found</p>';
}

// Close the database connection
$conn->close();
?>
