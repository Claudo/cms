<?php
class Catalog_Controller extends Base_Controller {
    public  function action_index() {
        $view = View::make('catalog.home')->with('navActive', 'catalog');

        return $view;
    }
}