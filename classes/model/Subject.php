<?php

include_once 'Point.php';

/**
 * Description of Subject
 * lớp biểu thị một môn học
 * @author HKA
 */
class Subject {

    /**
     * Subject id
     * @var string 
     */
    private $id;

    /**
     * Name of subject
     * @var string
     */
    private $name;

    /**
     *
     * @var array 
     */
    private $Points = array();

    /**
     * So Tin chi
     * @var int 
     */
    private $numTc;

    /**
     *
     * @var bool 
     */
    private $isMonDieuKien;

    /**
     * 
     * @param string $id
     * @param string $name
     * @param int $numTc
     */
    function __construct($id, $name, $numTc) {
        $this->id = strtoupper($id);
        //xu ly mon dieu kien
        $this->name = $name;
        if (strpos($id, "GQP") || strpos($id, "GDT")) {
            $this->isMonDieuKien = TRUE;
        } else {
            $this->isMonDieuKien = FALSE;
        }
        if ($numTc < 0 || $numTc > 10) { // lon hon bao nhieu thi chua ro 
            $numTc = 0;
        }
        $this->numTc = $numTc;
    }

    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return array
     */
    public function getPoints() {
        return $this->Points;
    }

    /**
     * 
     * @return int
     */
    public function getNumTc() {
        return $this->numTc;
    }

    /**
     * 
     * @return bool
     */
    public function getIsMonDieuKien() {
        return $this->isMonDieuKien;
    }

    /**
     * 
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
        if (strpos($id, "GQP") || strpos($id, "GDT")) {
            $this->isMonDieuKien = TRUE;
        } else {
            $this->isMonDieuKien = FALSE;
        }
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 
     * @param string $numTc
     */
    public function setNumTc($numTc) {
        $this->numTc = $numTc;
    }

    /**
     * them 1 diem sau mot lan hoc vao ds
     * @param Point $point : gia tri diem can chen
     * @param int $index :[tuy chon] chi so can chen
     * @return int new number elem in array
     */
    public function add_Point($point, $index = -1) {
        if ($index <= -1 || $index > $this->get_SoLanHoc()) {
            $index = $this->get_SoLanHoc();
        }
        return $this->Points[] = $point;
    }

    /**
     * remove a point with index
     * @param int $index
     */
    public function remove_Point($index = -1) {
        if ($index < 0 || $index >= $this->get_SoLanHoc()) {
            $index = $this->get_SoLanHoc() - 1;
        }
        unset($this->Points[$index]);
    }

    /**
     * Lay ra tong so lan hoc
     * @return int
     */
    public function get_SoLanHoc() {
        return count($this->Points);
    }

    /**
     * Lay ra diem tong ket cao nhat trong cac lan hoc
     * @return Point
     */
    public function get_CurrentPoint() {
        $maxPoint = new Point();
        for ($index = 0; $index < $this->get_SoLanHoc(); $index++) {
            $_point = $this->Points[$index];
            if ($maxPoint->get_DiemKt() < $_point->get_DiemKt()) {
                $maxPoint = $_point;
            }
        }
        return $maxPoint;
    }

    /**
     * Kiem tra mon hoc da qua hay chua
     * Neu co the hoc nang diem thi tra ve gia tri 0
     * Tra ve TRUE neu mon do da qua va khong phai nang diem
     * Tra ve FALSE neu phai hoc lai
     * @return int|boolean
     */
    public function isQua() {
        if ($this->get_CurrentPoint()->get_DiemKt() < 4) {
            return FALSE;
        }
        if ($this->get_CurrentPoint()->get_DiemKt() < 5) {
            if ($this->isMonDieuKien) {
                return FALSE;
            } else {
                return 0;
            }
        }
        return TRUE;
    }

    /**
     * 
     * @return int
     */
    public function get_SoLanThiLai() {
        $count = 0;
        foreach ($this->Points as $value) {
            if ($value->get_diemThi2() > 0) {
                $count ++;
            }
        }
        return $count;
    }

    /**
     * Đếm số lần đã học lại
     * @return int
     */
    public function get_SoLanDaHocLai() {
        $count = 0;
        foreach ($this->Points as $value) {
            if ($this->isMonDieuKien) {
                return count($this->Points) - 1;
            } else {
                if ($value->get_DiemKt() < 4)
                    $count++;
            }
        }
        if ($this->Points[$this->get_SoLanHoc() - 1]->get_DiemKt() < 4) {
            $count--;
        }
        return $count;
    }

    /**
     * đếm số lần học nâng điểm
     * @return int
     */
    public function get_SoLanHocNangDiem() {
        $count = 0;
        $len = count($this->Points);
        if ($len < 2)
            return 0;
        for ($i = 1; i < $len; $i++) {
            $pre = $this->Points[i - 1];
            if ($pre->get_DiemKt() < 5 && $pre->get_DiemKt() > 4) {
                $count++;
            }
            $value = $this->Points[i];
            if ($value->get_DiemKt() > 5)
                break;
        }
        return $count;
    }

    public function get_CanNangDiem() {
        if ($this->get_CurrentPoint()->get_DiemChu() == "D" && $this->getIsMonDieuKien() == FALSE) {
            return true;
        } else {
            return false;
        }
    }
    public function __toString() {
        return
        $this->getId().'; '.$this->getName().'; '.$this->getNumTc().'; '.$this->get_CurrentPoint();
    }
}
