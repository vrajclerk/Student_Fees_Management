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
        echo "New record created successfully";
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
    $fees_paid = $_POST['fees_paid'];
    $date = $_POST['date'];

    // Fetch the existing fees paid
    $result = $conn->query("SELECT fees_paid FROM students WHERE id='$id'");
    $row = $result->fetch_assoc();
    $existing_fees_paid = $row['fees_paid'];

    // Add the additional fees to the existing fees paid
    $new_fees_paid = $existing_fees_paid + $additional_fees;

    $sql = "UPDATE students SET roll_no='$roll_no', name='$name', fees_paid='$new_fees_paid', date='$date' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
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
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
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
            $search_result[] = $row;
        }
    } else {
        echo "No records found with Roll Number: " . $search_roll_no;
    }
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
<html>
<head>
    
    <title>Student Fee Management</title>   
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #50b3a2;
            color: #ffffff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        .header-buttons {
            display: inline-block;
            margin-left: 20px;
        }
        .header-buttons button {
            background-color: #50b3a2;
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
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            float: left;
            display: inline;
            padding: 0 20px 0 20px;
        }
        .form-style {
            background: #ffffff;
            padding: 20px;
            margin: 30px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-style input[type="text"],
        .form-style input[type="number"],
        .form-style input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-style input[type="submit"] {
            background-color: #50b3a2;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .form-style input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #50b3a2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .actions a {
            text-decoration: none;
            color: #50b3a2;
        }
        .actions a:hover {
            color: #e8491d;
        }
        /* .menu-button {
            background-color: #50b3a2;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .menu-button:hover {
            background-color: #45a049;
        } */
        #searchForm {
            display: none;
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
    </script>
</head>
<body>
    <header>
        <h1>CLERK'S EDUCATION POINT </h1> <br>
         <h2 >Student Fee Management</h2>
    <div  class="header-buttons" >
            <button onclick="toggleSearchForm()">Search</button>
            <form action="" method="post" style="display: inline;">
                <button type="submit" name="download">Download Report</button>
            </form>
        </div>
        </header>
    

    <div class="container">
        <div class="form-style">
            <h2>Add New Student Record</h2>
            <form action="" method="post">
                <label for="roll_no">Roll Number:</label>
                <input type="text" id="roll_no" name="roll_no" required><br><br>

                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="total_fees">Total Fees:</label>
                <input type="number" step="0.01" id="total_fees" name="total_fees" required><br><br>

                <label for="fees_paid">Fees Paid:</label>
                <input type="number" step="0.01" id="fees_paid" name="fees_paid" required><br><br>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

        
        <div id="searchForm" class="form-style">
            <h2>Search Student Record by Roll Number</h2>
            <form action="" method="post">
                <label for="search_roll_no">Roll Number:</label>
                <input type="text" id="search_roll_no" name="search_roll_no" required><br><br>
                
                <input type="submit" name="search" value="Search">
            </form>
        </div>

        <?php if (isset($_POST['search'])): ?>
        <h2>Search Results</h2>
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
            <?php foreach ($search_result as $student): ?>
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
                    <a href="?delete=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

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
                    <a href="?delete=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM students WHERE id='$id'");
        $student = $result->fetch_assoc();
        ?>
        <div class="form-style">
            <h2>Edit Student Record</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                
                <label for="roll_no">Roll Number:</label>
                <input type="text" id="roll_no" name="roll_no" value="<?php echo $student['roll_no']; ?>" required><br><br>

                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required><br><br>
                
                <label for="additional_fees">Additional Fees:</label>
                <input type="number" step="0.01" id="additional_fees" name="additional_fees" required><br><br>
                
                <label for="fees_paid">Fees Paid:</label>
                <input type="number" step="0.01" id="fees_paid" name="fees_paid" value="<?php echo $student['fees_paid']; ?>" required><br><br>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $student['date']; ?>" required><br><br>
                
                <input type="submit" name="update" value="Update">
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
