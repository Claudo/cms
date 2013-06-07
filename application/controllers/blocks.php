<?php
class Blocks_Controller extends Base_Controller {
    public  function action_index() {
        $view = View::make('blocks.home')->with('navActive', 'blocks');

        return $view;
    }
}