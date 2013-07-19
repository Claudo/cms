<?php 

class Categories extends Eloquent {
	//--------------------------------------------------------------------------------------------------
	// Задаем название таблицы	
	//--------------------------------------------------------------------------------------------------	
	public static $table = 'categories';

    //--------------------------------------------------------------------------------------------------
    // Добавление категории
    // (change 12-07-13: добавлен флаг 'unit' 
    // определяющий модуль которому принадлежат категории (default: 1 - categories))
    //--------------------------------------------------------------------------------------------------
    public static function addCategory($nameCategory, $parentId = null, $unit = 1) {
        $category = new Categories;
        if($parentId) $category->parent_id = $parentId;
        $category->for_unit = $unit;
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
    // (change 12-07-13: добавлен флаг 'unit' 
    // определяющий модуль которому принадлежат категории (default: 1 - categories))
    //--------------------------------------------------------------------------------------------------
    public static function getAllCategories($unit=1) {
        $categories_array = array();
        $categories = Categories::where('for_unit', '=', $unit)->get();
        foreach($categories as $category) {
            $categories_array[] = $category->to_array();
        }

        return $categories_array;
    }

    public static function getChildCategories($parentCategoryId){
        $elements=array();
        $childCategories = Categories::where('parent_id', '=', $parentCategoryId)->get();
        foreach ($childCategories as $category) {
            $elements[] = $category->to_array();
        }
        return $elements;
    }

   


}