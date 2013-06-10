<?php
class Images extends Eloquent {

	public static $table = 'images';
	static $onPage = 4; //A может сделать тебя константой??

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

    //----------------------------------------------------------------------------------------------------------------------
    // Получить данные изображения по Id
    //----------------------------------------------------------------------------------------------------------------------
    public static function getImageById($idImage) {
        $elements = array();
        $image = Images::where('id', '=', $idImage)->get();
        foreach ($image as $element) {
            $elements[] = $element->to_array(); 
        }
        return $elements;
    }

	//----------------------------------------------------------------------------------------------------------------------
    // Количество изображений в альбоме 
    //----------------------------------------------------------------------------------------------------------------------
    public static function getPagesCount($idAlbum) {
        $total=Images::where('id_album', '=', $idAlbum)->count();
        $pages=ceil($total/self::$onPage);

        return $pages;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Смещение изображений для данной страницы
    //----------------------------------------------------------------------------------------------------------------------
    public static function getOffset($idAlbum, $pageNo=1) {
        $pages = self::getPagesCount($idAlbum);
        
        if ($pages == 0) $pages=1; //временный фикс, нужен нормальный вывод ошибки на пустую категорию.

        $page=max(intval($pageNo),1);
        $page=min($page,$pages);
        $offset = ($page - 1)*self::$onPage;
    
        return $offset; 
    }


    //----------------------------------------------------------------------------------------------------------------------
    //  Получить статьи для заданной страницы в виде массива 
    //----------------------------------------------------------------------------------------------------------------------
    public static function getArticlesPage($idAlbum, $offset) {

        $imagesArray = array();      
        $images = Images::where('id_album', '=', $idAlbum)->skip($offset)->take(self::$onPage)->get();
        foreach ($images as $image) {
            $imagesArray[] = $image->to_array();
        }

        return $imagesArray;
    }

}


?>