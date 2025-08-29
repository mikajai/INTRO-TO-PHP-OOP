<?php
require_once 'database.php';

class Attendance extends Database {

    private $table = 'attendance';

    // method for inserting attendance
    public function createAttendance($student_id, $status) {
        $data = [
            "student_id" => $student_id,
            "attendance_date" => date("Y-m-d"),
            "attendance_status" => $status
        ];
        return $this->insert($this->table, $data);
    }

    // method for deleting attendance
    public function deleteAttendance($id) {
        return $this->delete($this->table, 'id = :id', ['id' => $id]);
    }

    // method for getting all attendance
    public function getAttendanceList() {
        $sql = "SELECT attendance.id, 
                    student.full_name, 
                    student.student_number, 
                    attendance.attendance_date, 
                    attendance.attendance_status
                FROM attendance 
                INNER JOIN student ON attendance.student_id = student.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>