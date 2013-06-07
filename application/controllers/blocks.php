<?php
class Blocks_Controller extends Base_Controller {
    public  function action_index() {

        $blocks = Blocks::getAllBlocks();

        $view = View::make('blocks.home')
                        ->with('navActive', 'blocks');
                        ->with('blocks', $blocks);

        return $view;
    }

    public function action_insertBlock() {
        $article = new Blocks;
        $article->url = Input::get('url');
        $article->block = Input::get('block');
        $article->save();

        return true;
    }
}