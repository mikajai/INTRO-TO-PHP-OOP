<?php
require_once 'database.php';

class Student extends Database {

    private $table = "student";

    // method for creating student record
    public function createStudent($name, $student_number, $email) {
        $data = [
            'full_name' => $name,
            'student_number' => $student_number,
            'email' => $email,
            'date_added' => date("Y-m-d H:i:s")
        ];
        return $this->insert($this->table, $data);

    }

    // to update student list
    public function updateStudent($id, $name, $student_number, $email) {
        $data = [
            'full_name' => $name,
            'student_number' => $student_number,
            'email' => $email,
        ];
        return $this->update($this->table, $data, 'id = :id', ['id' => $id]);
    }

    // deleting a student in the list
    public function deleteStudent($id) {
        return $this->delete($this->table, 'id = :id', ['id' => $id]);
    }

    // getting all the student list
    public function getStudentList() {
        return $this->read($this->table);
    }
}

?>