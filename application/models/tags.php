<?php
class Tags extends Eloquent {

    public static $table = 'tags';
    private static $countTags = 10;

    public function articles()
    {
        return $this->has_many_and_belongs_to('Articles');
    }

    public static function saveTags($tags, $article) {
        $count = 0;
        foreach($tags as $tag) {
            if(!$tag)
                continue;
            if($oldTag = Tags::where('title', '=', $tag)->get()) {
                if(!$article->tags()->where('tags_id','=', $oldTag[0]->id)->get())
                    $article->tags()->attach($oldTag[0]->id);
            } else {
                $tag = new Tags(array('title' => $tag));
                $article->tags()->insert($tag);
            }
            if($count >= self::$countTags)
                return;
            else
                ++$count;
        }
    }

    public static function getTagsByArticle($article) {
        $res = $article->tags()->get();
        $tags = array();
        foreach($res as $tag){
            $tags[] = $tag->to_array();
        }
        return $tags;
    }
}