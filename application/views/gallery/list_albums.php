<?php

echo '<div class="row">';
foreach ($albums as $album) {
	
echo'<div class="album_cover">'."\n".
		'<h5>' . $album['name'] . '</h5>' . "\n".
		'<div style="min-height: 150px;">' . "\n".
			'<a href="/gallery/'.$album['id'].'">' . "\n".
					'<br>' . "\n".
					'<img src="../img/gallery/small/small_'. $album['cover'] .'" width="100" height="100"><br><br>' . "\n".
				'</a>' . "\n".
			'</div>' . "\n".
			'<a onclick="edit_album_data('.$album['id'].');"><i class="icon icon-pencil pull-right"></i></a>' . "\n".
			'<a onclick="delete_album('.$album['id'].');"><i class="icon icon-trash pull-right"></i></a>' . "\n".
		'</div>' . "\n";
}
echo '</div>';
?>