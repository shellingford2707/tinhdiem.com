<?php

include_once  'Subject.php';
include_once 'Dll.php';

/**
 * Description of Student
 * lớp biểu diễn sinh viên
 * @author HKA
 */
class Student {

    /**
     * Student ID
     * @var string 
     */
    private $studentID;

    /**
     * Name of Student
     * @var string 
     */
    private $name;

    /**
     * Danh sách các điểm môn học
     * @var array
     */
    private $Subjects = array();

    function __construct($studentID, $name) {
        $this->studentID = $studentID;
        $this->name = $name;
    }

    public function getStudentID() {
        return $this->studentID;
    }

    public function getName() {
        return $this->name;
    }

    public function setStudentID($studentID) {
        $this->studentID = $studentID;
    }

    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Đang thử kiểu add này cho array
     * @param Subject $val
     *
     */
    public function add_Subject($val) {
            // cần xóa dòng dưới đê:
      //  $this->Subjects[] = new Subject($val->getId(), $val->getName(), $val->getNumTc());
        $this->Subjects[] = $val;
    }

    /**
     * lấy môn học theo mã môn
     * NULL nếu không thấy môn phù hợp
     * @param string $id
     * @return Subject| NULL 
     */
    public function get_Subject($id = "", $index = 0) {
        if($id == "")
        {
            return isset($this->Subjects[$index])? $this->Subjects[$index]: NULL;
        }
        foreach ($this->Subjects as $subject) {
            if ($subject->getId() == $id) {
                return $subject;
            }
        }
        return NULL;
    }

    /**
     * 
     * @param string $id
     * @param int $index
     */
    public function remove_Subject($id = "", $index = 0) {
        if ($id == "") {// remove theo index
            unset($this->Subjects[$index]);
        } else {// remove theo ma mon
            for ($index1 = 0; $index1 < count($this->get_CountAllSubj()); $index1++) {
                if($this->Subjects[$index1]->getId() == $id)
                {
                    unset($this->Subjects[$index1]);
                    break;
                }
            }
        }
    }

    /**
     * Đếm số môn đã học
     * @return int
     */
    public function get_CountAllSubj() {
        return count($this->Subjects);
    }

    /**
     * DDeems so mon dieu kien
     * @return int
     */
    public function get_CountConditionSubj() {
        $count = 0;
        foreach ($this->Subjects as $subject) {
            if ($subject->getIsMonDieuKien()) {
                $count ++;
            }
        }
        return $count;
    }

    /**
     * Đếm số lượng môn bình thường
     * @return int
     */
    public function get_CountNormalSubj() {
        return $this->get_CountAllSubj() - $this->get_CountConditionSubj();
    }
    
    /**
     * Lấy ra array danh sách các môn theo điểm chữ: gồm các giá trị:
     * A, B+, B, C+, C, D+, D, F+, F
     * @param string $str : Điểm chữ
     * @param bool $isDieuKien : Có phải môn điều kiện hay không
     * @return Array
     */
    public function get_SubjectsForStringPoint($str, $isDieuKien = FALSE)
    {
        $str = strtoupper($str);
        $reAr = array();
        for ($index = 0; $index < count($this->Subjects); $index++) {
            if( ($this->Subjects[$index]->getIsMonDieuKien() == $isDieuKien) && $this->Subjects[$index]->get_CurrentPoint()->get_DiemChu() == $str)
            {
                $reAr[] = $this->Subjects[$index];
            }
        }    
        return $reAr;
    } 
    
