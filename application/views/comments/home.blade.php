
<style>
    .comment-text {
        margin: 10px
    }
    .comment {
        margin: 50px 0 0px 0;
    }
</style>

<form id="addComments" name='addComments'>
    <!-- Name -->
    <div class="control-group">
        <label class="control-label" for="inputName">Имя: </label>
        <div class="controls">
            <input type="text" id="inputName" name="name" ">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail">E-mail: </label>
        <div class="controls">
            <input type="text" id="inputEmail" name="email">
        </div>
    </div>
    <!-- Text -->
    <div class="control-group">
        <label class="control-label" for="inputText">Текст:</label>
        <div class="controls">
            <textarea name="text" id="inputText" name="inputText" ></textarea>
        </div>
    </div>
    <!-- Captcha -->
    <div class="control-group">
        <label class="control-label" for="inputCaptcha">Введите буквы с картинки:</label>
        <img style='margin:10px' id='imgCaptcha' src='http://{{$_SERVER["HTTP_HOST"]}}/captcha'>
        <a href='#' onClick='$("#imgCaptcha").attr("src", $("#imgCaptcha").attr("src") +"?"+ Math.random()); return false;'>Обновить</a>
        <div class="controls">
            <input type="text" id="inputCaptcha" name="email">
        </div>
    </div>
    <input type='hidden' name='artId' id='artId' value='{{ $artId }}'>
    <br>
    <input type='button' value='Отправить' onClick="addComment()" class="btn btn-primary">
</form>
<div id="comments">
    @foreach($comments as $comment)
        <div class="comment" id='com{{$comment['id']}}'>
            @if($admin)
                <div type="button" onClick="removeComment({{$comment['id']}});" class="close" data-dismiss="modal" aria-hidden="true">×</div>
            @endif
            <div class="comment-name"><b>Имя:</b> {{$comment['name']}}</div>
            <div class="comment-email"><b>E-mail:</b> {{$comment['email']}}</div>
            <div class="comment-text">{{$comment['text']}}</div>
        </div>
    @endforeach
</div>

<script>
    //--------------------------------------------------------------------------------------------------
    // Добавление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    function addComment() {
        var comName = $('#inputName').val();
        var comEmail = $('#inputEmail').val();
        var artId = $('#artId').val();
        var comText = $('#inputText').val();
        var comCaptcha = $('#inputCaptcha').val();
        if(!comName || !comName || !comText || !comCaptcha) {
            alert('Заполните все поля');
        }
        $.get('/comments/addComment',{name: comName, email: comEmail, text: comText, artId: artId, captcha: comCaptcha}, function(data) {
            data = $.parseJSON(data);
            if(!data.captcha) {
                alert('Не правильные символы с картинки');
                $("#imgCaptcha").attr("src", $("#imgCaptcha").attr("src") +"?"+ Math.random());
                return false;
            }

            var comment = $('<div class="comment" id="com'+data.id+'">');
            comment.append('<div class="comment-name"><b>Имя:</b> '+data.name+'</div>');
            comment.append('<div class="comment-email"><b>E-mail:</b> '+data.email+'</div>');
            comment.append('<div class="comment-text">'+data.text+'</div>');
            $('#comments').append(comment);
            $("#imgCaptcha").attr("src", $("#imgCaptcha").attr("src") +"?"+ Math.random());
        });
    }
    //--------------------------------------------------------------------------------------------------
    // Удаление комментария (by Nagovski)
    //--------------------------------------------------------------------------------------------------
    function removeComment(comId) {
        $.get('/comments/removeComment', {commentId: comId}, function(data) {
            data = $.parseJSON(data);
            $('#com'+data.id).remove();
        })
    }
</script>
