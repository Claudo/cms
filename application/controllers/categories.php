<?php

class Categories_Controller extends Base_Controller {
	//--------------------------------------------------------------------------------------------------
	// Домашний метод, выдает список категорий, кнопки управления
	//--------------------------------------------------------------------------------------------------
	public function action_index() {
        if(!Auth::user())
            return Redirect::to('login');

        $categories = Categories::getAllCategories();
		$view = View::make('categories.home')->with('navActive', 'categories')->with('tree', $categories);

		return $view;
	}

	//--------------------------------------------------------------------------------------------------
	// Добавление категории
	//--------------------------------------------------------------------------------------------------
	public function action_addCategory() {
        if(!Auth::user())
            return Redirect::to('login');

		$categoryName = Input::get('categoryName'); //echo $categoryName; exit;
        $parentId = Input::get('idParent');
        $unit = Input::get('unit');

        if(!empty($categoryName)) { 
          if(empty($parentId)) $parentId = 0;
          if(empty($unit)) $unit = 1;
          Categories::addCategory($categoryName, $parentId, $unit);
          return true;
      } else return false;  
	}

    //--------------------------------------------------------------------------------------------------
    // Удаление категории
    //--------------------------------------------------------------------------------------------------
    public function action_deleteCategory() {
        if(!Auth::user())
            return Redirect::to('login');

        $idCategory = $_POST['idCategory'];
        if(!empty($idCategory)) {
            $category = Categories::find($idCategory)->delete();
            return true;
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Информация о категории
    //--------------------------------------------------------------------------------------------------
    public function getCategory($id) {
        if(!Auth::user())
            return Redirect::to('login');

        $idCategory = $_POST['idCategory'];
        if(!empty($idCategory)) {

        }
    }

    //--------------------------------------------------------------------------------------------------
    // Информация о категории в формате JSON
    //--------------------------------------------------------------------------------------------------
    public function action_getCategoryJson () {
        if(!Auth::user())
            return Redirect::to('login');

        $idCategory = Input::get('idCategory');
        if(!empty($idCategory)) {
            $category = Categories::find($idCategory);
            $category = $category->to_array();
            $json = json_encode($category);

            return $json;
        }
        else return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Строиит дерево категорий
    //--------------------------------------------------------------------------------------------------
    public  function action_buildCategoriesTree() {
        if(!Auth::user())
            return Redirect::to('login');

        $categories = Categories::getAllCategories();
        $view = View::make('categories.tree')->with('tree', $categories);

        return $view;
    }

    //--------------------------------------------------------------------------------------------------
    // Обновление категории
    //--------------------------------------------------------------------------------------------------
    public function action_updateCategory() {
        if(!Auth::user())
            return Redirect::to('login');

        $idCategory = Input::get('idCategory');
        $nameCategory = Input::get('nameCategory');

        var_dump($idCategory, $nameCategory);
        if(!empty($idCategory) && !empty($nameCategory)) {
            $category = Categories::find($idCategory);
            $category->name_category = $nameCategory;
            $category->save();       
            return true;
        }
    }

}