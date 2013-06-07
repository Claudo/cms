<?php 

class Albums extends Eloquent {

	public static $table = 'albums';

	//----------------------------------------------------------------------------------------------------------------------
	// Получить все альбомы ввиде массива
	//----------------------------------------------------------------------------------------------------------------------
	public static function getAlbums() {
		$albums_arr = array();
		$albums = Albums::all();
		foreach ($albums as $album) {
			$albums_arr[] = $album->to_array();
		}

		return $albums_arr;
	}

	//----------------------------------------------------------------------------------------------------------------------
	// Получить данные альбома по Id
	//----------------------------------------------------------------------------------------------------------------------
	public static function getAlbumById($idAlbum) {
		$elements = array();
        $album = Albums::where('id', '=', $idAlbum)->get();
        foreach ($album as $element) {
            $elements[] = $element->to_array(); 
        }
        return $elements;
	}

}

?>
