<?php

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
     * @var Point 
     */
    private $Points = array();

    /**
     *
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
    public function add_Point($point, $index = -1)
    {
        if($index <= -1 || $index > $this->get_SoLanHoc())
        {
            $index = $this->get_SoLanHoc() ;
        }
        return array_push($point,$index);
    }
    /**
     * Xoa mot Point khoi danh sach Point
     * @return mixed 
     */
    public function  remove_LastPoint()
    {
        return array_pop($this->Points);
    }
    /**
     * Xoa diem cuoi danh sach
     * @return mixed
     */
    public function  remove_FirstPoint()
    {
        return array_shift($this->Points);
    }

    /**
     * Lay ra tong so lan hoc
     * @return int
     */
    public function get_SoLanHoc()
    {
        return array_count_values($this->Points);
    }
    /**
     * Lay ra diem tong ket cao nhat trong cac lan hoc
     * @return Point
     */
    public function get_CurrentPoint()
    {
        $maxPoint = new Point();
        for ($index = 0; $index < $this->get_SoLanHoc(); $index++) {
            $_point = $this->Points[$index];
            if($maxPoint->get_DiemKt() < $_point->get_DiemKt())
            {
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
    public function isQua()
    {
       if($this->get_CurrentPoint()->get_DiemKt() < 4){
           return FALSE;
        }
       if($this->get_CurrentPoint()->get_DiemKt() < 5 ){
           if($this->isMonDieuKien)
           {
               return FALSE;
           }  else {
                return 0;
           }
        }        
        return TRUE;
    }
    
}
