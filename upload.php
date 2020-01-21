<?php
function Upload($file,$namefile){

	if(@copy($file['tmp_name'],$path.$namefile)){
		@chmod($path.$file,0777);
		return $namefile;
	}else{
		return false;
	}
}
?>