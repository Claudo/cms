<?php

class Base_Controller extends Controller {

	public static $onPage=10;

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	//-----------------------------------
  	// Пагинация --------------------------
  	//---------------------------------------
  	//----------------------------------------------------------------------------------------------------------------------
    // Количество страниц в категории (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getPagesCount($model, $SelectorName, $SelectorValue) {
        if($SelectorValue){
            $total=$model::where($SelectorName, '=', $SelectorValue)->count();
        } else {
            $total=$model::count();
        }
        /* Test Vars 
        $pages['model'] = $model;
        $pages['SName'] = $SelectorName;
        $pages['SValue'] = $SelectorValue;
        $pages['total'] = $total;
        $pages['staticVar'] = self::$onPage;
        $pages['result'] = ceil($total/self::$onPage);
         ---------- */

        $pages=ceil($total/self::$onPage);

        return $pages;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Смещение статей для данной страницы (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getOffset($model, $SelectorName, $SelectorValue, $pageNo=1) {
        $pages = self::getPagesCount($model, $SelectorName, $SelectorValue);
        
        if ($pages == 0) $pages=1; //временный фикс, нужен нормальный вывод ошибки на пустую категорию.

        $page=max(intval($pageNo),1);
        $page=min($page,$pages);
        $offset = ($page - 1)*self::$onPage;
    
        return $offset; 
    }

    //----------------------------------------------------------------------------------------------------------------------
    //  Получить элементы для заданной страницы в виде массива (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getElementsOnPage($model, $SelectorName, $SelectorValue, $offset) {

        $articles_array = array();
        if($SelectorValue) {
            $articles = $model::where($SelectorName, '=', $SelectorValue)->skip($offset)->take(self::$onPage)->get();
        } else {
            $articles = $model::skip($offset)->take(self::$onPage)->get();
        }

        foreach ($articles as $article) {
            $articles_array[] = $article->to_array();
        }

        return $articles_array;
    }



}