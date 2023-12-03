 <?php
include('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCategory = $_POST['selectedCategory'];

    // Using MySQLi for database interaction
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch project names based on the selected category
    $stmt = $conn->prepare("SELECT project_name FROM portfolio WHERE category = ?");
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any project names
    if ($result->num_rows > 0) {
        while ($rowProject = $result->fetch_assoc()) {
            echo '<option value="' . $rowProject['project_name'] . '">' . $rowProject['project_name'] . '</option>';
        }
    } else {
        echo '<option value="">No project names found</option>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>