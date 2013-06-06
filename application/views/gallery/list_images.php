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

echo $html;
?>