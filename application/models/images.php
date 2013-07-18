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
    // Получить id последнего элемента
    //----------------------------------------------------------------------------------------------------------------------
    public static function geLastElementId(){
        $lastImage = Images::order_by('id', 'desc')->first();
        return $lastImage->id;
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
    //  Получить изображения для заданной страницы в виде массива 
    //----------------------------------------------------------------------------------------------------------------------
    public static function getArticlesPage($idAlbum, $offset) {

        $imagesArray = array();      
        $images = Images::where('id_album', '=', $idAlbum)->skip($offset)->take(self::$onPage)->get();
        foreach ($images as $image) {
            $imagesArray[] = $image->to_array();
        }

        return $imagesArray;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Создать привью 
    //----------------------------------------------------------------------------------------------------------------------
    public static function createPreview($filename, $w=100, $h=100, $is_gallery = true) {
        $smallimage = $filename;
        if($is_gallery) {
            $filename = path('public').'img/gallery/' . $filename;
            $smallimage = path('public').'img/gallery/small/small_' . $smallimage;
        } else {
            $smallimage = $filename;
        }
        $ratio = $w / $h;
        $sizeImg = getimagesize($filename);
        if (($sizeImg[0] < $w) && ($sizeImg[1] < $h))
            return true;
        $srcRatio = $sizeImg[0] / $sizeImg[1];

        // Здесь вычисляем размеры уменьшенной копии, чтобы при масштабировании сохранились
        // пропорции исходного изображения
        if ($ratio < $srcRatio) {
            $h = $w / $srcRatio;
        } else {
            $w = $h * $srcRatio;
        }
        // создадим пустое изображение по заданным размерам
        $destImg = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($destImg, 255, 255, 255);
        if ($sizeImg[2] == 2)
            $srcImg = imagecreatefromjpeg($filename);
        else if ($sizeImg[2] == 1)
            $srcImg = imagecreatefromgif($filename);
        else if ($sizeImg[2] == 3)
            $srcImg = imagecreatefrompng($filename);

        // масштабируем изображение     функцией imagecopyresampled()
        // $destImg - уменьшенная копия
        // $srcImg - исходной изображение
        // $w - ширина уменьшенной копии
        // $h - высота уменьшенной копии
        // $sizeImg[0] - ширина исходного изображения
        // $sizeImg[1] - высота исходного изображения
        imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0, $w, $h, $sizeImg[0], $sizeImg[1]);
        // сохраняем уменьшенную копию в файл
        if ($sizeImg[2] == 2)
            imagejpeg($destImg, $smallimage);
        else if ($sizeImg[2] == 1)
            imagegif($destImg, $smallimage);
        else if ($sizeImg[2] == 3)
            imagepng($destImg, $smallimage);
        // чистим память от созданных изображений
        imagedestroy($destImg);
        imagedestroy($srcImg);
        return basename($smallimage);
    }


}


?>