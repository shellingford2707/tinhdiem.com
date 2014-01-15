<?php

class DBUltility {
    
    private static $database;

    private static function initialConnection() {
        try {
            self::$database = new mysqli('localhost', 'root', '', 'tinhdiem.com');
            self::$database->set_charset('utf8');
        } catch (Exception $ex) {
            echo "Failed to connect to MySQL: " . $ex->getMessage();
        }
    }

    private static function closeConnection() {
        try {
            if (self::$database != NULL) {
                mysqli_close(self::$database);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function insert_tblClass($classID, $className) {
        self::initialConnection();
        try {
            $query = "CALL sp_insertClass(?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("ss", $classID, $className);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function update_tblClass($className, $classID) {
        self::initialConnection();
        try {
            $query = "CALL sp_updateClass(?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("ss", $className, $classID);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function delete_tblClass($classID) {
        self::initialConnection();
        try {
            $query = "CALL sp_deleteClass(?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("s", $classID);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function insert_tblFaculty($FacultyID, $FacultyName) {
        self::initialConnection();
        try {
            $query = "CALL sp_insertFaculty(?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("ss", $FacultyID, $FacultyName);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function update_tblFaculty($FacultyName, $FacultyID) {
        self::initialConnection();
        try {
            $query = "CALL sp_updateFaculty(?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("ss", $FacultyName, $FacultyID);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function delete_tblFaculty($FacultyID) {
        self::initialConnection();
        try {
            $query = "CALL sp_deleteFaculty(?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("s", $classID);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function insert_tblStudent($rollNumber, $studentName, $classID, $mark, $created, $updated, $credit_completed, $credit_miss, $major, $facultyID) {
        self::initialConnection();
        try {
            $query = "CALL sp_insertStudent(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $dateCreated = date($created);
                $dateUpdated = date($updated);
                $stm->bind_param("sssdssiiss", $rollNumber, $studentName, $classID, $mark, $dateCreated, $dateUpdated, $credit_completed, $credit_miss, $major, $facultyID);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function update_tblStudent($studentName, $classID, $mark, $created, $updated, $credit_completed, $credit_miss, $major, $facultyID, $rollNumber) {
        self::initialConnection();
        try {
            $query = "CALL sp_updateStudent(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $dateCreated = date($created);
                $dateUpdated = date($updated);
                $stm->bind_param("ssdssiisss", $studentName, $classID, $mark, $dateCreated, $dateUpdated, $credit_completed, $credit_miss, $major, $facultyID, $rollNumber);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function delete_tblStudent($rollNumber) {
        self::initialConnection();
        try {
            $query = "CALL sp_deleteStudent(?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("s", $rollNumber);
                $stm->execute();
                if ($stm->errno == 0) {
                    return true;
                } else
                    return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
    }

    public static function getRankInClass($rollNumber) {
        self::initialConnection();
        $rankValue = 0;
        try {
            $result = mysqli_query(self::$database, "CALL sp_getRankInClass('" . $rollNumber . "')") or die("Query FAIL: " . mysqli_errno());
            $stm = self::$database->stmt_init();
            if ($row = mysqli_fetch_array($result)) {
                $rankValue = $row[0];
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
        return $rankValue;
    }

    public static function getRankInMajor($rollNumber) {
        self::initialConnection();
        $rankValue = 0;
        try {
            $result = mysqli_query(self::$database, "CALL sp_getRankInMajor('" . $rollNumber . "')") or die("Query FAIL: " . mysqli_errno());
            $stm = self::$database->stmt_init();
            if ($row = mysqli_fetch_array($result)) {
                $rankValue = $row[0];
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
        return $rankValue;
    }

    public static function getRankInSchool($rollNumber) {
        self::initialConnection();
        $rankValue = 0;
        try {
            $result = mysqli_query(self::$database, "CALL sp_getRankInSchool('" . $rollNumber . "')") or die("Query FAIL: " . mysqli_errno());
            $stm = self::$database->stmt_init();
            if ($row = mysqli_fetch_array($result)) {
                $rankValue = $row[0];
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        self::closeConnection();
        return $rankValue;
    }

}
?>
