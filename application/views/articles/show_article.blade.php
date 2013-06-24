@layout('index')

@section('content') 

<link href="/css/articles.css" rel="stylesheet" media="screen">

<!-- Подключаем CKEditor -->
<script src="/ckeditor/ckeditor.js"></script>

<!-- Заголовки и элементы управления -->
<div class="pull-left">
	<h3>Просмотр статьи</h3>
    <!-- хлебные крошки -->
	@render('articles.breadcrumbs', array('breadcrumbs' => $breadcrumbs))
</div>

<div class="pull-right">
	<p> 
		дата создания: {{ $article_arr['created_at'] }} <br>
		последнее изминение: {{ $article_arr['updated_at'] }}
	</p>
	<p>
		<a onClick="showEditArticleForm({{ $article_arr['id'] }}); return false;" class="btn btn-warning">
			Редактировать
        </a>
		<a onClick="deleteArticle({{ $article_arr['id'] }}, {{ $idCategory }}); return false;" class="btn btn-danger">
			Удалить
		</a>
	</p>
</div>
<div style="clear:both"></div>

<!-- Статья -->
<hr>
<div>
	<h4>{{ $article_arr['header'] }}</h4>
    <div  style='margin: 0 10px 30px 0;'>
        Теги:
        @foreach($article_arr['tags'] as $tag)
        <span class='label'>{{ $tag['title'] }}</span>
        @endforeach
    </div>
    <div style='float:left; margin: 0 10px 10px 0;'><img src="/imgpreview/{{$article_arr['id']}}" border=0 alt=''></div>
    {{ $article_arr['content'] }}
    <div style="clear:both"></div>
{{$commentsView}}


<!-- Модальное окно для редактирования статьи -->
<div id="editArticle" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Редактировать статью</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" id="addArticleForm" method="POST" enctype="multipart/form-data">
            <!-- Категория -->
            <div class="control-group">
                <label class="control-label" for="inputCategory">Категория:</label>
                <div class="controls">
                    <select id="inputCategory" name="idCategory" class="span12">
                        <option value="0">Выберите категорию</option>
                            @render('articles.tree_select', array('tree' => $tree))
                    </select>
                </div>
            </div>

            <!-- Заголовок -->
            <div class="control-group">
                <label class="control-label" for="inputHeader">Заголовок:</label>
                <div class="controls">
                        <input type="text" id="inputHeader" name="header" placeholder="Заголовок статьи (<h1>)" class="span12">
                </div>
            </div>

            <!-- Теги -->
            <div class="control-group">
                <label class="control-label" for="inputHeader">Теги:</label>
                <div class="controls">
                    <div id='oldTags'></div>
                    <div id='tags'></div>
                    <button class="btn" onClick='addTagInput(); return false;'>Добавить тег</button>
                </div>
            </div>

            <!-- Title -->
            <div class="control-group">
                <label class="control-label" for="inputTitle">Title:</label>
                <div class="controls">
                    <input type="text" id="inputTitle" name="title" placeholder="Title статьи (<title>)" class="span12">
                </div>
            </div>

            <!-- Описание -->
            <div class="control-group">
                <label class="control-label" for="inputDescription">Описание:</label>
                <div class="controls">
                    <input type="text" id="inputDescription" name="description" placeholder="Описание (<description>)" class="span12">
                </div>
            </div>

            <!-- Фото превью -->
            <div class="control-group">
                <label class="control-label" for="inputDescription">Превью:</label>
                <div class="controls">
                    <input type="file" id="inputImgPreview" name="imgPreview" class="span12">
                </div>
            </div>

            <!-- Контент -->
            <div class="control-group">
                <label class="control-label" for="inputContent">Контент:</label>
                <div class="controls">
                    <textarea name="content" id="inputContent" placeholder="Контент"></textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <input type="hidden" id="idArticle">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
        <button class="btn btn-primary" onClick="insertArticle(); return false;" id="saveButton">Сохранить</button>
    </div>
