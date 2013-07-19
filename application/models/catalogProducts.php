<?php

class catalogProducts extends Eloquent {
	//--------------------------------------------------------------------------------------------------
	// Задаем название таблицы
	//--------------------------------------------------------------------------------------------------
	public static $table = 'catalog_products';

	//----------------------------------------------------------------------------------------------------------------------
	// Получить id последнего элемента
	//----------------------------------------------------------------------------------------------------------------------
	public static function geLastElementId(){
		$lastProduct = CatalogProducts::order_by('id', 'desc')->first();
		return $lastProduct->id;
	}
}