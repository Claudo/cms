<?php
class Images extends Eloquent {

	public static $table = 'images';

	//----------------------------------------------------------------------------------------------------------------------
	// Получить все изображения в альбоме
	//----------------------------------------------------------------------------------------------------------------------
	public static function getAllImages($idAlbum) {
		$images_arr = array();
		$images = Images::where('id_album', '=', $idAlbum)->get();
		foreach ($images as $image) {
			$images_arr[] = $image->to_array();
		}

		return $images_arr;
	}

}


?>