<?php
class Comments_Controller extends Base_Controller {
    public $layout = false;
    //--------------------------------------------------------------------------------------------------
    // Получение блока комментариев для статьи (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    public function action_index($artId, $admin = 0) {

        $comments = Comment::where('articles_id', '=', $artId)->get();

        $result = array();
        foreach($comments as $comment) {
            $result[] = $comment->to_array();
        }
        $result = array_reverse($result);

        $view = View::make('comments.home')
                            ->with('artId', $artId)
                            ->with('admin', $admin)
                            ->with('navActive', 'articles')
                            ->with('moder', Comment::$moder)
                            ->with('comments', $result);

        return $view;
    }
    //--------------------------------------------------------------------------------------------------
    // Добавление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    public function action_addComment() {
        if(!Auth::user())
            return Redirect::to('login');


        $res = array();
        $codeCaptcha = Input::get('captcha');

        $email = Input::get('email');
        $valid_mail = preg_match('/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/D', $email);

        if(!$valid_mail) {
            $res['wrongEmail'] = 1;
        }

        session_start();
        if ( !(isset($_SESSION['captcha']) && strtoupper($_SESSION['captcha']) == strtoupper($codeCaptcha)) ) {
            $res['wrongCaptcha'] = 1;

        }

        if(isset($res['wrongEmail']) || isset($res['wrongCaptcha']))
            return json_encode($res);

        $name = Input::get('name');
        $email = Input::get('email');
        $text = Input::get('text');
        $artId = Input::get('artId');

        $comment = new Comment();
        $comment->articles_id = $artId;
        $comment->name = $name;
        $comment->email = $email;
        $comment->text = $text;
        $comment->save();

        $res = $comment->to_array();
        $res['captcha'] = 1;
        return json_encode($res);

    }

    //--------------------------------------------------------------------------------------------------
    // Удаление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------

    public function action_removeComment() {
        if(!Auth::user())
            return Redirect::to('login');
        $comId = Input::get('commentId');
        Comment::find($comId)->delete();

        $res = array('id' => $comId);
        return json_encode($res);
    }

    public function action_approveComment() {
        if(!Auth::user())
            return Redirect::to('login');
        $comId = Input::get('commentId');
        $comment = Comment::find($comId);
        $comment->check = 1;
        $comment->save();
        $res = array('id' => $comId);
        return json_encode($res);
    }
    //--------------------------------------------------------------------------------------------------
    // Получение капчи (by Nagovski)
    //--------------------------------------------------------------------------------------------------

    public function action_captcha() {
         $letters = 'ABCDEFGKIJKLMNOPQRSTUVWXYZ';

        $caplen = 6;
        $width = 120; $height = 20;
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        $sep = '';
        if(substr($docRoot,-1) != '/') {
            $sep = '/';
        }
        $font = $docRoot.$sep.'public/img/comic.ttf';

        $fontsize = 14;

        header('Content-type: image/png');

        $im = imagecreatetruecolor($width, $height);
        imagesavealpha($im, true);
        $bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $bg);

        putenv( 'GDFONTPATH=' . realpath('.') );

        $captcha = '';
        for ($i = 0; $i < $caplen; $i++)
        {
            $captcha .= $letters[ rand(0, strlen($letters)-1) ];
            $x = ($width - 20) / $caplen * $i + 10;
            $x = rand($x, $x+4);
            $y = $height - ( ($height - $fontsize) / 2 );
            $curcolor = imagecolorallocate( $im, rand(0, 100), rand(0, 100), rand(0, 100) );
            $angle = rand(-25, 25);
            imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]);
        }

        session_start();
        $_SESSION['captcha'] = $captcha;

        imagepng($im);
        imagedestroy($im);
        exit;
    }
}