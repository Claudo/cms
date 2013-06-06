<?php
class Articles_Controller extends Base_Controller {
    public  function action_index() {
        $categories = Categories::getAllCategories();

        $breadcrumbsArr[] = array ('name' => 'статьи', 'url' => '');
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr)); 
        
        $view = View::make('articles.home')
                        ->with('navActive', 'articles')
                        ->with('tree', $categories)
                        ->with('breadcrumbs', $breadcrumbs)
                        ->with('idCategory', '')
                        ->with('articles', '')
                        ->with('pages', '')
                        ->with('page', '');
        return $view;
    }

    //--------------------------------------------------------------------------------------------------
    // Добавление новой статьи
    //--------------------------------------------------------------------------------------------------
    public function action_insertArticle() {
        $article = new Articles;
        $article->title = Input::get('title');
        $article->description = Input::get('description');
        $article->header = Input::get('header');
        $article->content = Input::get('content');
        $article->id_category = Input::get('idCategory');
        $article->save();

        return true;
    }

    //--------------------------------------------------------------------------------------------------
    // Обновление статьи
    //--------------------------------------------------------------------------------------------------
    public function action_updateArticle() {
        $article = Articles::find(Input::get('idArticle'));
        $article->header = Input::get('header');
        $article->title = Input::get('title');
        $article->description = Input::get('description');
        $article->content = Input::get('content');
        $article->save();
    }

    //--------------------------------------------------------------------------------------------------
    // Отдает в формате JSON данные для редактирования статьи
    //--------------------------------------------------------------------------------------------------
    function action_getArticleJson() {
        $idArticle = $_POST['idArticle'];
        if(!empty($idArticle)) {
            $article = Articles::find($idArticle);
            $article = $article->to_array();
            return json_encode($article);
        }
        else return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление статьи
    //--------------------------------------------------------------------------------------------------
    function action_deleteArticle() {
        $idArticle = Input::get('idArticle');
        if (!empty($idArticle)) { 
            Articles::find($idArticle)->delete();
            return true;
        } else {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Массив статей в заданной категории
    //--------------------------------------------------------------------------------------------------
    public function action_listArticles($idCategory) {
        $articles = Articles::getArticlesInCategory($idCategory);
        $tree = Categories::getAllCategories();

        // если это ajax запрос, отдаем только список статей без шапки, футера и пр.
        if(Request::ajax()) $view = View::make('articles.list_articles')->with('articles', $articles);
        else $view = View::make('articles.home')
                            ->with('navActive', 'articles')
                            ->with('tree', $tree)
                            ->with('articles', $articles)
                            ->with('idCategory', $idCategory)
                            ->with('breadcrumbs', '$breadcrumbs')
                            ->with('pages', '')
                            ->with('page', '');

        return $view;
    }



    //--------------------------------------------------------------------------------------------------
    // Массив с содержимым стаьи (by Igor)
    //--------------------------------------------------------------------------------------------------
    function action_getArticle($idCategory, $idArticle){
        if(empty($idArticle) || empty($idCategory)) return false;

        $tree = Categories::getAllCategories();
        $article = Articles::find($idArticle); 
        if (empty($article)) {
            $view = View::make('error.404');
            return $view;
        }
        
        $article_arr = $article->to_array();
//
//        debug($article_arr); exit;
        $categoryArr = Categories::getCategoryById($idCategory);                
        $categoryName = $categoryArr[0]['name_category'];   
        $breadcrumbsArr = array(
                                array ('name' => 'статьи', 'url' => '/articles/'),
                                array ('name' => $categoryName, 'url' => '/articles/'.$idCategory),
                                array ('name' => $article_arr['header'], 'url' => '')
                                );
        
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr)); 


        $view = View::make('articles.show_article')
                        ->with('navActive', 'articles')
                        ->with('tree', $tree)
                        ->with('article_arr', $article_arr)
                        ->with('idCategory', $idCategory)
                        ->with('breadcrumbs', $breadcrumbs);

        return $view;
    }

    //--------------------------------------------------------------------------------------------------
    // Получение части статей для вывода на странице (by Igor)
    //--------------------------------------------------------------------------------------------------
    function action_getArticlesOnPage($idCategory) {
       
        $tree = Categories::getAllCategories();
        $pages=Articles::getPagesCount($idCategory);

        
        $categoryArr = Categories::getCategoryById($idCategory); 

        $categoryName = $categoryArr[0]['name_category']; 

        $breadcrumbsArr = array( 
                                 array ('name' => 'статьи', 'url' => '/articles/'),   
                                 array ('name' => $categoryName, 'url' => '')
                                 );        

        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));       

//        debug($breadcrumbs); exit;
//        debug($breadcumps);
//        var_dump($tmp); 
//        exit();
        /* 
        if ($pages == 0) {
            $view = View::make('error.404');
            return $view;
        }
        */

        if(Request::ajax()) {
            $page = Input::get('page');
            $page=max(intval($page),1);
            $page=min($page,$pages);

            $offset=Articles::getOffset($idCategory, $page);
            $articles=Articles::getArticlesPage($idCategory, $offset);
            $view = View::make('articles.list_articles')
                            ->with('articles', $articles)
                            ->with('pages', $pages)
                            ->with('page', $page);
        } else {
            $offset=Articles::getOffset($idCategory);
            $articles=Articles::getArticlesPage($idCategory, $offset);
            $view = View::make('articles.home')
                            ->with('navActive', 'articles')
                            ->with('tree', $tree)
                            ->with('articles', $articles)
                            ->with('idCategory', $idCategory)
                            ->with('breadcrumbs', $breadcrumbs)
                            ->with('pages', $pages)
                            ->with('page', 1);
        }
       
       return $view; 
    }  
}