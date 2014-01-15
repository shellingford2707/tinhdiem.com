<?php

/* *
 * File chứa các hàm bổ trợ:
 */
/**
 * Kiểm tra 1 xâu con có kết thúc của 1 xâu cha không
 * @param string $haystack: XXâu nguồn
 * @param string $needle: Xâu con
 * @return boolean
 */
 function str_EndsWith($haystack, $needle) {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }
    /**
     * Kiiểm tra xâu con có bắt đầu của 1 xâu cha không
     * @param string $str
     * @param string $needle
     * @return boolean
     */
function  str_StartWith($str, $needle)
    {
        $dk = strpos($str, $needle);
        if(is_numeric($dk) && $dk == 0)
        {
            return TRUE;
        }  else {
            return FALSE;
        }
    }
 /**
  * Xau  cha có chứa xâu con không
  * @param string $haysctack
  * @param string $needle
  * @return boolean
  */
function str_Contain($haysctack, $needle)
{
    $dk = strpos($haysctack, $needle);
        if(is_numeric($dk))
        {
            return TRUE;
        }  else {
            return FALSE;
        }
}
