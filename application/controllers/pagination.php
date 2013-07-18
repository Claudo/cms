<?php
// привести в нормальный вид, потестить, внедрить.
class Pagination_Controller extends Base_Controller {

/*
    protected $table_name;


    function set_table_name($table_name) {
        $this->table_name = $table_name;
        return true;
    }
*/
	//----------------------------------------------------------------------------------------------------------------------
    // Количество страниц в категории (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getPagesCount($model, $SelectorName, $SelectorValue) {
        if($SelectorValue){
            $total=$model::where($SelectorName, '=', $SelectorValue)->count();
        } else {
            $total=$model::count();
        }

        $pages=ceil($total/self::$onPage);

        return $pages;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Смещение статей для данной страницы (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getOffset($SelectorValue, $pageNo=1) {
        $pages = self::getPagesCount($SelectorValue);
        
        if ($pages == 0) $pages=1; //временный фикс, нужен нормальный вывод ошибки на пустую категорию.

        $page=max(intval($pageNo),1);
        $page=min($page,$pages);
        $offset = ($page - 1)*self::$onPage;
    
        return $offset; 
    }

    //----------------------------------------------------------------------------------------------------------------------
    //  Получить элементы для заданной страницы в виде массива (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getArticlesPage($model, $SelectorValue, $offset) {

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

?>