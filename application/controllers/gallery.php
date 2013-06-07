<?php
class Gallery_Controller extends Base_Controller {
    
    public  function action_index() {
    	$albums = Albums::getAlbums();
        $breadcrumbsArr[] = array ('name' => 'галерея', 'url' => '');
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr)); 
        if (Request::ajax()){
            $view = View::make('gallery.list_albums')
                            ->with('albums', $albums);            
        } else {
            $view = View::make('gallery.home')
                            ->with('navActive', 'gallery')
                            ->with('albums', $albums)
                            ->with('breadcrumbs', $breadcrumbs);
        }

        return $view;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Добавление нового альбома
    //----------------------------------------------------------------------------------------------------------------------
    public function action_insertAlbum() {
    	$album = new Albums;
    	$album->name = Input::get('albumName'); 
    	$album->title = Input::get('title');
    	$album->description = Input::get('description'); 
    	$album->header = Input::get('header');
    	$album->content = Input::get('content');
    	$album->cover = 0;

    	$album->save();
    	return true;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Добавление нового изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function action_insertImage() {                         
        $images = new Images;

        //получаем информацию о файле, даём уникальное имя
        // и отправляем его в папку gallery
        $file = Input::file('inputFile');
        $fileName = time() . rand(0,1000) . '_' . $file['name'];
        Input::upload('inputFile', path('public').'img/gallery', $fileName);
        //создаём уменьшенную копию изображения для превью
        $this->create_preview($fileName);

        $images->name = Input::get('inputName');
        $images->title = Input::get('inputTitle');
        $images->description = Input::get('inputDescription');
        $images->header = Input::get('inputHeader');
        $images->content = Input::get('inputContent');
        $images->image = $fileName;
        $images->preview = 'small_'.$fileName;
        $images->id_album = Input::get('inputAlbumId');
      
        $images->save();

    	$albums = Albums::getAlbums();
        $breadcrumbsArr[] = array ('name' => 'галерея', 'url' => '');
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));
        $view = View::make('gallery.home')
                        ->with('navActive', 'gallery')
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('albums', $albums);

        return $view;

    }

