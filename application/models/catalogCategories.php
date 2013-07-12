<?php 

class catalogCategories extends Eloquent {
	//--------------------------------------------------------------------------------------------------
	// Задаем название таблицы
	//--------------------------------------------------------------------------------------------------
	public static $table = 'catalog_categories';

	//--------------------------------------------------------------------------------------------------
	// Добавление категории
	//--------------------------------------------------------------------------------------------------
	public static function addCategory($nameCategory, $parentId = null) {
        $category = new catalogCategories;
        if($parentId) $category->parent_id = $parentId;
        $category->name_category = $nameCategory;
        $category->save();
    }

    //--------------------------------------------------------------------------------------------------
    // Получить список всех категорий в виде массива
    //--------------------------------------------------------------------------------------------------
    public static function getCategories()
    {
    	$categories_array = array();
        $categories = catalogCategories::all();
        foreach($categories as $category) {
            $categories_array[] = $category->to_array();
        }

        return $categories_array;
    }
}
