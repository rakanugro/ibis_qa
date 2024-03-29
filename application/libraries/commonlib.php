<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Commonlib {

	// Returns in MB
	public function file_upload_max_size_mb(){
		return round($this->file_upload_max_size() / (1024*1024), 2, PHP_ROUND_HALF_DOWN ) . " MB";
	}

    // Returns a file size limit in bytes based on the PHP upload_max_filesize
	// and post_max_size
	public function file_upload_max_size() {
	  static $max_size = -1;

	  if ($max_size < 0) {
	    // Start with post_max_size.
	    $max_size = $this->parse_size(ini_get('post_max_size'));

	    // If upload_max_size is less, then reduce. Except if upload_max_size is
	    // zero, which indicates no limit.
	    $upload_max = $this->parse_size(ini_get('upload_max_filesize'));
	    if ($upload_max > 0 && $upload_max < $max_size) {
	      $max_size = $upload_max;
	    }
	  }
	  return $max_size;
	}

	function parse_size($size) {
	  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
	  $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
	  if ($unit) {
	    // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
	    return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
	  }
	  else {
	    return round($size);
	  }
	}
}

/* End of file Commonlib.php */