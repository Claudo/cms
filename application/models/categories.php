<?php 

class Categories extends Eloquent {
	//--------------------------------------------------------------------------------------------------
	// Задаем название таблицы	
	//--------------------------------------------------------------------------------------------------	
	public static $table = 'categories';

    //--------------------------------------------------------------------------------------------------
    // Добавление категории
    //--------------------------------------------------------------------------------------------------
    public static function addCategory($nameCategory, $parentId = null) {
        $category = new Categories;
        if($parentId) $category->parent_id = $parentId;
        $category->name_category = $nameCategory;
        $category->save();
    }

    //----------------------------------------------------------------------------------------------------------------------
    //  Получить атрибуты категории по id
    //----------------------------------------------------------------------------------------------------------------------
    public static function getCategoryById($idCategory) {
        $elements = array();
        $category = Categories::where('id', '=', $idCategory)->get();
        foreach ($category as $element) {
            $elements[] = $element->to_array(); 
        }
        return $elements;
    }

    //--------------------------------------------------------------------------------------------------
    // Получить все категории в виде массива
    //--------------------------------------------------------------------------------------------------
    public static function getAllCategories() {
        $categories_array = array();
        $categories = Categories::all();
        foreach($categories as $category) {
            $categories_array[] = $category->to_array();
        }

        return $categories_array;
    }


}