<?php

$html ='';
foreach ($albums as $album) {
	$html .= '<option value="'.$album['id'].'">'.$album['name'].'</option>'."\n";
}
echo $html;

?>