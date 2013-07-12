<?php
class Catalog_Controller extends Base_Controller {

    static $unit = 2; //индекс модуля "catalog"

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
    // 
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
   	// Добавить товар
   	//--------------------------------------------------------------------------------------------------
   	public function action_addProduct()
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
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
   	public function action_deleteProduct($idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Получить товар
   	//--------------------------------------------------------------------------------------------------
   	public function action_getProduct()
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return $product;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Получить список опций товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_getProductOptions($idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return $options;
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
   	// Удалить опцию товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_removeProductOption($idOption, $idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	//--------------------------------------------------------------------------------------------------
   	// Обновить опцию товара
   	//--------------------------------------------------------------------------------------------------
   	public function action_updateProductOption($idOption, $idProduct)
   	{
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

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
   	public function action_deleteImage($idImage)
   	{		
      if(!Auth::user())
            return Redirect::to('login');
   		return true;
   	}

   	

}