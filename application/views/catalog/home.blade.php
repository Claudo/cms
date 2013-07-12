@layout('index')

@section('content')
<link href="/css/catalog.css" rel="stylesheet" media="screen">
<div class="pull-left"><h2>Каталог</h2></div>

<!-- Добавление новой категории -->
<div class="pull-right">
<a href="#addCategory" class="btn btn-success" onclick="showAddCategoryForm(); return false;">
	<i class="icon icon-white icon-plus"></i> Добавить категорию
</a>
<a href="#addCategory" class="btn btn-success" onclick="showAddProductForm(); return false;">
	<i class="icon icon-white icon-plus"></i> Добавить продукт
</a>
</div>

<div style="clear: both;"></div>

<!-- Модальное окно для добавления новой категории -->
<div id="addCategory" class="modal hide fade span4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:500px">
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
              <input type="hidden" id="unit" value="2">
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

<!-- Модальное окно для добавления нового продукта -->
<div id="addProduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Доабвить продукт</h3>
  </div>
  <div class="modal-body">
  	<div class="row-fluid">
		<form class="form-horizontal" onSubmit="addProduct(); return false;" id="addProductForm">
			<div class="span5">
			  <div class="control-group">
			    <label class="control-label" for="name">Название продукта:</label>
			    <div class="controls">
			      <input type="text" id="name" placeholder="Название продукта" class="span12">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="title">title:</label>
			    <div class="controls">
			      <input type="text" id="title" placeholder="title" class="span12">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="title">description:</label>
			    <div class="controls">
			      <textarea id="description" placeholder="description" class="span12"></textarea>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="content">Описание:</label>
			    <div class="controls">
			      <input type="text" id="content" placeholder="content" class="span12">
			    </div>
			  </div>
			</div>
			<div class="span1"></div>
			<div class="span6">
				<div class="control-group">
				    <label class="control-label" for="image">Добавить изображение:</label>
				    <div class="controls">
				      <input type="file" id="image" placeholder="Добавить изображение" class="span12">
				    </div>
			    </div>
			</div>
			<hr width="100%">
			<a href="#" onclick="newOptionForm();" class="btn btn-success">
				<i class="icon icon-white icon-tag"></i>
				Добавить характеристики продукта
			</a>
			<div id="productOptionsBlock"></div>
		</form>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger pull-left" style="display: none;" id="buttonDeleteCategory"><i class="icon icon-trash icon-white"></i> Удалить категорию</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
    <button class="btn btn-primary" onClick="addCategory(); return false;" id="buttonSaveCategory">Сохранить</button>
  </div>
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4" id="sidebarBlock">
      <!--Sidebar content-->
      <div id="listCategories">
        @render('catalog.tree', array('categories' => $categories))
  	  </div>
    </div>
    <div class="span10">
      <!--Body content-->
      <!-- список товаров / конкретный товар -->
    </div>
  </div>
</div>

