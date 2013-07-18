<?php
class Catalog_Controller extends Base_Controller {

    static $unit = 2; //индекс модуля "catalog" (db: units)

    public  function action_index() {
        $categories = $this->getCategories(); 
        $view = View::make('catalog.home')->with('navActive', 'catalog')
                                          ->with('categories', $categories);

        return $view;
    }

    //--------------------------------------------------------------------------------------------------
    // Получить список всех категорий
    //--------------------------------------------------------------------------------------------------
    public function getCategories()
    {
      if(!Auth::user())
            return Redirect::to('login');

      $categories = Categories::getAllCategories(self::$unit);
    	return $categories;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Построение дерева категорий
    //----------------------------------------------------------------------------------------------------------------------
    public  function action_buildCategoriesTree() {
        if(!Auth::user())
            return Redirect::to('login');

        $categories = Categories::getAllCategories(self::$unit);
        $view = View::make('catalog.tree')->with('categories', $categories);

        return $view;
    }

    //--------------------------------------------------------------------------------------------------
    // Получить данные о категории
    //--------------------------------------------------------------------------------------------------
   	public function action_getCategory($idCategory)
   	{
      if(!Auth::user())
            return Redirect::to('login');

      $category = Categories::getCategoryById($idCategory);
   		return $category;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Добавить категорию
   	//--------------------------------------------------------------------------------------------------
   	public function action_addCategory()
   	{
      if(!Auth::user())
            return Redirect::to('login');

      $categoryName = Input::get('categoryName'); //echo $categoryName; exit;
      $parentId     = Input::get('idParent');

      if(!empty($categoryName)) { 
          if(empty($parentId)) $parentId = 0;
          Categories::addCategory($categoryName, $parentId, self::$unit);
          return true;
      } else return false;   		
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Обновить категорию
   	//--------------------------------------------------------------------------------------------------
   	public function action_updateCategory($idCategory)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Удалить категорию
   	//--------------------------------------------------------------------------------------------------
   	public function action_removeCategory($idCategory)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   			return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Добавить продукт
   	//--------------------------------------------------------------------------------------------------
   	public function action_addProduct()
   	{
      if(!Auth::user())
            return Redirect::to('login');

      /* Test Vars 
      debug(Input::get('option'));
      debug(Input::get('productName'));
      debug(Input::get('productTitle'));
      debug(Input::get('productDescription'));
      debug(Input::get('productContent'));
      debug(Input::get('inputFile'));
      debug(Input::get('idProductCategory'));
      */

      // Добавляем новый продукт и получаем id записи
      // Попробывать метод ::create(array()). Поможет избавиться от geLastElementId().
      $newProduct = new catalogProducts;

      $newProduct->id_category  = Input::get('idProductCategory'); 
      $newProduct->name         = Input::get('productName');
      $newProduct->title        = Input::get('productTitle');
      $newProduct->description  = Input::get('productDescription');
      $newProduct->content      = Input::get('productContent');
      $newProduct->price        = Input::get('productPrice'); 
      $newProduct->save();

      $newProductId = CatalogProducts::geLastElementId();

      // Вызываем контролер gallery, добавляем новое изображение и получаем его id
      // Не уверен, будет ли это вообще работать....
      
      $imgParams[]=self::$unit;
      
      $newImageId = Controller::call('gallery@insertImage', $imgParams);
      $newImage = new catalogImages;

      $newImage->id_product = $newProductId;
      $newImage->id_image   = $newImageId;
      $newImage->save();

      // Перебираем параметры продукта. Если параметр отсутствует
      // добавляем соответствующую запись в catalog_options.
      // Если параметр существует получаем его id.

      $newOptions = Input::get('option');
      if (!empty($newOptions)) {
        foreach ($newOptions as $option) {
          if($optionExist = catalogOptions::where('option_name', '=', trim($option['name']))->get()){
            //var_dump($optionExist); die();
            $optionId = $optionExist[0]->id;

          } else {
            $optionNew = catalogOptions::create(array('option_name' => $option['name']));
            $optionId = $optionNew->id;
          }

        $optionValue = new catalogOptionsValues;
        $optionValue->id_product  = $newProductId;
        $optionValue->id_option   = $optionId;
        $optionValue->value       = $option['value'];
        $optionValue->save();

        }
      }
      return Redirect::to('/catalog/');

   	}

    //----------------------------------------------------------------------------------------------------------------------
    // Получить все товары в каттегории 
    //----------------------------------------------------------------------------------------------------------------------
    public function action_getAllProduct($idCategory=''){
      if(!Auth::user())
            return Redirect::to('login');
      $i=0;
      if($idCategory=='')
        $idCategory=Input::get('idCategory');

      if(!($page = Input::get('pageNo'))){
        $page=1;
      }

      // пагинация (контроллер Base)
      $offset   = self::getOffset('catalogProducts', 'id_category', $idCategory, $page);
      $pages    = self::getPagesCount('catalogProducts', 'id_category', $idCategory);
      $products = self::getElementsOnPage('catalogProducts', 'id_category', $idCategory, $offset);
      
  
      //$products = catalogProducts::where('id_category', '=', $idCategory)->get();
   
      foreach ($products as $product) {

       
        $productView[] = $product;
        $imageId = catalogImages::where('id_product', '=', $product['id'])->get();
        
        if (!empty($imageId)){
          $image = Images::getImageById($imageId[0]->id_image);
          $productView[$i]['imagePath'] = '/img/gallery/small/'.$image[0]['preview'];
          $i++;
        } else {
          $productView[$i]['imagePath'] = '/img/gallery/small/default.jpg';
        }

      }
      //$page=1;
      //var_dump($productView); die();
      $view = View::make('catalog.list_products')->with('products', $productView)
                                                  ->with('pages', $pages)
                                                  ->with('page', $page);
      return $view;
      
    }


   	//--------------------------------------------------------------------------------------------------
   	// Обновить товар
   	//--------------------------------------------------------------------------------------------------
   	public function action_updateProduct($idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Удалить товар
   	//--------------------------------------------------------------------------------------------------
   	public function action_deleteProduct()
   	{
      if(!Auth::user())
            return Redirect::to('login');

      $idProduct = Input::get('idProduct');

      // Удаляем продукт
      $product = catalogProducts::where('id', '=', $idProduct)->first();
      $idCategory = $product->id_category;
      $product->delete();

      // Удаляем изображение
      // к сожалению финча не прокатила, видимо вызов метода класа 
      // внутри другого метода этого класса в данной конструкции не работает... 
      // а может просто руки у меня кривые... Т_Т
      // Controller::call('gallery@deleteImage', $imgParams);
      $relationImageProduct = catalogImages::where('id_product', '=', $idProduct)->first();
      if(!empty($relationImageProduct)){
        $this->action_deleteImage($relationImageProduct->id_image, $relationImageProduct); // эту хрень нужно неприменно переписать!!!!
      }

      // Удаляем значения параметров
      $optionValues = catalogOptionsValues::where('id_product', '=', $idProduct)->get();
      foreach ($optionValues as $value) {
        $optionsId[] = $value->id_option;
        $value->delete(); 
      }

      // Проверяем параметры и удаляем параметры без значения
      foreach ($optionsId as $option) {
        $optionExist = catalogOptionsValues::where('id_option', '=', $option)->get();
        if(!$optionExist) {
          $optionDel = catalogOptions::where('id', '=', $option)->first();
          $optionDel->delete();
        }
      }

      // возвращаем вьюху с обновленной страницей каталога
   		return $this->action_getAllProduct($idCategory);
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Получить товар для редактирования
   	//--------------------------------------------------------------------------------------------------
   	public function action_getProduct()
   	{
      if(!Auth::user())
            return Redirect::to('login');
      $idProduct = Input::get('idProduct');

      $product = catalogProducts::find($idProduct);
      $product = $product->to_array();
  
      $imageId = catalogImages::where('id_product', '=', $idProduct)->first();
      if (!empty($imageId)){
        $image = Images::where('id', '=', $imageId->id_image)->first();
        $product['previewPath'] = '/img/gallery/small/'.$image->preview;
        $product['previewId'] = $image->id;
      } else {
        $product['previewPath'] = 'default';
      }

      $product['options'] = $this->getProductOptions($idProduct);
      
   		return json_encode($product);
   	}

    //----------------------------------------------------------------------------------------------------------------------
    // Изменить товар 
    //----------------------------------------------------------------------------------------------------------------------
    public function action_updateProductOption() {
      // меняем параметры продукта
      $idProduct = Input::get('idProductForm');
      $newProduct = catalogProducts::find($idProduct);

      //$newProduct->id_category  = Input::get('idProductCategory');  //пофиксить
      $newProduct->name         = Input::get('productName');
      $newProduct->title        = Input::get('productTitle');
      $newProduct->description  = Input::get('productDescription');
      $newProduct->content      = Input::get('productContent');
      $newProduct->price        = Input::get('productPrice'); 
      $newProduct->save();

      // меняем опции
      $newOptions = Input::get('option');

      foreach ($newOptions as $option) {
        //если есть OptionId стало быть это старые опции
        if($option['id']!='false') {
          
          $optionOldId = catalogOptionsValues::find($option['id']);
          $optionOldName = catalogOptions::find($optionOldId->id_option);
          
          // если имя параметра изменилось, создаем новый параметр.
          // старый проверить и если он без значений -удалить
          //var_dump($option['id']); die();
          if ($option['name'] != $optionOldName->option_name) {
            $optionId=$this->createNewOption($option);
            $optionOldId->delete();
            $this->checkAndDelOption($optionOldId->id_option);

            $optionValue = new catalogOptionsValues;
          } else {
            $optionValue = catalogOptionsValues::find($option['id']);
            $optionId = $optionValue->id_option;
          }

        } else {
           //die('Вторая ветка');
          $optionId=$this->createNewOption($option);
          $optionValue = new catalogOptionsValues;
        }

        $optionValue->id_product  = $idProduct;
        $optionValue->id_option   = $optionId;
        $optionValue->value       = $option['value'];
        $optionValue->save();
      }

      return Redirect::to('/catalog/');


    }

   	//--------------------------------------------------------------------------------------------------
   	// Получить список опций товара
   	//--------------------------------------------------------------------------------------------------
   	public function getProductOptions($idProduct)
    {
      if(!Auth::user())
            return Redirect::to('login');
      $allOptions=array();
      $i=0;
      $optionValues = catalogOptionsValues::where('id_product', '=', $idProduct)->get();
      
      foreach ($optionValues as $value) {
        $optionName = catalogOptions::find($value->id_option);
        $allOptions[$i]['name'] = $optionName->option_name;
        $allOptions[$i]['value'] = $value->value;
        $allOptions[$i]['id'] = $value->id;
        $i++;
      }
      return $allOptions;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Добавить опцию товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_addProductOption($idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Удалить опцию товара AJAX
   	//--------------------------------------------------------------------------------------------------
   	public function action_removeProductOption()
   	{
      if(!Auth::user())
            return Redirect::to('login');

      $idOption=Input::get('idOption');
   		
      $optionDelId = catalogOptionsValues::find($idOption);
      $optionDelId->delete();
      $this->checkAndDelOption($optionDelId->id_option);
   	}

/*  //--------------------------------------------------------------------------------------------------
   	// Обновить опцию товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_updateProductOption($idOption, $idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}
*/
   	//--------------------------------------------------------------------------------------------------
   	// Добавить значение опции
   	//--------------------------------------------------------------------------------------------------
   	public function action_addOptionValue($idProduct, $idOption, $value)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Обновить значние опции
   	//--------------------------------------------------------------------------------------------------
   	public function action_updateOptionValue($idProduct, $idOption, $value)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Удалить значение опции
   	//--------------------------------------------------------------------------------------------------
   	public function action_deleteProductOption($idProduct, $idOption, $value)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Добавить изображение товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_addImage($idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Удалить изображение товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_deleteImage($idImage='', $relationImageProduct='')
   	{		
      if(!Auth::user())
            return Redirect::to('login');

      if ($idImage == '') $idImage=Input::get('idImage');
   		if ($relationImageProduct == '') { 
        $idProduct=Input::get('idProduct');
        $relationImageProduct = catalogImages::where('id_product', '=', $idProduct)->first();
      }

      $image = Images::where('id', '=', $idImage)->first();
      //var_dump($idImage, $image); die();

      $imagePath = path('public').'img/gallery/'.$image->image;
      $previewPath = path('public').'img/gallery/small/'.$image->preview;

      unlink($imagePath);
      unlink($previewPath);
      $relationImageProduct->delete();
      $image->delete();
   	}






    //----------------------------------------------------------------------------------------------------------------------
    // вспомогательные функции 
    //----------------------------------------------------------------------------------------------------------------------
    public function createNewOption($option) {
     if($optionExist = catalogOptions::where('option_name', '=', trim($option['name']))->get()){
        $optionId = $optionExist[0]->id;
      } else {
        $optionNew = catalogOptions::create(array('option_name' => $option['name']));
        $optionId = $optionNew->id;
      }   
      
      return $optionId;  
    }

    public function checkAndDelOption($optionId) {
      $optionExist = catalogOptionsValues::where('id_option', '=', $optionId)->get();
        if(!$optionExist) {
          $optionDel = catalogOptions::where('id', '=', $optionId)->first();
          //var_dump($optionDel); die();
          $optionDel->delete();
        }
    }

   	

}