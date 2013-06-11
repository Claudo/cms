<?php
class Blocks extends Eloquent {

    public static $limitOnPage = 3;

    public static $table = 'blocks';

    public static function getAll() {
        $blocks_array = array();
        $blocks = self::all();

        foreach ($blocks as $block) {
            $blocks_array[] = $block->to_array();
        }

        return $blocks_array;
    }

    public static function getBlocksByPageNum($pageNum) {
        if ($pageNum > 1) {
            $skip = ($pageNum-1)*self::$limitOnPage;
        } else {
            $skip = 0;
        }
        $blocks = self::skip($skip)->take(self::$limitOnPage)->get();

        $blocks_array = array();
        foreach($blocks as $block) {
            $blockArr = $block->to_array();
            $blockArr['block'] = htmlspecialchars(mb_substr($blockArr['block'], 0, 300));
            $blocks_array[] = $blockArr;
        }

        return $blocks_array;
    }

    public static function getPagesCount() {
        $blocks = self::all();

        if($blocks) {
            $pageCount = ceil($blocks[0]->count() / self::$limitOnPage);
            return $pageCount;
        }
    }
}