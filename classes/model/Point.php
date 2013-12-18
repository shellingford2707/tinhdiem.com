<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Point
 *Quản lý điểm cho 1 lần học
 * @author vinh2888
 */
class Point {
    //put your code here
    /**
     * điểm thành phần
     * @var duoble
     */
    private  $_diemTp;
    /**
     * Điểm thi đi
     * @var double
     */
    private  $_diemThi1;
    /**
     * Điểm thi lại
     * @var double
     */
    private  $_diemThi2;
    /**
     * Điểm kt học phần thi đi
     * @var double
     */
    private  $_diemKt1;
    /**
     * Điểm kết thúc học phần sau thi lại     
     * @var double
     */
    private  $_diemKt2;
    
    function __construct() {
        $this->_diemTp = 0.0;
        $this->_diemThi1 = 0.0;
        $this->_diemThi2 = 0.0;
        $this->_diemKt1 = 0.0;
        $this->_diemKt2 = 0.0;
    }
   /**
    * 
    * @param double $_diemTp
    * @param double $_diemThi1
    */
    public function set_ThiDi($_diemTp, $_diemThi1)
    {        
        if(is_numeric($_diemThi1) && is_numeric($_diemTp))
        {
            if ($_diemTp < 0 || $_diemTp > 10) {
                $_diemTp = 0;
            }
            if($_diemThi1 < 0 || $_diemThi1 > 10) {
                $_diemThi1 = 0;
            }
            $this->_diemTp = $_diemTp;
            $this->_diemThi1 = $_diemThi1;
            $this->_diemKt1 = round(($_diemTp*3 + $_diemThi1)/10, 1);
        }
    }
    /**
     * 
     * @param double $_diemThi2
     */
    public function set_ThiLai($_diemThi2)
    {        
        if(is_numeric($_diemThi2))
        {           
            if($_diemThi2 < 0 || $_diemThi2 > 10) {
                $_diemThi2 = 0;
            }           
            $this->_diemThi2 = $_diemThi2;
            $this->_diemKt2 = round(($this->_diemTp*3 + $_diemThi2*7)/10, 1);
        }
    }
    /**
     * 
     * @param double $value
     * @return string
     */
    public static function convert_ToDiemChu($value)
    {
        if(is_numeric($value))
        {
            if ($value < 3) return "F";
            if ($value < 4) return "F+";
            if ($value < 5) return "D";
            if ($value < 5.5) return "D+";
            if ($value < 6.5) return "C";
            if ($value < 7) return "C+";
            if ($value < 8) return "B";
            if ($value < 8.5) return "B+";
            return "A";
        }
    }
    /**
     * 
     * @param string $value
     * @return real|int
     */
    public static function  convert_ToH4($value)
    {
            if(!is_string($value)) return 0;
            $value = strtoupper($value);
            if ($value.Equals("A")) return 4;
            if ($value.Equals("B+")) return 3.5;
            if ($value.Equals("B")) return 3;
            if ($value.Equals("C+")) return 2.5;
            if ($value.Equals("C")) return 2;
            if ($value.Equals("D+")) return 1.5;
            if ($value.Equals("D")) return 1;
            if ($value.Equals("F+")) return 0.5;
            else return 0;
    }
   /**
    * 
    * @return string
    */
    public function get_DiemChu1()
    {
        return Point::convert_ToDiemChu($this->_diemKt1);
    }
    public function get_DiemChu2()
    {
        return Point::convert_ToDiemChu($this->_diemKt2);
    }
    public function get_DiemChu()
    {
        return Point::convert_ToDiemChu($this->get_DiemKt());
    }
    public function get_diemTp() {
        return $this->_diemTp;
    }

    public function get_diemThi1() {
        return $this->_diemThi1;
    }

    public function get_diemThi2() {
        return $this->_diemThi2;
    }

    public function get_diemKt1() {
        return $this->_diemKt1;
    }

    public function get_diemKt2() {
        return $this->_diemKt2;
    }    
    public function  get_DiemKt()
    {
        if($this->_diemKt1 < $this->_diemKt2)
        {
            return $this->_diemKt2;
        }  else {
            return $this->_diemKt1;
        }
    }
    public function  get_DienH4()
    {
        return Point::convert_ToH4($this->get_DiemChu());
    }
        
    
    

}
