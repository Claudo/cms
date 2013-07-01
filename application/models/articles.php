<?php

class Articles extends Eloquent {
    //--------------------------------------------------------------------------------------------------
    // Задаем название таблицы и количество статей на странице
    //--------------------------------------------------------------------------------------------------
    public static $table = 'articles';
    static $onPage = 4; //A может сделать тебя константой??

    public function tags()
    {
        return $this->has_many_and_belongs_to('Tags');
    }

    public function comments()
    {
        return $this->has_many('Comment');
    }

    //--------------------------------------------------------------------------------------------------
    // Получить все статьи в заданной категории в виде массива
    //--------------------------------------------------------------------------------------------------
    public static function getArticlesInCAtegory($idCategory) {
        $articles_array = array();      
        $articles = Articles::where('id_category', '=', $idCategory)->get();
        foreach ($articles as $article) {
            $articles_array[] = $article->to_array();
        }

        return $articles_array;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Количество страниц в категории (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getPagesCount($idCategory) {
        if($idCategory){
            $total=Articles::where('id_category', '=', $idCategory)->count();
        } else {
            $total=Articles::count();
        }

        $pages=ceil($total/self::$onPage);

        return $pages;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Смещение статей для данной страницы (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getOffset($idCategory, $pageNo=1) {
        $pages = self::getPagesCount($idCategory);
        
        if ($pages == 0) $pages=1; //временный фикс, нужен нормальный вывод ошибки на пустую категорию.

        $page=max(intval($pageNo),1);
        $page=min($page,$pages);
        $offset = ($page - 1)*self::$onPage;
    
        return $offset; 
    }


    //----------------------------------------------------------------------------------------------------------------------
    //  Получить статьи для заданной страницы в виде массива (by Igor)
    //----------------------------------------------------------------------------------------------------------------------
    public static function getArticlesPage($idCategory, $offset) {

        $articles_array = array();
        if($idCategory) {
            $articles = Articles::where('id_category', '=', $idCategory)->skip($offset)->take(self::$onPage)->get();
        } else {
            $articles = Articles::skip($offset)->take(self::$onPage)->get();
        }

        foreach ($articles as $article) {
            $articles_array[] = $article->to_array();
        }

        return $articles_array;
    }


}