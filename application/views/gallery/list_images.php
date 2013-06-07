<?php 
$html = '';
foreach ($images as $image) {
	$html .= '<div class="image_block">'."\n".
				'<div style="min-height: 150px;">'."\n".
				$image['name'] . '<br>'."\n".
				'<img src="/img/gallery/small/' . $image['preview'] . '" width="100"><br><br>'."\n".
				'</div>'."\n".
				'<a onclick="edit_image_data(' . $image['id'] . ');"><i class="icon icon-pencil pull-right"></i></a>'."\n".
				'<a onclick="delete_image(' . $image['id'] . ');"><i class="icon icon-trash pull-right"></i></a>'."\n".
				'</div>';
}

$html .= '<div style="clear:both"><center>' ."\n" .
		 '<div class="pagination">' ."\n" .
		 '<ul>' ."\n" .
		 '<li><a onClick="changePage(' . ($page-1) . ');return false;" id="prew">' ."\n" .
         '<-' ."\n" .
		 '</a></li>';
for($i=1; $i<=$pages; $i++){
    
    if ($i == $page) {
    	$html .= '<li class="active">';
    } else {
    	$html .= '<li>';
    }
    
    	$html .= '<a onClick="changePage(' . $i . '); return false;" id="page_'. $i .'">'. $i .'</a>';
		$html .= '</li>';
}

$html .= '<li><a onClick="changePage('. ($page+1) .'); return false;"  id="next">' . "\n" .
        	'->' . "\n" .
			'</a></li>' . "\n" .
			'</ul>' . "\n" .
			'</div>' . "\n" .
			'</center>';


echo $html;
?>