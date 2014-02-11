<?php

$current_file_path = dirname(__DIR__);
include ($current_file_path . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'Major.php');
include ($current_file_path . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'Clazz.php');
if (!class_exists("Student")) {
    include ($current_file_path . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'Student.php');
}

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

    /**
     * 
     * @param Clazz $class
     * @return boolean
     */
    public static function insert_tblClass($class) {
        self::initialConnection();
        try {
            $query = "CALL sp_insertClass(?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("s", $class->getClassName());
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

    /**
     * @param Student $stu
     */
    public static function insert_tblStudent($stu) {
        $studentID = $stu->getStudentID();
        $studentName = $stu->getStudentName();
        $mark = $stu->getMark();
        $credit_completed = $stu->getCredit_completed();
        $credit_miss = $stu->getCredit_miss();
        $grade = $stu->getGrade();
        $major = $stu->getMajor();

        $class = self::getClassByName($stu->getClassName());
        if ($class == NULL) {
            $class = new Clazz();
            $class->setClassName($stu->getClassName());
            if (self::insert_tblClass($class)) {
                $class->setClassID(mysqli_insert_id(self::$database));
            }
        }

        self::initialConnection();
        try {
            $query = "CALL sp_insertStudent(?, ?, ?, ?, ?, ?, ?, ?);";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("ssidiisi", $studentID
                        , $studentName
                        , $class->getClassID()
                        , $mark
                        , $credit_completed
                        , $credit_miss
                        , $grade
                        , $major);
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

    public static function update_tblStudent($stu) {
        $rollNumber = $stu->getStudentID();
        $studentName = $stu->getStudentName();
        $class = self::getClassByName($stu->getClassName());
        $mark = $stu->getMark();
        $credit_completed = $stu->getCredit_completed();
        $credit_miss = $stu->getCredit_miss();
        $grade = $stu->getGrade();
        $major = $stu->getMajor();
        self::initialConnection();
        try {
            $query = "CALL sp_updateStudent(?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = self::$database->stmt_init();
            if ($stm->prepare($query)) {
                $stm->bind_param("sidiisis", $studentName
                        , $class->getClassID()
                        , $mark
                        , $credit_completed
                        , $credit_miss
                        , $grade
                        , $major
                        , $rollNumber);
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

    /**
     * Get all major
     * @return array
     */
    public static function getAllMajor() {
        $majorList = array();
        self::initialConnection();
        try {
            $result = mysqli_query(self::$database, "SELECT * FROM tblmajor") or die("Query FAIL: " . mysqli_errno());
            while ($row = mysqli_fetch_array($result)) {
                $major = new Major();
                $major->setMajorID($row['majorID']);
                $major->setMajorName($row['majorName']);
                array_push($majorList, $major);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        self::closeConnection();
        return $majorList;
    }

    public static function getMajorByID($id) {
        $major = NULL;
        self::initialConnection();
        try {
            $result = mysqli_query(self::$database, "SELECT * FROM tblmajor WHERE majorID=" . $id) or die("Query FAIL: " . mysqli_errno());
            while ($row = mysqli_fetch_array($result)) {
                $major = new Major();
                $major->setMajorID($row['majorID']);
                $major->setMajorName($row['majorName']);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        self::closeConnection();
        return $major;
    }

    /**
     * 
     * @param string $name
     * @return \Clazz
     */
    public static function getClassByName($name) {
        $class = NULL;
        self::initialConnection();
        try {
            $result = mysqli_query(self::$database, "SELECT * FROM tblclass WHERE className LIKE '%" . $name . "%'") or die("Query FAIL: " . mysqli_errno());
            while ($row = mysqli_fetch_array($result)) {
                $class = new Clazz();
                $class->setClassID($row['classID']);
                $class->setClassName($row['className']);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        self::closeConnection();
        return $class;
    }

}
?>

