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
<div id="addCategory" class="modal hide fade span4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <div class="span2" id="sidebarBlock">
      <!--Sidebar content-->
      @render('catalog.tree', array('categories' => $categories))
    </div>
    <div class="span10">
      <!--Body content-->
      b
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
	// Получает данные для редактирования категории
	//--------------------------------------------------------------------------------------------------
	function getCategory(idCategory) {

	}

	//--------------------------------------------------------------------------------------------------
	// Обновить список категорий
	//--------------------------------------------------------------------------------------------------
	function refreshCategories() {

	}

	//--------------------------------------------------------------------------------------------------
	// Показывает окно для редактрования формы
	//--------------------------------------------------------------------------------------------------
	function showEditCategoryForm(idCategory) {

	}
	
	//--------------------------------------------------------------------------------------------------
	// Добавление новой категории
	//--------------------------------------------------------------------------------------------------
	function addCategory() {
		var idParent = $('#idParent').val();
		var categoryName = $('#inputCategory').val();
		$.post('/catalog/addCategory', {idParent: idParent, categoryName: categoryName}).done(function (data){
			$('#addCategory').modal('hide');
			refreshCategories();
		});
	}

	//--------------------------------------------------------------------------------------------------
	// Обновление категории
	//--------------------------------------------------------------------------------------------------
	function editCategory(idCategory) {

	}

	//--------------------------------------------------------------------------------------------------
	// Удаление категории
	//--------------------------------------------------------------------------------------------------
	function removeCategory(idCategory) {

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