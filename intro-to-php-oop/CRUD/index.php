<?php
require_once __DIR__ . "/classes/student.php";
require_once __DIR__ . "/classes/attendance.php";

$studentObj = new Student();
$attendanceObj = new Attendance();


if (isset($_POST['add_student'])) {
    $studentObj->createStudent($_POST['student_name'], $_POST['student_number'], $_POST['student_email']);
    header("Location: index.php#studentInfoSection"); 
    exit;
}

if (isset($_GET['delete_student'])) {
    $studentObj->deleteStudent($_GET['delete_student']);
    header("Location: index.php#studentInfoSection"); 
    exit;
}

if (isset($_POST['track_attendance'])) {
    foreach ($_POST['attendance'] as $student_id => $status) {
        $attendanceObj->createAttendance($student_id, $status);
    }
    header("Location: index.php#studentAttendanceSection");
    exit;
}

if (isset($_GET['delete_attendance'])) {
    $attendanceObj->deleteAttendance($_GET['delete_attendance']);
    header("Location: index.php#studentAttendanceSection");
    exit;
}

// list for both student and attendance
$students = $studentObj->getStudentList();
$attendance = $attendanceObj->getAttendanceList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #3E0703;
            color: white;
            padding: 1em 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav h1 {
            margin: 0;
            font-size: 1.5em;
        }

        nav li {
            display: inline;
            margin-left: 20px;
            list-style: none;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        section {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2 {
            color: #343a40;
        }

        form p {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        select {
            padding: 8px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 0.5px solid #ddd;
        }

        th {
            background-color: #8C1007;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #dc3545;
            text-decoration: none;
        }

        .inline-form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .inline-form label {
            display: flex;
            flex-direction: column;
            font-weight: bold;
        }

        .inline-form input[type="text"],
        .inline-form input[type="email"] {
            width: 400px;
        }

        .inline-form button {
            height: 40px;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <!-- simple navigation bar for separating student and attendance sections -->
    <nav>
        <h1><a href="index.php">Student Attendance System</a></h1>
        <ul>
            <li><a href="#studentInfoSection" id="showStudentInfo">Student Info</a></li>
            <li><a href="#studentAttendanceSection" id="showAttendance">Student Attendance</a></li>
        </ul>
    </nav>


    <!-- student section -->
    <section id="studentInfoSection" style="display: block;">
        
        <h2>Add Student Information</h2>

        <form method="POST" class="inline-form">
            <label>Full Name: <input type="text" name="student_name" required></label>
            <label>Student No.: <input type="text" name="student_number" required></label>
            <label>Email: <input type="email" name="student_email" required></label>
            <button type="submit" name="add_student">Add Student</button>
        </form>


        <!-- student record -->
        <h2>Student Records</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Student No.</th>
                <th>Email</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
            <?php foreach ($students as $stu): ?>
                <tr>
                    <td><?= htmlspecialchars($stu['full_name']) ?></td>
                    <td><?= htmlspecialchars($stu['student_number']) ?></td>
                    <td><?= htmlspecialchars($stu['email']) ?></td>
                    <td><?= htmlspecialchars($stu['date_added']) ?></td>
                    <td><a href="?delete_student=<?= $stu['id'] ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </section>


    <!-- attendance section -->
    <section id="studentAttendanceSection" style="display: none;">
        <form method="POST">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Student No.</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($students as $stu): ?>
                    <tr>
                        <td><?= htmlspecialchars($stu['full_name']) ?></td>
                        <td><?= htmlspecialchars($stu['student_number']) ?></td>
                        <td>
                            <select name="attendance[<?= $stu['id'] ?>]">
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Late">Late</option>
                                <option value="Excused">Excused</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div style="text-align: right; margin-top: 10px;">
                <button class="track_attendance_button" type="submit" name="track_attendance">
                    Save Attendance
                </button>
            </div>

        </form>
 

        <!-- attendance records -->
        <h2>Attendance Records</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Student No.</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($attendance as $att): ?>
                <tr>
                    <td><?= htmlspecialchars($att['full_name']) ?></td>
                    <td><?= htmlspecialchars($att['student_number']) ?></td>
                    <td><?= htmlspecialchars($att['attendance_date']) ?></td>
                    <td><?= htmlspecialchars($att['attendance_status']) ?></td>
                    <td><a href="?delete_attendance=<?= $att['id'] ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </section>


    <!-- javascripts -->
    <script>
        const studentInfoSection = document.getElementById('studentInfoSection');
        const studentAttendanceSection = document.getElementById('studentAttendanceSection');

        const showStudentInfoBtn = document.getElementById('showStudentInfo');
        const showAttendanceBtn = document.getElementById('showAttendance');

        showStudentInfoBtn.addEventListener('click', function (event) {
            event.preventDefault();
            studentInfoSection.style.display = 'block';
            studentAttendanceSection.style.display = 'none';
        });

        showAttendanceBtn.addEventListener('click', function (event) {
            event.preventDefault();
            studentInfoSection.style.display = 'none';
            studentAttendanceSection.style.display = 'block';

        });

        window.addEventListener('DOMContentLoaded', () => {
            if (window.location.hash === '#studentInfoSection') {
                studentInfoSection.style.display = 'block';
                studentAttendanceSection.style.display = 'none';
            } else if (window.location.hash === '#studentAttendanceSection') {
                studentInfoSection.style.display = 'none';
                studentAttendanceSection.style.display = 'block';
            }
        });

    </script>
</body>
</html>