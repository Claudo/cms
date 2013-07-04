<?php
class Articles_Controller extends Base_Controller {
    public  function action_index() {

        if(!Auth::user())
            return Redirect::to('login');

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
        if(!Auth::user())
            return Redirect::to('login');

        $article = new Articles;
        $article->title = Input::get('title');
        $article->description = Input::get('description');
        $article->header = Input::get('header');
        $article->content = Input::get('content');

        $file = Input::file('imgPreview');
        if($file['tmp_name']) {
            Images::createPreview($file['tmp_name'], 100, 100, false);
            $article->img_preview = file_get_contents($file['tmp_name']);;
        }

        $article->id_category = Input::get('idCategory');
        $article->save();


        $tags = Input::get('tag');

        if (!empty($tags) && $article->id) {
            Tags::saveTags($tags, $article);
        }

        if(Request::ajax())
            return true;
        else
            return Redirect::to('/articles/'.$article->id_category);

    }

    //--------------------------------------------------------------------------------------------------
    // Обновление статьи
    //--------------------------------------------------------------------------------------------------
    public function action_updateArticle() {
        if(!Auth::user())
            return Redirect::to('login');

        $article = Articles::find(Input::get('idArticle'));
        $article->header = Input::get('header');
        $article->title = Input::get('title');
        $article->description = Input::get('description');
        $article->content = Input::get('content');

        $file = Input::file('imgPreview');

        if($file['tmp_name']) {
            Images::createPreview($file['tmp_name'], 100, 100, false);
            $article->img_preview = file_get_contents($file['tmp_name']);;
        }
        $article->save();

        $tags = Input::get('tag');

        if (!empty($tags) && $article->id) {
            Tags::saveTags($tags, $article);
        }

        if(Request::ajax())
            return true;
        else
            return Redirect::to('/articles/'.$article->id_category.'/'.Input::get('idArticle'));
    }

    //--------------------------------------------------------------------------------------------------
    // Отдает в формате JSON данные для редактирования статьи
    //--------------------------------------------------------------------------------------------------
    function action_getArticleJson() {
        if(!Auth::user())
            return Redirect::to('login');

        $idArticle = $_POST['idArticle'];
        if(!empty($idArticle)) {
            $article = Articles::find($idArticle);
            $tags = Tags::getTagsByArticle($article);
            $article = $article->to_array();
            $article['tags'] = $tags;
            return json_encode($article);
        }
        else return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление статьи
    //--------------------------------------------------------------------------------------------------
    function action_deleteArticle() {
        if(!Auth::user())
            return Redirect::to('login');

        $idArticle = Input::get('idArticle');
        if (!empty($idArticle)) {
            $article = Articles::find($idArticle);
            $article->tags()->delete();
            $article->comments()->delete();
            $article->delete();
            return true;
        } else {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Массив статей в заданной категории
    //--------------------------------------------------------------------------------------------------
    public function action_listArticles($idCategory) {
        if(!Auth::user())
            return Redirect::to('login');

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
        if(!Auth::user())
            return Redirect::to('login');

        if(empty($idArticle) || empty($idCategory)) return false;

        $tree = Categories::getAllCategories();
        $article = Articles::find($idArticle); 
        if (empty($article)) {
            $view = View::make('error.404');
            return $view;
        }
        
        $article_arr = $article->to_array();
        $article_arr['tags'] = Tags::getTagsByArticle($article);

        $categoryArr = Categories::getCategoryById($idCategory);
        $categoryName = $categoryArr[0]['name_category'];
        $breadcrumbsArr = array(
                                array ('name' => 'статьи', 'url' => '/articles/'),
                                array ('name' => $categoryName, 'url' => '/articles/'.$idCategory),
                                array ('name' => $article_arr['header'], 'url' => '')
                                );
        
        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));

        $commentsView = Controller::call('comments@index', array($idArticle, 1));


        $view = View::make('articles.show_article')
                        ->with('navActive', 'articles')
                        ->with('commentsView', $commentsView)
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
        if(!Auth::user())
            return Redirect::to('login');
       
        $tree = Categories::getAllCategories();
        $pages=Articles::getPagesCount($idCategory);

        
        $categoryArr = Categories::getCategoryById($idCategory); 

        $categoryName = $categoryArr[0]['name_category']; 

        $breadcrumbsArr = array( 
                                 array ('name' => 'статьи', 'url' => '/articles/'),   
                                 array ('name' => $categoryName, 'url' => '')
                                 );        

        $breadcrumbs = Controller::call('breadcrumbs@createBreadcrumbs', array($breadcrumbsArr));       

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

    //--------------------------------------------------------------------------------------------------
    // Получение превью статьи (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    public function action_imgPreview($idArticle) {
        $article = Articles::find($idArticle);
        $article = $article->to_array();
        $image = $article['img_preview'];
        if(!$image) {
            return '';
        }
        header("Content-type: image/jpeg");
        echo $image;
        exit;
    }
    //--------------------------------------------------------------------------------------------------
    // Удаление одного тега (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    public function action_removeTagFromArticle() {
        if(!Auth::user())
            return Redirect::to('login');

        $articleId = Input::get('articleId');
        $tagId = Input::get('tagId');

        $article = Articles::find($articleId);
        $pivot = $article->tags()->pivot();
        $pivot->where('tags_id', '=', $tagId)->delete();

        $res = array('tagId' => $tagId);
        return json_encode($res);
    }

    public function action_getArticleData($artId) {
        $article = Articles::find($artId);
        $tags = Tags::getTagsByArticle($article);
        $category = Categories::getCategoryById($article->id_category);
        $article = $article->to_array();
        $article['tags'] = $tags;
        $article['category'] = $category[0];
        $data = serialize($article);
        return $data;
    }

    public function action_getArticlesListData($catId, $page) {
        $offset=Articles::getOffset($catId, $page);
        $articles = Articles::getArticlesPage($catId, $offset);
        $data = array();
        $data['articles'] = $articles;
        $data['pageCount'] = Articles::getPagesCount($catId);
        $category = Categories::find($catId);
        if($category) {
            $data['category'] = $category->to_array();
        }
        $data = serialize($data);
        return $data;
    }

    public function action_getArticlesDataByTag($tag) {
        $tag = str_replace('%20',' ',$tag);
        $tags = Tags::where('title', '=', $tag)->get();
        $articles = $tags[0]->articles()->get();
        $res = array();
        $res['tag'] = $tag;
        $res['pageCount'] = count($articles);
        $res['articles'] = array();
        foreach($articles as $article) {
            $res['articles'][] = $article->to_array();
        }

        $data = serialize($res);
        return $data;
    }

}