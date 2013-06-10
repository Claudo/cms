<?php
class Blocks extends Eloquent {
    public static $table = 'blocks';

        public static function getAll() {
            $blocks_array = array();
            $blocks = self::all();

            foreach($blocks as $block) {
                $blocks_array[] = $block->to_array();
            }

            return $blocks_array;
        }
}