<script type="text/javascript">
	//--------------------------------------------------------------------------------------------------
	// Выводит поле для ввода дополнительной характеристики продукта
	//--------------------------------------------------------------------------------------------------
	function newOptionForm() {
		$('#productOptionsBlock').append('<div class="optionProduct" style="margin: 5px;"><input type="text" id="option" placeholder="Название опции" class="span4">&nbsp;<input type="text" id="option" placeholder="Значение" class="span7">&nbsp;<a href="" onClick="" class="btn btn-success"><i class="icon icon-white icon-ok"></i></a></div>');
	}

	//--------------------------------------------------------------------------------------------------
	// Показывает окно добавление категории
	//--------------------------------------------------------------------------------------------------
	function showAddCategoryForm() {
		clearCategoryForm();
		$('#addCategory').modal('show');
	}

	//--------------------------------------------------------------------------------------------------
    // Показывает окно добавления подкатегории
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

        var categoryName 	= $('#inputCategory').val();
        var unit 			= $('#unit').val();

        $.post("/categories/addCategory/", {categoryName: categoryName, idParent: idParent, unit: unit}).done(function(data) {
            $('#addCategory').modal('hide');
            refreshTree();
        });
    }

	//--------------------------------------------------------------------------------------------------
	// Показывает окно для редактрования категории
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
	// Добавление новой категории
	//--------------------------------------------------------------------------------------------------
	function addCategory () {
        var categoryName = $('#inputCategory').val();
        var parentId = $('#idParent').val();
        var unit = $('#inputUnit').val();

        $.post("/catalog/addCategory", {categoryName: categoryName, parentId: parentId, unit: unit}).done(function(data) {
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
    // Обновляет дерево категорий
    //--------------------------------------------------------------------------------------------------
    function refreshTree() {
        $.post("/catalog/buildCategoriesTree/").done(function(data){
            $('#listCategories').html(data);
        });
    }


	//--------------------------------------------------------------------------------------------------
	// Показыает окно добавления продукта
	//--------------------------------------------------------------------------------------------------
	function showAddProductForm() {
		cleatProductForm();
		$('#addProduct').modal('show');
	}

	//--------------------------------------------------------------------------------------------------
	// Показывает окно для редактирования продукта
	//--------------------------------------------------------------------------------------------------
	function showEditProductForm() {

	}

	//--------------------------------------------------------------------------------------------------
	// Получает информация для редактирования продукта
	//--------------------------------------------------------------------------------------------------
	function getProduct(idProduct) {

	}

	//--------------------------------------------------------------------------------------------------
	// Добавление нового продукта
	//--------------------------------------------------------------------------------------------------
	function addProduct() {

	}

	//--------------------------------------------------------------------------------------------------
	// Обновление продукта
	//--------------------------------------------------------------------------------------------------
	function updateProduct(idProduct) {

	}

	//--------------------------------------------------------------------------------------------------
	// Удаление продукта
	//--------------------------------------------------------------------------------------------------
	function removeProduct(idProduct) {

	}

	//--------------------------------------------------------------------------------------------------
	// Добавить изображение продукта
	//--------------------------------------------------------------------------------------------------
	function addImage(idProduct) {

	}

	//--------------------------------------------------------------------------------------------------
	// Удалить изображение продукта
	//--------------------------------------------------------------------------------------------------
	function deleteImage() {

	}

	//--------------------------------------------------------------------------------------------------
	// Добавить опцию продукта
	//--------------------------------------------------------------------------------------------------
	function addOption(idProduct, option, value) {

	}

	//--------------------------------------------------------------------------------------------------
	// Редактировать значение опции продукта
	//--------------------------------------------------------------------------------------------------
	function editOption(idOption) {

	}

	//--------------------------------------------------------------------------------------------------
	// Удалить значение опции продукта
	//--------------------------------------------------------------------------------------------------
	function deleteOptionValue(idProduct, idOption) {

	}

	//--------------------------------------------------------------------------------------------------
	// Удалить опцию продукта
	//--------------------------------------------------------------------------------------------------
	function deleteOption(idProduct, idOption) {

	}

	//--------------------------------------------------------------------------------------------------
	// Сброс формы добавления категории
	//--------------------------------------------------------------------------------------------------
	function clearCategoryForm() {
		$('#inputCategory').val('');
		$('#idParent').val('');
		$('#idCategory').val('');
		$('#buttonDeleteCategory').attr('style', 'display:none;');
        $('#buttonSaveCategory').removeAttr('onClick').attr('onClick', 'addCategory();');
        $('#addCategoryForm').removeAttr('onSubmit').attr('onSubmit', 'addCategory();');
	}

	//--------------------------------------------------------------------------------------------------
	// Сброс формы добавления товара
	//--------------------------------------------------------------------------------------------------
	function cleatProductForm() {
		$('#name').val('');
		$('#title').val('');
		$('#description').val('');
		$('#content').val('');
	}
	
	

</script>

@endsection