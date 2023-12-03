<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Panel - Resume - Khadija Begum</title>
        <link href="img/favicon.ico" rel="icon">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:300;400;600;700;800&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
        <link href="style_admin.css" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="51">
        <div class="wrapper">
            <div class="sidebar">
                <div class="sidebar-header">
                    <img src="img/profile.png" alt="Image">
                </div>
                <div class="sidebar-content">
                    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                        <a href="#" class="navbar-brand">Navigation</a>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#admin_header">Home<i class="fa fa-home"></i></a>
                                </li>
								 <li class="nav-item">
                                    <a class="nav-link" href="#admin_education">Education<i class="fa fa-tasks"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#admin_experience">Experience<i class="fa fa-star"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#admin_portfolio">Portfolio<i class="fa fa-file-archive"></i></a>
                                </li>
								<li class="nav-item"></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="admin-content">
            <div class="content">
				<div class="header" id="admin_header">
                    <div class="content-inner">
                        <p>Welcome To</p>
                        <h1>Admin Panel</h1>
                        <h2>Resume - Khadija Begum</h2>						
                    </div>
                </div>
				<div class="section-space">
					
				</div>
                
				<div class="education" id="admin_education">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>EDUCATION</h2>
                        </div>
                       <!-- Add New Education Form -->
					   <div class="row">
							<div class="col-md-4">
								<div class="row admin-form-row">
									<form class="add-new-form" id="addNewEducationForm" method="post" enctype="multipart/form-data">
											<input type="text" name="degree" placeholder="Degree" required />
											<input type="text" name="program" placeholder="Program" required />
											<input type="text" name="institute" placeholder="Institute" required />
											<input type="text" name="cgpa_gpa" placeholder="CGPA/GPA" required />
										<button type="submit" name="submit" class="col-md-12">Add Education</button>
									</form>
								</div>
							</div>
							<?php
							include('connect_db.php');

							if(isset($_POST['submit'])) {
								$a = $_POST['degree'];
								$b = $_POST['program'];    
								$c = $_POST['institute'];    
								$d = $_POST['cgpa_gpa'];    

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("INSERT INTO education (degree, program, institute, cgpa_gpa) VALUES (?, ?, ?, ?)");
								$stmt->bind_param("ssss", $a, $b, $c, $d);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>
							<div class="col-md-4">
								<!-- Modify Education Form -->
								<div class="row admin-form-row">
									<form class="modify-existing-form" id="modifyExistingEducationForm" method="post">
										<select name="existingEducation" required>
											<?php
											include('connect_db.php');

											// Fetch education entries from the database
											$result = $conn->query("SELECT degree FROM education");

											// Check if there are any entries
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['degree'] . '">' . $row['degree'] . '</option>';
												}
											} else {
												echo '<option value="">No education entries found</option>';
											}

											// Close the database connection
											$conn->close();
											?>
										</select>
										<input type="text" name="newDegree" placeholder="New Degree" required />
										<input type="text" name="newProgram" placeholder="New Program" required />
										<input type="text" name="newInstitute" placeholder="New Institute" required />
										<input type="text" name="newCGPA_GPA" placeholder="New CGPA/GPA" required />
										<button type="submit" name="modifyEducation" class="col-md-12">Modify Education</button>
									</form>
								</div>
							</div>

							<?php
							include('connect_db.php');

							if (isset($_POST['modifyEducation'])) {
								$existingEducation = $_POST['existingEducation'];
								$newDegree = $_POST['newDegree'];
								$newProgram = $_POST['newProgram'];
								$newInstitute = $_POST['newInstitute'];
								$newCGPA_GPA = $_POST['newCGPA_GPA'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("UPDATE education SET degree=?, program=?, institute=?, cgpa_gpa=? WHERE degree=?");
								$stmt->bind_param("sssss", $newDegree, $newProgram, $newInstitute, $newCGPA_GPA, $existingEducation);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>
							<div class="col-md-4">
								<!-- Delete Education Form -->
								<div class="row admin-form-row">
									<form class="delete-form" id="deleteEducationForm" method="post">
										<select class="education-dropdown" name="educationDropdown" required>
											<?php
											include('connect_db.php');

											// Fetch education entries from the database
											$result = $conn->query("SELECT degree FROM education");

											// Check if there are any entries
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['degree'] . '">' . $row['degree'] . '</option>';
												}
											} else {
												echo '<option value="">No education entries found</option>';
											}

											// Close the database connection
											$conn->close();
											?>
										</select>
										<button type="submit" name="deleteEducation" class="col-md-12">Delete Education</button>
									</form>
								</div>
							</div>

							<?php
							include('connect_db.php');

							if (isset($_POST['deleteEducation'])) {
								$educationToDelete = $_POST['educationDropdown'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("DELETE FROM education WHERE degree=?");
								$stmt->bind_param("s", $educationToDelete);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>

						</div>
                    </div>
                </div>
				<div class="section-space">
					
				</div>
				<div class="experience" id="admin_experience">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>EXPERIENCE</h2>
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<!-- Add New Experience Form -->
								<div class="row admin-form-row">
									<form class="add-new-form" id="addNewExperienceForm" method="post">
										<input type="text" name="job_title" placeholder="Job Title" required />
										<input type="text" name="company" placeholder="Company" required />
										<input type="text" name="location" placeholder="Location" required />
										<input type="text" name="start_date" placeholder="Start Date" required />
										<input type="text" name="end_date" placeholder="End Date" />
										<button type="submit" name="submitExperience" class="col-md-12">Add Experience</button>
									</form>
								</div>
							</div>

							<?php
							include('connect_db.php');

							if (isset($_POST['submitExperience'])) {
								$jobTitle = $_POST['job_title'];
								$company = $_POST['company'];
								$location = $_POST['location'];
								$startDate = $_POST['start_date'];
								$endDate = $_POST['end_date'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("INSERT INTO experience (job_title, company, location, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
								$stmt->bind_param("sssss", $jobTitle, $company, $location, $startDate, $endDate);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>

							<div class="col-md-4">
								<!-- Modify Experience Form -->
								<div class="row admin-form-row">
									<form class="modify-existing-form" id="modifyExistingExperienceForm" method="post">
										<select name="existingExperience" required>
											<?php
											include('connect_db.php');

											// Fetch experience entries from the database
											$result = $conn->query("SELECT job_title FROM experience");

											// Check if there are any entries
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['job_title'] . '">' . $row['job_title'] . '</option>';
												}
											} else {
												echo '<option value="">No experience entries found</option>';
											}

											// Close the database connection
											$conn->close();
											?>
										</select>
										<input type="text" name="newJobTitle" placeholder="New Job Title" required />
										<input type="text" name="newCompany" placeholder="New Company" required />
										<input type="text" name="newLocation" placeholder="New Location" required />
										<input type="text" name="newStartDate" placeholder="New Start Date" required />
										<input type="text" name="newEndDate" placeholder="New End Date" />
										<button type="submit" name="modifyExperience" class="col-md-12">Modify Experience</button>
									</form>
								</div>
							</div>

							<?php
							include('connect_db.php');

							if (isset($_POST['modifyExperience'])) {
								$existingExperience = $_POST['existingExperience'];
								$newJobTitle = $_POST['newJobTitle'];
								$newCompany = $_POST['newCompany'];
								$newLocation = $_POST['newLocation'];
								$newStartDate = $_POST['newStartDate'];
								$newEndDate = $_POST['newEndDate'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("UPDATE experience SET job_title=?, company=?, location=?, start_date=?, end_date=? WHERE job_title=?");
								$stmt->bind_param("ssssss", $newJobTitle, $newCompany, $newLocation, $newStartDate, $newEndDate, $existingExperience);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>

							<div class="col-md-4">
								<!-- Delete Experience Form -->
								<div class="row admin-form-row">
									<form class="delete-form" id="deleteExperienceForm" method="post">
										<select class="experience-dropdown" name="experienceDropdown" required>
											<?php
											include('connect_db.php');

											// Fetch experience entries from the database
											$result = $conn->query("SELECT job_title FROM experience");

											// Check if there are any entries
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['job_title'] . '">' . $row['job_title'] . '</option>';
												}
											} else {
												echo '<option value="">No experience entries found</option>';
											}

											// Close the database connection
											$conn->close();
											?>
										</select>
										<button type="submit" name="deleteExperience" class="col-md-12">Delete Experience</button>
									</form>
								</div>
							</div>

							<?php
							include('connect_db.php');

							if (isset($_POST['deleteExperience'])) {
								$experienceToDelete = $_POST['experienceDropdown'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("DELETE FROM experience WHERE job_title=?");
								$stmt->bind_param("s", $experienceToDelete);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>

                        </div>
                    </div>
                </div>
				<div class="section-space">
					
				</div>
				<div class="portfolio" id="admin_portfolio">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>PORTFOLIO</h2>
						</div>
						<div class="row">
							<div class="col-md-4">
								<!-- Add New Portfolio Form -->
								<div class="row admin-form-row">
									<form class="add-new-form" id="addNewPortfolioForm" method="post" enctype="multipart/form-data">
										<select name="category" required>
											<option value="Graphic Design">Graphic Design</option>
											<option value="UI Design">UI Design</option>
											<option value="Web Design">Web Design</option>
											<option value="Web Development">Web Development</option>
											<!-- Add other categories as needed -->
										</select>
										<input type="text" name="projectName" placeholder="Project Name" required />
										<input type="file" name="img" accept="image/*" required />
										<button type="submit" name="addPortfolio" class="col-md-12">Add Portfolio</button>
									</form>
								</div>
							</div>

							<?php
								include('connect_db.php'); 

								if (isset($_POST['addPortfolio'])) {
									$category = $_POST['category'];
									$projectName = $_POST['projectName'];

									$uploadDirectory = "image_path/";

									// Create the directory if it doesn't exist
									if (!file_exists($uploadDirectory)) {
										mkdir($uploadDirectory, 0755, true);
									}

									$file = $_FILES['img']['tmp_name'];
									$imagePath = $uploadDirectory . $_FILES['img']['name'];

									move_uploaded_file($file, $imagePath);

									// Using MySQLi for database interaction
									$conn = new mysqli($servername, $username, $password, $dbname);

									// Check connection
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									}

									// Prepare and bind the statement
									$stmt = $conn->prepare("INSERT INTO portfolio (category, project_name, image_path) VALUES (?, ?, ?)");
									$stmt->bind_param("sss", $category, $projectName, $imagePath);

									// Execute the statement
									if ($stmt->execute()) {
										echo "";
									} else {
										echo "Error: " . $stmt->error;
									}

									// Close the statement and connection
									$stmt->close();
									$conn->close();
								}
							?>

							<div class="col-md-4">
								<!-- Modify Portfolio Form -->
								<div class="row admin-form-row">
									<form class="modify-existing-form" id="modifyExistingPortfolioForm" method="post" enctype="multipart/form-data">
										<select class="portfolio-type-dropdown" name="portfolioTypeDropdown" id="portfolioTypeDropdown" required>
										<?php
										include('connect_db.php');

										// Fetch unique categories from the portfolio table
										$resultCategories = $conn->query("SELECT DISTINCT category FROM portfolio");

										// Check if there are any categories
										if ($resultCategories->num_rows > 0) {
											while ($rowCategory = $resultCategories->fetch_assoc()) {
												$category = $rowCategory['category'];
												echo '<option value="' . $category . '" ' . ($category == $selectedCategory ? 'selected' : '') . '>' . $category . '</option>';
											}
										} else {
											echo '<option value="">No categories found</option>';
										}

										// Close the database connection
										$conn->close();
										?>
										</select>
										<script>
											// Function to update project names based on the selected category
											function updateProjectNames() {
												var selectedCategory = document.getElementById("portfolioTypeDropdown").value;

												// Use AJAX to fetch project names
												var xhr = new XMLHttpRequest();
												xhr.open("POST", "get_project_names.php", true);
												xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
												xhr.onreadystatechange = function () {
													if (xhr.readyState == 4 && xhr.status == 200) {
														// Update the project names dropdown
														document.getElementById("portfolioNameDropdown").innerHTML = xhr.responseText;
													}
												};

												// Send the selected category to the server
												xhr.send("selectedCategory=" + selectedCategory);
											}

											// Attach the function to the category dropdown's onchange event
											document.getElementById("portfolioTypeDropdown").addEventListener("change", updateProjectNames);

											// Initial call to populate project names based on the default category
											updateProjectNames();
										</script>
										<select class="portfolio-name-dropdown" name="portfolioNameDropdown" id="portfolioNameDropdown" required>
										   

										</select>

										<input type="text" name="newProjectName" placeholder="New Project Name" required />
										<input type="file" name="img" accept="image/*" required />
										<button type="submit" name="modifyPortfolio" class="col-md-12">Modify Portfolio</button>
									</form>
								</div>
							</div>
							<?php
							include('connect_db.php');

							// Get the ID from the URL
							$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

							if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifyPortfolio'])) {
								$selectedCategory = $_POST['portfolioTypeDropdown'];
								$selectedProjectName = $_POST['portfolioNameDropdown'];
								$newProjectName = $_POST['newProjectName'];

								// Validate uploaded file
								$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
								$fileExtension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));

								if (!in_array($fileExtension, $allowedExtensions)) {
									echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
									exit;
								}

								$uploadDirectory = "image_path/";

								// Create the directory if it doesn't exist
								if (!file_exists($uploadDirectory)) {
									mkdir($uploadDirectory, 0755, true);
								}

								$file = $_FILES['img']['tmp_name'];
								$imagePath = $uploadDirectory . $_FILES['img']['name'];

								if (!move_uploaded_file($file, $imagePath)) {
									echo "Error: Failed to move the uploaded file.";
									exit;
								}

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement
								$stmt = $conn->prepare("UPDATE portfolio SET project_name=?, image_path=? WHERE category=? AND project_name=?");
								$stmt->bind_param("ssss", $newProjectName, $imagePath, $selectedCategory, $selectedProjectName);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>

							<div class="col-md-4">
								<!-- Delete Portfolio Form -->
								<div class="row admin-form-row">
									<form class="delete-form" id="deletePortfolioForm" method="post" enctype="multipart/form-data">
										<select class="portfolio-type-dropdown" name="portfolioTypeDropdown" id="deletePortfolioTypeDropdown" required>
											<?php
											include('connect_db.php');

											// Fetch unique categories from the portfolio table
											$resultCategories = $conn->query("SELECT DISTINCT category FROM portfolio");

											// Check if there are any categories
											if ($resultCategories->num_rows > 0) {
												while ($rowCategory = $resultCategories->fetch_assoc()) {
													$category = $rowCategory['category'];
													echo '<option value="' . $category . '" ' . ($category == $selectedDeleteCategory ? 'selected' : '') . '>' . $category . '</option>';
												}
											} else {
												echo '<option value="">No categories found</option>';
											}

											// Close the database connection
											$conn->close();
											?>
										</select>
										<script>
											// Function to update project names based on the selected category for delete form
											function updateDeleteProjectNames() {
												var selectedDeleteCategory = document.getElementById("deletePortfolioTypeDropdown").value;

												// Use AJAX to fetch project names
												var xhr = new XMLHttpRequest();
												xhr.open("POST", "get_project_names.php", true);
												xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
												xhr.onreadystatechange = function () {
													if (xhr.readyState == 4 && xhr.status == 200) {
														// Update the project names dropdown for delete form
														document.getElementById("deletePortfolioNameDropdown").innerHTML = xhr.responseText;
													}
												};

												// Send the selected category to the server
												xhr.send("selectedCategory=" + selectedDeleteCategory);
											}

											// Attach the function to the category dropdown's onchange event for delete form
											document.getElementById("deletePortfolioTypeDropdown").addEventListener("change", updateDeleteProjectNames);

											// Initial call to populate project names based on the default category for delete form
											updateDeleteProjectNames();
										</script>
										<select class="portfolio-name-dropdown" name="portfolioNameDropdown" id="deletePortfolioNameDropdown" required>
											<!-- Options will be dynamically populated here for delete form -->
										</select>
										<button type="submit" name="deleteportfolio">Delete Portfolio</button>
									</form>
								</div>
							</div>
							<?php
							include('connect_db.php');

							if (isset($_POST['deleteportfolio'])) {
								$selectedCategory = $_POST['portfolioTypeDropdown'];
								$selectedPortfolio = $_POST['portfolioNameDropdown'];

								// Using MySQLi for database interaction
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								}

								// Prepare and bind the statement with the correct column names
								$stmt = $conn->prepare("DELETE FROM portfolio WHERE category=? AND project_name=?");
								$stmt->bind_param("ss", $selectedCategory, $selectedPortfolio);

								// Execute the statement
								if ($stmt->execute()) {
									echo "";
								} else {
									echo "Error: " . $stmt->error;
								}

								// Close the statement and connection
								$stmt->close();
								$conn->close();
							}
							?>
				<div class="section-space">
					
				</div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="script_admin.js"></script>
        </div>

    </body>
</html>
