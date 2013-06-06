@layout('index')


@section('content')
<link href="/css/categories.css" rel="stylesheet" media="screen">
<div class="pull-left"><h2>Категории</h2></div>

<!-- Добавление новой категории -->
<div class="pull-right">
<a href="#addCategory" class="btn btn-success" onclick="showAddCategory(); return false;">
	<i class="icon icon-white icon-plus"></i> Добавить категорию
</a>
</div>

<div style="clear: both;"></div>

<!-- Модальное окно для добавления новой категории -->
<div id="addCategory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Доабвить категорию</h3>
  </div>
  <div class="modal-body">
		<form class="form-horizontal" onSubmit="addCategory(); return false;" id="addCategoryForm">
		  <div class="control-group">
		    <label class="control-label" for="inputCategory">Категория:</label>
		    <div class="controls">
		      <input type="text" id="inputCategory" placeholder="Категория">
              <input type="hidden" id="idCategory">
              <input type="hidden" id="idParent">
		    </div>
		  </div>
		</form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger pull-left" style="display: none;" id="buttonDeleteCategory"><i class="icon icon-trash icon-white"></i> Удалить категорию</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
    <button class="btn btn-primary" onClick="addCategory(); return false;" id="buttonSaveCategory">Сохранить</button>
  </div>
</div>


<!-- Список категорий их редактирование и удаление -->
<div id="listCategories">
    @render('categories.tree', array('tree' => $tree))
</div>


<!-- Реализация AJAX запросов --> 
<script type="text/javascript">
    //--------------------------------------------------------------------------------------------------
    // Показывает окно для добавления новой категории
    //--------------------------------------------------------------------------------------------------
    function showAddCategory() {
        clearCategoryForm();

        $('#addCategory').modal('show');
    }

    //--------------------------------------------------------------------------------------------------
    // Очищает форму работы с категориями
    //--------------------------------------------------------------------------------------------------
    function clearCategoryForm() {
        $('#inputCategory').val('');
        $('#idCategory').val('');
        $('#idParent').val('');
        $('#buttonDeleteCategory').attr('style', 'display:none;');
        $('#buttonSaveCategory').removeAttr('onClick').attr('onClick', 'addCategory();');
        $('#addCategoryForm').removeAttr('onSubmit').attr('onSubmit', 'addCategory();');
    }

    //--------------------------------------------------------------------------------------------------
    // AJAX запрос на добавление новой категории
    //--------------------------------------------------------------------------------------------------
    function addCategory () {
        var nameCategory = $('#inputCategory').val();
        var parentId = $('#inputParentId').val();

        $.post("/categories/addCategory", {nameCategory: nameCategory, parentId: parentId}).done(function(data) {
            $('#addCategory').modal('hide');
            refreshTree();
        });
    }

    //--------------------------------------------------------------------------------------------------
    // AJAX запрос на обновление категории
    //--------------------------------------------------------------------------------------------------
    function updateCategory(idCategory) {
        if(idCategory == null || idCategory == '') {
            alert('Не передан идентификатор категории');
            return false;
        }

        var nameCategory = $('#inputCategory').val();

        $.post("/categories/updateCategory/", {nameCategory: nameCategory, idCategory: idCategory}).done(function(data) {
            $('#addCategory').modal('hide');
            refreshTree();
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Показывает окно для редактирования категории
    //--------------------------------------------------------------------------------------------------
    function showEditCategory(idCategory) {
        if(idCategory == null || idCategory == '') {
            alert('Не передан идентификатор категории');
            return false;
        }

        // Делаем запрос, узнаем информацию о категории
        $.post("/categories/getCategoryJson", {idCategory: idCategory}).done(function(data) {
            var category = JSON.parse(data);

            // Устанавливаем значения в форму с модальным окном
            $('#inputCategory').val(category.name_category);
            $('#idCategory').val(category.id);

            // Изменяем кнопки
            $('#buttonDeleteCategory').removeAttr('style');
            $('#buttonDeleteCategory').removeAttr('onClick').attr('onClick', 'deleteCategory(' + idCategory + ');')
            $('#buttonSaveCategory').removeAttr('onClick').attr('onClick', 'updateCategory(' + idCategory + ');');
            $('#addCategoryForm').removeAttr('onSubmit').attr('onSubmit', 'updateCategory(' + idCategory + ');');

            // Показываем модальное окно
            $('#addCategory').modal('show');
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Обновляет дерево категорий
    //--------------------------------------------------------------------------------------------------
    function refreshTree() {
        $.post("/categories/buildCategoriesTree/").done(function(data){
            $('#listCategories').html(data);
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление категории
    //--------------------------------------------------------------------------------------------------
    function deleteCategory(idCategory) {
        if(idCategory == null || idCategory == '') {
            alert('Не передан идентификатор категории');
            return false;
        }

        if(window.confirm('Вы действительно хотите удалить категорию?')) {
            $.post("/categories/deleteCategory/", {idCategory: idCategory}).done(function(data){
                $('#addCategory').modal('hide');
                refreshTree();
            });
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Форма для добавления подкатегории
    //--------------------------------------------------------------------------------------------------
    function showAddSubcategoryForm(idParent) {
        if(idParent == null || idParent == '') {
            alert('Не передан идентификатор родительской категоии');
            return false;
        }

        clearCategoryForm();
        $('#idParent').val(idParent);
        $('#buttonSaveCategory').removeAttr('onClick').attr('onClick', 'addSubCategory(' + idParent + ');');
        $('#addCategoryForm').removeAttr('onSubmit').attr('onSubmit', 'addSubCategory(' + idParent + ');');
        $('#addCategory').modal('show');
    }


    //--------------------------------------------------------------------------------------------------
    // Добавить подкатегорию
    //--------------------------------------------------------------------------------------------------
    function addSubCategory(idParent) {
        if(idParent == null || idParent == '') {
            alert('Не передан идентификатор родительской категоии');
            return false;
        }

        var nameCategory = $('#inputCategory').val();

        $.post("/categories/addCategory/", {nameCategory: nameCategory, idParent: idParent}).done(function(data) {
            $('#addCategory').modal('hide');
            refreshTree();
        });
    }
</script>

@endsection