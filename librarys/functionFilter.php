<?php 

function filterString($data){
	return htmlspecialchars(strip_tags($data, ENT_QUOTES));
}

 ?>