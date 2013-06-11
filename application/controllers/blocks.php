<?php
class Blocks_Controller extends Base_Controller {

    public  function action_index() {

        $page = Input::get('page') ? Input::get('page') : 1;
        $blocks = Blocks::getBlocksByPageNum($page);
        $template = Request::ajax() ? 'blocks.blocklist' : 'blocks.home';

        $pageCount = Blocks::getPagesCount();


        $view = View::make($template)
                        ->with('navActive', 'blocks')
                        ->with('pages', $pageCount ? $pageCount : 0)
                        ->with('page', $page)
                        ->with('blocks', $blocks);

        return $view;
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

        return json_encode(array(
                            'id'    => $block->id,
                            'block' => htmlspecialchars(mb_substr($block->block, 0, 300))
        ));
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
