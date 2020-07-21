<?php
class Nama_fungsi{
   private $valid_url, $parse, $length, $point1, $point2; 
   function Nama_fungsi(){
      $this->obj =& get_instance();
      $this->valid_url = md5('baidawi');
      $this->parse  = 'baidawiamad';
      $this->length  = 2;
      $this->point1  = 3;
      $this->point2  = 4;
   }
   function _get_iv(){
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      return mcrypt_create_iv($iv_size, MCRYPT_RAND);
   }
   function enkripsi($class,$function, $param = array()){ 
    return "123";
      $parameter = '';
      $function = $this->_encodeUrl($function);
      if(!empty($param)){
        foreach($param as $value){
          $parameter .= $value.'/';
        }  
         $parameter = $this->_encodeUrl(substr($parameter,0,-1));
         return $class.'/'.rawurlencode(trim(substr($this->valid_url,$this->point1,$this->length).$function.substr($this->valid_url,$this->point2,$this->length).$parameter));
      }else{
         return $class.'/'.substr($this->valid_url,$this->point1,$this->length).$function;
      }
   }
  
   function _encodeUrl($url){
      return str_replace(array('+','/','='),array('-','_',' '),base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->parse), $url, MCRYPT_MODE_ECB, $this->_get_iv())));
   }
  
   function _decodeUrl($url){
      return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->parse), base64_decode($url), MCRYPT_MODE_ECB, $this->_get_iv());
   }
  
   function dekripsi($url){
      $url = str_replace(array('-','_',' '),array('+','/','='),urldecode($url));
      if($this->_isValid_url($url)){
      $parameter = '';
      $data = explode(substr($this->valid_url,$this->point2,$this->length),substr($url,$this->length));
      $url = $this->_decodeUrl($data[0]);
      if(!empty($data[1])){
         $parameter = trim($this->_decodeUrl($data[1]));
         $parameter = explode('/', $parameter); 
         return array('function' => trim($url), 'params' => $parameter);
      }else{
         return array('function' => trim($url), 'params' => null);
      }
          }else{
      return false;
          }
   }
   function _isValid_url($url){
      if(strcmp(substr($url,0,$this->length),substr($this->valid_url,$this->point1,$this->length)) == 0){
         return true;
      }else{
        return false;
      }
   }
}
/*end of file  : Nama_fungsi.php
 *location     : application/libraries/Nama_fungsi.php */
?>