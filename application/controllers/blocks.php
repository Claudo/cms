<?php
class Blocks_Controller extends Base_Controller {
    public  function action_index() {
<<<<<<< HEAD
        $view = View::make('blocks.home')->with('navActive', 'blocks');
=======

        $blocks = Blocks::getAll();

        $view = View::make('blocks.home')
                        ->with('navActive', 'blocks')
                        ->with('blocks', $blocks);
>>>>>>> 4b211cc633c6b68c3d12ca30f1ab7744c23cf6f0

        return $view;
    }
}