    /**
     * Lấy ra danh sách các môn chưa qua
     * @return array
     */
    public function  get_Subjects_ChuaQua()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->isQua() == FALSE)
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }
    
    /**
     * Lấy ra danh sách các môn điều kiện
     * @return array
     */
    public function  get_Subjects_DieuKien()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->getIsMonDieuKien())
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }
    /**
     * Lấy ra danh sách các môn không phải môn điều kiện
     * @return array
     */
    public function get_Subjects_Normal()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if(!$value->getIsMonDieuKien())
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }

    /**
     * Lấy ra danh sách các môn đã học lại
     * @return array
     */
    public function  get_Subjects_DaHocLai()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->get_SoLanDaHocLai() > 0)
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }
    /**
     * Lấy ra danh sách các môn đã thi lại
     * @return array
     */
    public function get_Subjects_DaThiLai()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->get_SoLanThiLai() > 0)
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }
    
    /**
     * Lấy ra các môn đã học nâng điểm
     * @return array
     */
    public function get_Subjects_DaNangDiem()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->get_SoLanHocNangDiem() > 0)
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }
    
    /**
     * Lấy ra các môn có thể học nâng điểm
     * @return array
     */
    public function get_Subjects_CoTheNangDiem()
    {
        $reAr = array();
        foreach ($this->Subjects as $value) {
            if($value->get_CanNangDiem() == TRUE)
            {
                $reAr[] = $value;
            }
        }
        return $reAr;
    }

    /**
     * 
     * @return int
     */
    public function get_SoLanHocLai()
    {
        $count  = 0;
        foreach ($this->get_Subjects_DaHocLai() as $value) {
           $count += $value->get_SoLanDaHocLai();
        }
        return $count;
    }
    
    /**
     * 
     * @return int
     */
    public function get_SoLanThiLai()
    {
        $count  = 0;
        foreach ($this->get_Subjects_DaThiLai() as $value) {
           $count += $value->get_SoLanThiLai();
        }
        return $count;
    }
    
    /**
     * Lấy  ra tổng tín của array các Subject
     * @param array $arrayIn
     * @return int
     */
    public static function CountNumTinChi($arrayIn)
    {
        $total = 0;
        foreach ($arrayIn as $subject) {
            if(isset($subject))
            {
               $total += $subject->getNumTc();
            }
        }
        return $total;
    }
    
    /**
     * lấy ra tổng tín chỉ của các môn điều kiện hoặc môn bình thường
     * @param bool $dieuKien
     * @return int
     */
    public function get_TotalTinChi($dieuKien = FALSE)
    {
       if($dieuKien)
       {
           return Student::CountNumTinChi($this->get_Subjects_DieuKien());
       }
       else {
           return Student::CountNumTinChi($this->get_Subjects_Normal());
       }
    }       

    /**
     * Tính trung bình chung tích lũy thang 4     * 
     * @param bool $dk = TRUE (tính các môn đã qua), = FALSE (tính cả các môn chưa qua)
     * @return double
     */
    public function get_TrungBinhChungTichLuy($dk = TRUE)
    {
        $tong = 0.0;  $tongTc = 0;
        
        $tcA = Student::CountNumTinChi($this->get_SubjectsForStringPoint("A"));
        $tong +=  $tcA * 4;
        $tongTc += $tcA;
        
        $tcBp = Student::CountNumTinChi($this->get_SubjectsForStringPoint("B+"));
        $tong +=  $tcBp * 3.5;
        $tongTc += $tcBp;
        
        $tcB = Student::CountNumTinChi($this->get_SubjectsForStringPoint("B"));
        $tong +=  $tcB * 3;
        $tongTc += $tcB;
        
        $tcCp = Student::CountNumTinChi($this->get_SubjectsForStringPoint("C+"));
        $tong +=  $tcCp * 2.5;
        $tongTc += $tcCp;
        
        $tcC = Student::CountNumTinChi($this->get_SubjectsForStringPoint("C"));
        $tong +=  $tcC * 2;
        $tongTc += $tcC;
        
        $tcDp = Student::CountNumTinChi($this->get_SubjectsForStringPoint("D+"));
        $tong +=  $tcDp * 1.5;
        $tongTc += $tcDp;
        
        $tcD = Student::CountNumTinChi($this->get_SubjectsForStringPoint("D"));
        $tong +=  $tcD * 1;
        $tongTc += $tcD;        
        if ($dk) {                   
        } else {
            $tcFp = Student::CountNumTinChi($this->get_SubjectsForStringPoint("F+"));
            $tong +=  $tcFp * 0.5;
            $tongTc += $tcFp + Student::CountNumTinChi($this->get_SubjectsForStringPoint("F"));             
        }
         if($tongTc <= 0)          
                return 0.0;   
        $avg = $tong / $tongTc;
            return round($avg, 2);
    }
    /**
     * Nhập điểm cho môn học trên 1 lần
     * @param Subject $sub
     * @param string $strDiem
     * @return type
     */
    public static function NhapDiemFromString(&$sub, $strDiem)
    {
        if(!isset($sub))
            return;                
        $dataOfDiem =  explode("#", $strDiem);
        if(count($dataOfDiem)  < 4)  
            return;
        $soLanHoc = intval(count($dataOfDiem)/4) ;
        for ($i = 0; $i < $soLanHoc; $i++) {               
            $diemTp = doubleval($dataOfDiem[$i + 0]);   
           // $diemTp = floatval($dataOfDiem[$i+0]);
            $strDiemThi = explode("|",$dataOfDiem[$i + $soLanHoc]);
            $diemThiDi = doubleval($strDiemThi[0]);
            $diemThiLai = isset($strDiemThi[1])? doubleval($strDiemThi[1]): 0.0 ; 
            $p = new Point();
            $p->set_ThiDi($diemTp, $diemThiDi);
            $p->set_ThiLai($diemThiLai);
            $sub->add_Point($p);
        }
    }
    
    /**
     * Đọc dữ liệu điểm các môn và thông tin sinh viên
     * @param string $StringInput
     * @return Student
     */
    public static function ClipboardReader($StringInput)
    {
        $outStudent = new Student("","");
        $strDiem = "";        
        $strMaHp = "";
        $soTc = 0;
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $StringInput) as $strLine){
         //   $strLine = str_replace("\t", "#", $strLine);
           // $strLine = str_replace("|", ";", $strLine);
            $data = explode("\t", $strLine);
            $isNewHp = TRUE;
            $dtLen = count($data);
            if($dtLen != 5 && $dtLen != 8)
            {
                $isNewHp = FALSE;
            }
            elseif (intval($data[0]) <= 0) {// kiem tra so tt
                $isNewHp = FALSE;
            }elseif ( ($soTc = intval($data[3])) <= 0) {
                $isNewHp = FALSE;
            }
            if($isNewHp)
            {
                if($strDiem != "" && $strMaHp != "")
                {
                    $subj = $outStudent->get_Subject($strMaHp);
                    if(!is_null($subj))
                    {
                        Student::NhapDiemFromString($subj, $strDiem);
                        $strDiem = "";
                    }
                }
                $subjNormal = new Subject($data[1], $data[2], $soTc);
                $outStudent->add_Subject($subjNormal);
                if($dtLen == 8)
                {
                    $point = new Point();
                    $strDiemThi = explode("|", $data[5]);
                    $point->set_ThiDi(doubleval($data[4]), doubleval($strDiemThi[0]));
                    $diemThiLai = isset($strDiemThi[1]) ? doubleval($strDiemThi[1]): 0.0 ;
                    $point->set_ThiLai($diemThiLai);
                    $subjNormal->add_Point($point);
                    $strMaHp = "";
                }
                else
                {
                    $strMaHp = $data[1];
                    $strDiem = strval($data[4]);
                }
            }
            $subject = $outStudent->get_Subject($strMaHp);
            if(!is_null($subject))
            {
                if($strDiem != "" && is_int(strpos($strLine, "Đường dây nóng")))
                {
                    Student::NhapDiemFromString($subject, $strDiem);
                    $strDiem = "";
                    break;
                }
                if($dtLen == 2 || $dtLen == 1)
                {
                    $strLine = str_replace("\t", "#", $strLine);
                    if($strDiem != "" && !Lib::endsWith($strDiem, "#"))
                    {
                        $strDiem .= "#". $strLine;
                    }else
                    {
                        $strDiem .=  $strLine;
                    }
                }
            }            
        }
        if($strDiem !="" && $strMaHp != "")
        {
            $_subject = $outStudent->get_Subject($strMaHp);
            Student::NhapDiemFromString($_subject, $strDiem);
        }
        return $outStudent;
    }   
    /**
     * 
     * @return array
     */
    public function getAllSubjecs()
    {
        return $this->Subjects;
    }
}