<?php
class Blocks extends Eloquent {

    public static $limitOnPage = 3;

    public static $table = 'blocks';

    public static function getAll() {
        $blocks_array = array();
        $blocks = self::all();

        foreach($blocks as $block) {
            $blocks_array[] = $block->to_array();
        }

        return $blocks_array;
    }

    public function getBlocksByPageNum($pageNum = 1) {

    }

    public static function getPagesCount() {
        $blocks = self::all();
        $pageCount = ceil($blocks[0]->count() / self::$limitOnPage);
        return $pageCount;
    }
}