/* возможно не пригодтся
    //----------------------------------------------------------------------------------------------------------------------
    // Получить альбомы в виде массива
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getAlbum($idAlbum) {
    	return true;    	
    }
*/

    //----------------------------------------------------------------------------------------------------------------------
    // Получить изображения ввиде массива
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getImages($idAlbum) {
        //$images = Images::getAllImages($idAlbum);
        $albums = Albums::getAlbums();
        $pages=Images::getPagesCount($idAlbum);
        $albumArr = Albums::getAlbumById($idAlbum);
        $breadcrumbsArr = array(
                             array('name' => 'галерея', 'url' => '/gallery/'),
                             array('name' => $albumArr[0]['name'], 'url' => '')
                            );
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));


        if (!Request::ajax()){
            $offset=Images::getOffset($idAlbum);
            $images=Images::getArticlesPage($idAlbum, $offset);
            $view = View::make('gallery.images')
                            ->with('navActive', 'gallery')
                            ->with('albums', $albums)
                            ->with('images', $images)
                            ->with('breadcrumbs', $breadcrumbs)
                            ->with('pages', $pages)
                            ->with('page', 1)
                            ->with('idAlbum', $idAlbum);
        } else {
            $page = Input::get('page');
            $page=max(intval($page),1);
            $page=min($page,$pages);

            $offset=Images::getOffset($idAlbum, $page);
            $images=Images::getArticlesPage($idAlbum, $offset);
            $view=View::make('gallery.list_images')
                            ->with('images', $images)
                            ->with('pages', $pages) 
                            ->with('page', $page)
                            ->with('idAlbum', $idAlbum);              
    	}
        return $view;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Вернуть данные для редактирования альбома 
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getAlbumsJson() {
        $idAlbum = Input::get('idAlbum');
        if(!empty($idAlbum)) {
            $album = Albums::find($idAlbum);
            $album = $album->to_array();
            
            return json_encode($album);
        }
        else return false;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Обновить данные альбома
    //----------------------------------------------------------------------------------------------------------------------
    public function action_updateAlbum() {
        $album = Albums::find(Input::get('idAlbum'));

        $album->name = Input::get('albumName'); 
        $album->title = Input::get('albumTitle');
        $album->description = Input::get('albumDescription'); 
        $album->header = Input::get('albumHeader');
        $album->content = Input::get('albumContent');

        $album->save();


    }

    //----------------------------------------------------------------------------------------------------------------------
    // Получить данные для редактирования изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getImagesJson() {
        
        $idImage = Input::get('idImage');

        if(!empty($idImage)) {
            $image = Images::find($idImage);
            $image = $image->to_array();

            return json_encode($image);
        }
        else return false;

    }

    //----------------------------------------------------------------------------------------------------------------------
    // Обновить данные изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function action_updateImage() {

        $image = Images::find(Input::get('idImage'));


        $image->name = Input::get('inputName'); 
        $image->title = Input::get('inputTitle');
        $image->description = Input::get('inputDescription');
        $image->header = Input::get('inputHeader');
        $image->content = Input::get('inputContent');
        $image->id_album = Input::get('idAlbum');

        $cover = Input::get('cover');
        if ($cover) {
            $album = Albums::find(Input::get('idAlbum'));
            $cover = Images::getImageById(Input::get('idImage'));
            $album->cover = $cover[0]['image'];
            $album->save();
        }

        $image->save();

    }

    //----------------------------------------------------------------------------------------------------------------------
    // Удаление альбома 
    //----------------------------------------------------------------------------------------------------------------------
    public function action_delAlbum() {
        $idAlbum = Input::get('idAlbum');
        if(empty($idAlbum)) return false;

        Albums::find($idAlbum)->delete();
        $images = Images::where('id_album', '=', $idAlbum)->get();
        if(!$images) {
            foreach ($images as $image) {
                $this->delImageFile($image);
            }
        }
            return true;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Удаление изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function action_delImage() {
        $idImage = Input::get('idImage');
        if(empty($idImage)) return false;

        $image = Images::find($idImage);
        $this->delImageFile($image);
        return true;         
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Вспомагательная функция для удаления альбома и изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function delImageFile($image) {
        $imageArr = $image->to_array();
        $imagePath = path('public').'img/gallery/'.$imageArr['image'];
        $previewPath = path('public').'img/gallery/small/'.$imageArr['preview'];

        unlink($imagePath);
        unlink($previewPath);

        $image->delete();

        return true;
    }

    //--------------------------------------------------------------------------------------------------
    // Создание превью 100*100
    //--------------------------------------------------------------------------------------------------
    private function create_preview($filename, $w=100, $h=100) { 
        $smallimage = $filename;       
        $filename = path('public').'img/gallery/' . $filename;        
        $smallimage = path('public').'img/gallery/small/small_' . $smallimage; 
        
        $ratio = $w / $h;        
        $size_img = getimagesize($filename);        
        if (($size_img[0] < $w) && ($size_img[1] < $h))
            return true;
        $src_ratio = $size_img[0] / $size_img[1];

        // Здесь вычисляем размеры уменьшенной копии, чтобы при масштабировании сохранились  
        // пропорции исходного изображения 
        if ($ratio < $src_ratio) {
            $h = $w / $src_ratio;
        } else {
            $w = $h * $src_ratio;
        }
        // создадим пустое изображение по заданным размерам  
        $dest_img = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($dest_img, 255, 255, 255);
        if ($size_img[2] == 2)
            $src_img = imagecreatefromjpeg($filename);
        else if ($size_img[2] == 1)
            $src_img = imagecreatefromgif($filename);
        else if ($size_img[2] == 3)
            $src_img = imagecreatefrompng($filename);

        // масштабируем изображение     функцией imagecopyresampled() 
        // $dest_img - уменьшенная копия 
        // $src_img - исходной изображение 
        // $w - ширина уменьшенной копии 
        // $h - высота уменьшенной копии         
        // $size_img[0] - ширина исходного изображения 
        // $size_img[1] - высота исходного изображения 
        imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $w, $h, $size_img[0], $size_img[1]);
        // сохраняем уменьшенную копию в файл  
        if ($size_img[2] == 2)
            imagejpeg($dest_img, $smallimage);
        else if ($size_img[2] == 1)
            imagegif($dest_img, $smallimage);
        else if ($size_img[2] == 3)
            imagepng($dest_img, $smallimage);
        // чистим память от созданных изображений 
        imagedestroy($dest_img);
        imagedestroy($src_img);
        return basename($smallimage);
    }

}