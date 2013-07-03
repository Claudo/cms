<?php
class Gallery_Controller extends Base_Controller {
    
    public  function action_index() {
        if(!Auth::user())
            return Redirect::to('login');
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
        if(!Auth::user())
            return Redirect::to('login');
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
        if(!Auth::user())
            return Redirect::to('login');
        $images = new Images;

        //получаем информацию о файле, даём уникальное имя
        // и отправляем его в папку gallery
        $file = Input::file('inputFile');
        $fileName = time() . rand(0,1000) . '_' . $file['name'];
        Input::upload('inputFile', path('public').'img/gallery', $fileName);
        //создаём уменьшенную копию изображения для превью
        $images::createPreview($fileName);

        //записываем полученные данные в базу
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
        
        
        return Redirect::to('gallery/'.Input::get('inputAlbumId'));
        
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Получить изображения ввиде массива
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getImages($idAlbum) {
        if(!Auth::user())
            return Redirect::to('login');

        // Получаем список всех альбомов, конкретный альбом и 
        // количество страниц в нем
        $albums = Albums::getAlbums();
        $pages=Images::getPagesCount($idAlbum);
        $albumArr = Albums::getAlbumById($idAlbum);

        $breadcrumbsArr = array(
                             array('name' => 'галерея', 'url' => '/gallery/'),
                             array('name' => $albumArr[0]['name'], 'url' => '')
                            );
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));

        // Если запрос был сделан AJAX'ом возвращаем только изображения
        // Если нет, то страницу целиком
        if (!Request::ajax()){
            // кол-во строк таблицы которые нужно пропустить
            $offset=Images::getOffset($idAlbum);
            // изображения для вывода на страницу
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
            $page = Input::get('page'); // Контроль и поправка номера текущей страницы
            $page=max(intval($page),1); // недолжен быть меньше единицы
            $page=min($page,$pages);    // и недолжен быть больше максимального кол-ва страниц

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
        if(!Auth::user())
            return Redirect::to('login');
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
        if(!Auth::user())
            return Redirect::to('login');
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
        if(!Auth::user())
            return Redirect::to('login');
        
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
        if(!Auth::user())
            return Redirect::to('login');

        $image = Images::find(Input::get('idImage'));

        $image->name = Input::get('inputName'); 
        $image->title = Input::get('inputTitle');
        $image->description = Input::get('inputDescription');
        $image->header = Input::get('inputHeader');
        $image->content = Input::get('inputContent');
        $image->id_album = Input::get('idAlbum');

        // Если включен чекбокс "обложка альюома"
        // полю "cover" присваевается имя редактируемого изображения
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
        if(!Auth::user())
            return Redirect::to('login');

        $idAlbum = Input::get('idAlbum');
        if(empty($idAlbum)) return false;

        Albums::find($idAlbum)->delete();
        $images = Images::where('id_album', '=', $idAlbum)->get();
        if(!$images) {
            foreach ($images as $image) {       //Перебераем все
                $this->delImageFile($image);    //изображения
            }                                   //и удаляем
        }
            return true;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Удаление изображения
    //----------------------------------------------------------------------------------------------------------------------
    public function action_delImage() {
        if(!Auth::user())
            return Redirect::to('login');

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
        if(!Auth::user())
            return Redirect::to('login');

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
}