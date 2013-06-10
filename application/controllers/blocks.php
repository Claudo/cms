<?php
class Blocks_Controller extends Base_Controller {

    public  function action_index() {

        $pageCount = Blocks::getPagesCount();

        if(Request::ajax()){

        } else {

            $blocks = Blocks::getAll();
            $view = View::make('blocks.home')
                            ->with('navActive', 'blocks')
                            ->with('pages', $pageCount)
                            ->with('page', 1)
                            ->with('blocks', $blocks);

            return $view;
        }
    }

    public function action_saveBlock() {

        $blockId = Input::get('id');

        if($blockId) {
            $block = Blocks::find($blockId);
        } else {
            $block = new Blocks;
        }

        $block->url = Input::get('url');
        $block->block = Input::get('block');
        $block->save();

        return json_encode(array('id' => $block->id));
    }

    public function action_removeBlock() {
        $blockId = Input::get('id');
        Blocks::find($blockId)->delete();
        return true;
    }

    public function action_getBlockById() {
        $blockId = Input::get('id');
        $block = Blocks::find($blockId);
        $block = $block->to_array();
        return json_encode($block);
    }
}
