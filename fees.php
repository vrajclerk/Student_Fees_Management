<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_fees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Use the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_no VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    total_fees DECIMAL(10, 2) NOT NULL,
    fees_paid DECIMAL(10, 2) NOT NULL,
    remaining_fees DECIMAL(10, 2) GENERATED ALWAYS AS (total_fees - fees_paid) STORED,
    date DATE NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Handle form submission for adding new student record
if (isset($_POST['submit'])) {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $total_fees = $_POST['total_fees'];
    $fees_paid = $_POST['fees_paid'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO students (roll_no, name, total_fees, fees_paid, date) VALUES ('$roll_no', '$name', '$total_fees', '$fees_paid', '$date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle form submission for updating student record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $additional_fees = $_POST['additional_fees'];
    $date = $_POST['date'];

    // Fetch the existing fees paid
    $result = $conn->query("SELECT fees_paid FROM students WHERE id='$id'");
    $row = $result->fetch_assoc();
    $existing_fees_paid = $row['fees_paid'];

    // Add the additional fees to the existing fees paid
    $new_fees_paid = $existing_fees_paid + $additional_fees;

    $sql = "UPDATE students SET roll_no='$roll_no', name='$name', fees_paid='$new_fees_paid', date='$date' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle deletion of student record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch records to display in the table
$students = [];
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Handle search by roll number
$search_result = [];
if (isset($_POST['search'])) {
    $search_roll_no = $_POST['search_roll_no'];
    $sql = "SELECT * FROM students WHERE roll_no='$search_roll_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['date'] = date('d-m-Y', strtotime($row['date'])); // Convert date format for display
            $search_result[] = $row;
        }
    } else {

            $search_result[] = $row;
        }
    } else {
        echo "<script>alert('No records found with Roll Number: $search_roll_no');</script>";
    }


if (isset($_POST['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="student_records.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Roll Number', 'Name', 'Total Fees', 'Fees Paid', 'Remaining Fees', 'Date'));
    foreach ($students as $student) {
        fputcsv($output, $student);
    }
    fclose($output);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Fee Management</title>
    <style>
         body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: left;
            display: flex;
            align-items: left;
            justify-content: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .banner {
            display: flex;
            align-items: center;
            justify-content: left;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .banner img {
            height: 50px;
            margin-right: 20px;
        }
        .banner h1 {
            font-size: 24px;
            color: white;
            margin: 0;
        }
        .form-style {
            background: #f9f9f9;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .form-style input[type="text"],
        .form-style input[type="number"],
        .form-style input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        .form-style input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .form-style input[type="submit"]:hover {
            background-color: #45a049;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .actions a {
            text-decoration: none;
            color: #4CAF50;
            margin-right: 10px;
        }
        .actions a:hover {
            color: #e8491d;
        }
        .header-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .header-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }
        .header-buttons button:hover {
            background-color: #45a049;
        }
        #searchForm {
            display: none;
        }
        .logo {
            max-height: 60px;
            margin-right: 15px;
        }
    </style>
    <script>
        function toggleSearchForm() {
            var searchForm = document.getElementById('searchForm');
            if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                searchForm.style.display = 'block';
            } else {
                searchForm.style.display = 'none';
            }
        }
        function clearForm() {
            document.getElementById('addStudentForm').reset();
        }
    </script>
</head>
<body>
    <header>
        <?php
        $logoPath = '"C:\Users\Admin\OneDrive\Pictures\project\cep_logo.jpg"'; 
        ?>
        <div class="banner">
            <h1>CLERK'S EDUCATION POINT </h1>   
            <img src="<?php echo $logoPath; ?>" alt="Logo" class="logo">
            <h1>Student Fee Management</h1>
        </div>
    </header>
    <div class="header-buttons">
        <button onclick="document.getElementById('addStudentForm').scrollIntoView();">Add Student</button>
        <button onclick="toggleSearchForm()">Search Student</button>
        <form method="post" style="display:inline-block;">
            <input type="hidden" name="download" value="true">
            <button type="submit">Download CSV</button>
        </form>
    </div>
    <div class="container">
        <div id="addStudentForm" class="form-style">
            <h2>Add Student Record</h2>
            <form method="post" action="">
                <label for="roll_no">Roll Number</label>
                <input type="text" id="roll_no" name="roll_no" required>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                <label for="total_fees">Total Fees</label>
                <input type="number" id="total_fees" name="total_fees" step="0.01" required>
                <label for="fees_paid">Fees Paid</label>
                <input type="number" id="fees_paid" name="fees_paid" step="0.01" required>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
                <input type="submit" name="submit" value="Add Student">
            </form>
        </div>
        <div id="searchForm" class="form-style">
            <h2>Search Student Record</h2>
            <form method="post" action="">
                <label for="search_roll_no">Roll Number</label>
                <input type="text" id="search_roll_no" name="search_roll_no" required>
                <input type="submit" name="search" value="Search">
            </form>
        </div>
        <div class="table-container">
            <h2>Student Records</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Total Fees</th>
                    <th>Fees Paid</th>
                    <th>Remaining Fees</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['roll_no']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['total_fees']; ?></td>
                        <td><?php echo $student['fees_paid']; ?></td>
                        <td><?php echo $student['remaining_fees']; ?></td>
                        <td><?php echo $student['date']; ?></td>
                        <td class="actions">
                            <a href="?edit=<?php echo $student['id']; ?>">Edit</a> | 
                            <a href="?delete=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