</div>

<!-- Скрипты -->
<script type="text/javascript">
	
	//--------------------------------------------------------------------------------------------------
    // Подключаем CKEeditor
    //--------------------------------------------------------------------------------------------------
    CKEDITOR.replace( 'inputContent' );

    var tags = 0;
    function addTagInput() {

        if(!tags){
            $num = 1;
            tags++;
        } else {
            $num = tags + 1;
            tags++;
        }

        $('#tags').append('<input type="text" class="tags" name="tag['+$num+']" class="span12">');
        return false;
    }

	//--------------------------------------------------------------------------------------------------
    // Очишает форму
    //--------------------------------------------------------------------------------------------------
    function resetForm() {
        tags = 0
        $('#tags').html('');
        $('#oldTags').html('');
        $('#inputCategory').val('');
        $('#inputHeader').val('');
        $('#inputTitle').val('');
        $('#inputDescription').val('');
        $('#idArticle').val('');
        CKEDITOR.instances.inputContent.setData('');
        $('#saveButton').removeAttr('onClick').attr('onClick', 'insertArticle(); return false;');

        return true;
    }

	//--------------------------------------------------------------------------------------------------
    // Показывает окно редактирования статьи
    //--------------------------------------------------------------------------------------------------
    function showEditArticleForm() {
        resetForm();
        $('#editArticle').modal('show');
    }

	//--------------------------------------------------------------------------------------------------
    // Обновление статьи
    //--------------------------------------------------------------------------------------------------
    function updateArticle(id) {
        if(id == '') return false;

        $('#addArticleForm').attr('action', '/articles/updateArticle');
        $('#addArticleForm').prepend('<input type="hidden" name="idArticle" value="'+id+'">');
        $('#addArticleForm').submit();
        return true;

        var idCategory = $('#inputCategory').val();
        var header = $('#inputHeader').val();
        var title = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var content = CKEDITOR.instances.inputContent.getData();

        $.post('/articles/updateArticle', { idCategory: idCategory, header: header, title: title, description: description, content: content, idArticle: id }, function (data) {
            location.reload();
            $('#addArticle').modal('hide');
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Показывает окно для редактирования статьи
    //--------------------------------------------------------------------------------------------------
    function showEditArticleForm(id) {
        resetForm();
        $.post('/articles/getArticleJson', {idArticle: id}, function (data) {
            data = $.parseJSON(data);
            console.debug(data);

            $('#inputCategory').val(data.id_category);
            $('#inputHeader').val(data.header);
            $('#inputTitle').val(data.title);
            $('#inputDescription').val(data.description);

            if(data.tags.length) {
                var i = 0;
                while(data.tags[i]) {
                    var tag = data.tags[i];
                    $('#oldTags').append('<span class="btn" id="remTag'+tag.id+'" onClick="removeTag('+tag.id+',' + data.id + ')">удалить ' + tag.title + ' </span> ');
                    ++i;
                }
                i = 0;
            }

            CKEDITOR.instances.inputContent.setData(data.content);
            $('#saveButton').removeAttr('onClick').attr('onClick', 'updateArticle(' + id +  ')');


            $('#editArticle').modal('show');
        });
    }

    function removeTag(tagId, articleId) {
        $.get('/articles/removeTagFromArticle', {tagId: tagId, articleId: articleId}, function (data) {
            data = $.parseJSON(data);
            $('#remTag'+data.tagId).remove();
        })
    }

 	//--------------------------------------------------------------------------------------------------
    // Удаление статьи
    //--------------------------------------------------------------------------------------------------
    function deleteArticle(id, idCategory) {
        if(id == '') return false;
        if (confirm('вы действительно хотите удалить статью?')) {
        $.post('/articles/deleteArticle', {idArticle: id}, function (data) {
            document.location.href = 'http://cms/articles/' + idCategory; //А может как-нить проще??
        })}
    }



</script>

@endsection
