@layout('index')

@section('content')
<link href="/css/articles.css" rel="stylesheet" media="screen">

<!-- Подключаем CKEditor -->
<script src="/ckeditor/ckeditor.js"></script>

<div class="pull-left">
<h2>Статьи</h2>
</div>

<div class="pull-right">
<a href="" class="btn btn-success" onClick="showAddArticleForm(); return false;">
    <i class="icon icon-white icon-plus"></i> Добавить статью
</a>
</div>

<div style="clear: both;"></div>

<!-- Хлебные крошки -->
@render('articles.breadcrumbs', array('breadcrumbs' => $breadcrumbs))

<!-- Список категорий их редактирование и удаление -->
<div id="listCategories">
    @if(!$articles)
        @render('articles.tree', array('tree' => $tree))
    @endif
</div>

<!-- Список статей в заданной категории, показывается при сохранении статьи -->
<div id="listArticles">
    @if($articles)
        @render('articles.list_articles', array('articles' => $articles, 'pages' => $pages, 'page' => $page))
    @endif
</div>


<!-- Модальное окно для добавления новой статьи -->
<div id="addArticle" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Добавить статью</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" onSubmit="insertArticle(); return false;" id="addCategoryForm">
            <!-- Категория -->
            <div class="control-group">
                <label class="control-label" for="inputCategory">Категория:</label>
                <div class="controls">
                    <select id="inputCategory" class="span12">
                        <option value="0">Выберите категорию</option>
                            @render('articles.tree_select', array('tree' => $tree))
                    </select>
                </div>
            </div>

            <!-- Заголовок -->
            <div class="control-group">
                <label class="control-label" for="inputHeader">Заголовок:</label>
                <div class="controls">
                        <input type="text" id="inputHeader" name="inputHeader" placeholder="Заголовок статьи (<h1>)" class="span12">
                </div>
            </div>

            <!-- Title -->
            <div class="control-group">
                <label class="control-label" for="inputTitle">Title:</label>
                <div class="controls">
                    <input type="text" id="inputTitle" name="inputTitle" placeholder="Title статьи (<title>)" class="span12">
                </div>
            </div>

            <!-- Описание -->
            <div class="control-group">
                <label class="control-label" for="inputDescription">Описание:</label>
                <div class="controls">
                    <input type="text" id="inputDescription" name="inputDescription" placeholder="Описание (<description>)" class="span12">
                </div>
            </div>

            <!-- Контент -->
            <div class="control-group">
                <label class="control-label" for="inputContent">Контент:</label>
                <div class="controls">
                    <textarea name="inputContent" id="inputContent" placeholder="Контент"></textarea>
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


<script type="text/javascript">
    //--------------------------------------------------------------------------------------------------
    // Подключаем CKEeditor
    //--------------------------------------------------------------------------------------------------
    CKEDITOR.replace( 'inputContent' );

    //--------------------------------------------------------------------------------------------------
    // Показывает окно добавления статьи
    //--------------------------------------------------------------------------------------------------
    function showAddArticleForm() {
        resetForm();
        $('#addArticle').modal('show');
    }

    //--------------------------------------------------------------------------------------------------
    // Забирает AJAX'ом статьи в заданной категории и показывает их
    //--------------------------------------------------------------------------------------------------
    function showArticlesInCategory(idCategory) {
        $.get('/articles/' + idCategory, {idCategory: idCategory}, function (data) {
            $('#listCategories').hide('300');
            $('#listArticles').html(data);

        });
    }

    //--------------------------------------------------------------------------------------------------
    // Сохраняет в базу новую статью
    //--------------------------------------------------------------------------------------------------
    function insertArticle() {
        var idCategory = $('#inputCategory').val();
        var header = $('#inputHeader').val();
        var title = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var content = CKEDITOR.instances.inputContent.getData();

        if(header == '') {
            alert('Поле заголовок статьи обязательно для заполнения');
            return false;
        }

        $.post('/articles/insertArticle', { idCategory: idCategory, header: header, title:title, description: description, content: content }, function (data) {
            showArticlesInCategory(idCategory);
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
            CKEDITOR.instances.inputContent.setData(data.content);
            $('#saveButton').removeAttr('onClick').attr('onClick', 'updateArticle(' + id +  ')');


            $('#addArticle').modal('show');
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Обновление статьи
    //--------------------------------------------------------------------------------------------------
    function updateArticle(id) {
        if(id == '') return false;

        var idCategory = $('#inputCategory').val();
        var header = $('#inputHeader').val();
        var title = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var content = CKEDITOR.instances.inputContent.getData();

        $.post('/articles/updateArticle', { idCategory: idCategory, header: header, title: title, description: description, content: content, idArticle: id }, function (data) {
            showArticlesInCategory(idCategory);
            $('#addArticle').modal('hide');
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление статьи
    //--------------------------------------------------------------------------------------------------
    function deleteArticle(id, idCategory) {
        if(id == '') return false;
        if (confirm('вы действительно хотите удалить статью?')) {
        $.post('/articles/deleteArticle', {idArticle: id}, function (data) {
            showArticlesInCategory(idCategory);
        })}
    }

    //--------------------------------------------------------------------------------------------------
    // Очишает форму
    //--------------------------------------------------------------------------------------------------
    function resetForm() {
        $('#inputCategory').val('');
        $('#inputHeader').val('');
        $('#inputTitle').val('');
        $('#inputDescription').val('');
        $('#idArticle').val('');
        CKEDITOR.instances.inputContent.setData('');
        $('#saveButton').removeAttr('onClick').attr('onClick', 'insertArticle(); return false;');

        return true;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Смена страниц
    //----------------------------------------------------------------------------------------------------------------------
    function changePage(pageNo) {
        if(pageNo == '') return false;
        $.get('/articles/{{ $idCategory }}', {page: pageNo}, function (data) {
            $('#listArticles').html(data);
        })
    }

</script>
@endsection