
<style>
    .comment-text {
        margin: 10px
    }
    .comment {
        margin: 50px 0 0px 0;
    }

    #addComments {
        width: 500px;
        position: relative;
        left: -30px;
    }

    #addComments label{
        width: 150px;
    }

    .inputComment {
        width: 306px;
    }



</style>

<?php /*<form class="form-horizontal" id="addComments" name='addComments'>
    <!-- Name -->
   <div class="control-group">
        <label class="control-label" for="inputName">Имя:</label>
        <div class="controls">

             <input type="text" id="inputName" name="name" class='inputComment'>

        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputEmail">E-mail:</label>
        <div class="controls">

             <input type="text" id="inputEmail" name="email" class='inputComment'>

        </div>
    </div>
    <!-- Text -->
    <div class="control-group">
        <label class="control-label" for="inputText">Текст:</label>
        <div class="controls">

            <textarea name="text" id="inputText" name="inputText" class='inputComment'></textarea>

        </div>
    </div>
    <!-- Captcha -->
    <div class="control-group">
        <label class="control-label" for="inputCaptcha">Введите буквы с картинки:</label>
        <div class="controls">
        <img style='margin:0 15px 5px 15px;' id='imgCaptcha' src='http://{{$_SERVER["HTTP_HOST"]}}/captcha'>
        <a  href='#' onClick='$("#imgCaptcha").attr("src", "http://{{$_SERVER["HTTP_HOST"]}}/captcha?"+ Math.random()); return false;'>Обновить</a>
        <br>
        <input style='margin:10px 0 0 0;' type="text" id="inputCaptcha" name="captcha" class='inputComment'>
        </div>
    </div>
    <input type='hidden' name='artId' id='artId' value='{{ $artId }}'>
    <br>
    <input type='button' value='Отправить' onClick="addComment()" class="btn btn-primary" style="float:right;">
</form> */?>
<div id="comments">
    @foreach($comments as $comment)
        @if($admin || $comment['check'] || !$moder)
        <div class="comment" id='com{{$comment['id']}}'>
            @if($admin)
                <div type="button" onClick="removeComment({{$comment['id']}});" class="close" data-dismiss="modal" aria-hidden="true">×</div>
            @endif
            @if(!$comment['check'] && $moder && $admin)
                <a href='#' id="approve{{$comment['id']}}" onClick="approveComment({{$comment['id']}}); return false;">approve</a>
            @endif
            <div class="comment-name"><b>Имя:</b> {{$comment['name']}}</div>
            <div class="comment-email"><b>E-mail:</b> {{$comment['email']}}</div>
            <div class="comment-text">{{$comment['text']}}</div>
        </div>
        @endif
    @endforeach
</div>

@if($admin)
<script>
    //--------------------------------------------------------------------------------------------------
    // Добавление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    <?php /*function addComment() {
        var comName = $('#inputName').val();
        var comEmail = $('#inputEmail').val();
        var artId = $('#artId').val();
        var comText = $('#inputText').val();
        var comCaptcha = $('#inputCaptcha').val();
        if(!comName || !comName || !comText || !comCaptcha) {
            alert('Заполните все поля');
            return false;
        }
        $.get('/comments/addComment',{name: comName, email: comEmail, text: comText, artId: artId, captcha: comCaptcha}, function(data) {
            data = $.parseJSON(data);

            if(data.wrongCaptcha || data.wrongEmail) {
                var str = '';
                str += data.wrongCaptcha ? 'Не правильные символы с картинки! \r\n':'';
                str += data.wrongEmail ? 'Не правильно набранный e-mail!':'';
                alert(str);
                $("#imgCaptcha").attr("src", "http://{{$_SERVER['HTTP_HOST']}}/captcha?"+ Math.random());
                return false;
            }

            var comment = $('<div class="comment" id="com'+data.id+'">');
            comment.append('<div class="comment-name"><b>Имя:</b> '+data.name+'</div>');
            comment.append('<div class="comment-email"><b>E-mail:</b> '+data.email+'</div>');
            comment.append('<div class="comment-text">'+data.text+'</div>');
            $('#comments').prepend(comment);
            $("#imgCaptcha").attr("src", "http://{{$_SERVER['HTTP_HOST']}}/captcha?"+ Math.random());
        });
    }*/?>
    //--------------------------------------------------------------------------------------------------
    // Удаление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------

    function removeComment(comId) {
        $.get('/comments/removeComment', {commentId: comId}, function(data) {
            data = $.parseJSON(data);
            $('#com'+data.id).remove();
        })
    }
    @if($moder)
    function approveComment(comId) {
        $.get('/comments/approveComment', {commentId: comId}, function(data) {
            data = $.parseJSON(data);
            $('#approve'+data.id).remove();
        })
    }
    @endif
</script>
@endif