@layout('index')

@section('content')
<link href="/css/catalog.css" rel="stylesheet" media="screen">
<div class="pull-left"><h2>Каталог</h2></div>

<!-- Добавление новой категории -->
<div class="pull-right">
<a href="#" class="btn btn-success" onclick="showAddCategoryForm(); return false;">
	<i class="icon icon-white icon-plus"></i> Добавить категорию
</a>
<a href="#" class="btn btn-success" onclick="showAddProductForm(); return false;">
	<i class="icon icon-white icon-plus"></i> Добавить продукт
</a>
</div>

<div style="clear: both;"></div>
<hr>
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
		<form class="form-horizontal" action="/catalog/addProduct" method="post" id="addProductForm" enctype="multipart/form-data">
			<div class="span5">
			  <div class="control-group">
			    <label class="control-label" for="name">Название продукта:</label>
			    <div class="controls">
			      <input type="text" id="name" name="productName" placeholder="Название продукта" class="span12">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="title">title:</label>
			    <div class="controls">
			      <input type="text" id="title" name="productTitle" placeholder="title" class="span12">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="title">description:</label>
			    <div class="controls">
			      <textarea id="description" name="productDescription" placeholder="description" class="span12"></textarea>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="content">Описание:</label>
			    <div class="controls">
			      <input type="text" id="content" name="productContent" placeholder="content" class="span12">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="content">Цена:</label>
			    <div class="controls">
			      <input type="text" id="price" name="productPrice" placeholder="price" class="span12">
			    </div>
			  </div>
			</div>
			<div class="span1"></div>
			<div class="span6">
				<div style="float:left; min-height:110px; border: 2px" id="productImagePrew"></div>
				<div style="clear:both"></div><hr>
				<div class="control-group">
				    <label class="control-label" for="image">Добавить изображение:</label>
				    <div class="controls">
				      <input type="file" id="image" name="inputFile" placeholder="Добавить изображение" class="span12">
				    </div>
			    </div>
			</div>
			<hr width="100%">
			<a href="#" onclick="newOptionForm();" class="btn btn-success">
				<i class="icon icon-white icon-tag"></i>
				Добавить характеристики продукта
			</a>
			<div id="productOptionsBlock"></div>
			<input type="hidden" id="allOptions" name="allOptions">
			<input type="hidden" id="idProductCategory" name="idProductCategory" value="{{ $categories[0]['id'] }}">
			<input type="hidden" id="idProductForm" name="idProductForm">
		</form>
	</div>
  </div>
  <div class="modal-footer">
    <!-- (Пожалуй лишняя) button class="btn btn-danger pull-left" style="display: none;" id="buttonDeleteProduct()"><i class="icon icon-trash icon-white"></i> Удалить категорию</button -->
    <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
    <button class="btn btn-primary" onClick="addProduct(); return false;" id="buttonSaveProduct">Сохранить</button>
  </div>
</div>

<div>
<!-- div style="float:left" -->
  <div class="row-fluid">
    <div class="span3" id="sidebarBlock">
      <!--Sidebar content-->
      <div id="listCategories">
        @render('catalog.tree', array('categories' => $categories))
  	  </div>
    </div>
    <div class="span9" style="float:right">
      <h2 id="catalogName">{{ $categories[0]['name_category']; }}</h2>
      <div id="products">
      @if($firstCat)
      	@render('catalog.list_products', array('products' => $firstCat['products'], 'pages' => $firstCat['pages'], 'page' => $firstCat['page']))
      @else
      	<h3>Категория пуста</h3>
      @endif

      <!-- $catalog; -->
      <!-- крошки ?!? -->
      <!--Body content-->
      <!-- список товаров / конкретный товар -->
	  </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	var optionNum = 0;
	// Категории ---------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------------------
	// Выводит поле для ввода дополнительной характеристики продукта
	//--------------------------------------------------------------------------------------------------
	function newOptionForm() {
		$('#productOptionsBlock').append('<div class="optionProduct" style="margin: 5px;">'+
										 '<input type="text" id="optionName'+optionNum+'" name="option['+optionNum+'][name]" placeholder="Название опции" class="span4">'+
										 '&nbsp;<input type="text" id="optionValue'+optionNum+'" name="option['+optionNum+'][value]" placeholder="Значение" class="span7">'+
										 '&nbsp;<a href="" onClick="" class="btn btn-success">'+
										 '<input type="hidden" id="optionId'+optionNum+'" name="option['+optionNum+'][id]" value="false">'+
										 '<i class="icon icon-white icon-ok"></i></a></div>');
		optionNum++;
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

    //----------------------------------------------------------------------------------------------------------------------
    // Показать продукты в категории
    //----------------------------------------------------------------------------------------------------------------------
    function showCategoryContent(idCategory, nameCategory){
    	$('#idProductCategory').val(idCategory);
    	$('#catalogName').html(nameCategory);
    	$('#products').html('');

    	$.post("/catalog/getAllProduct", { idCategory: idCategory}).done(function(data){
    		if (data)
    			$('#products').html(data);
    		else
    			$('#products').html('<h3>Категория пуста</h3>');
    	});
    		
    	return false;
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

	//----------------------------------------------------------------------------------------------------------------------
    // Смена страниц
    //----------------------------------------------------------------------------------------------------------------------
    function changePage(pageNo) {
        if(pageNo == '') return false;
        var idCategory = $('#idProductCategory').val();
        $.post("/catalog/getAllProduct", { pageNo: pageNo, idCategory: idCategory }).done(function(data){
    		$('#products').html(data);
    	});
    }

    // Продукты ----------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------------------
	// Показыает окно добавления продукта
	//--------------------------------------------------------------------------------------------------
	function showAddProductForm() {
		if ($('#idProductCategory').val() == 'false'){
			window.alert('Не выбран каталог, пожалуйста укажите каталог в меню слева');
		} else {
			cleatProductForm();
			$('#addProduct').modal('show');
		}
	}

	//--------------------------------------------------------------------------------------------------
	// Показывает окно для редактирования продукта
	//--------------------------------------------------------------------------------------------------
	function showEditProductForm(idProduct) {
		cleatProductForm();
		$.post("/catalog/getProduct", { idProduct: idProduct }).done(function(data){
				data = $.parseJSON(data);
	    		console.debug(data);
				$('#name').val(data.name);
				$('#title').val(data.title);
				$('#description').val(data.description);
				$('#content').val(data.content);
				$('#price').val(data.price);
				$('#addProduct').modal('show');
				$('#idProductForm').val(idProduct);

				if(data.previewPath != 'default') {
					$('#productImagePrew').html(
					'<img src="'+ data.previewPath +'">'+
					'<button onclick="deleteImage('+data.previewId+', '+idProduct+')" type="button" class="close" >×</button>'
					);
				} else {
					$('#productImagePrew').html('Картинка отсутствует');
				}


				var i=0;
				while(data.options[i]) {

					var option = data.options[i];
					

					$('#productOptionsBlock').append(
						'<div class="optionProduct" style="margin: 5px;">'+
						'<input type="text" id="optionName'+i+'"'+
						' name="option['+i+'][name]" placeholder="Название опции" class="span4">'+
						'&nbsp;<input type="text" id="optionValue'+i+'"'+
						' name="option['+i+'][value]" placeholder="Значение" class="span7">'+
						'<input type="hidden" id="optionId'+i+'" name="option['+i+'][id]">'+
						'&nbsp;<a href="#" onClick="deleteOption('+option.id+', '+i+')" id="delOption'+i+'" class="btn btn-danger">'+
						'<i class="icon icon-remove"></i></a></div>');

					$('#optionName'+i).val(option.name);
					$('#optionValue'+i).val(option.value);
					$('#optionId'+i).val(option.id);
					i++;
					optionNum++;
				}

	            // Изменяем кнопки
	       
	            $('#addProductForm').attr('action', ''); //'/catalog/updateProductOption');
	            //$('#buttonSaveProduct').removeAttr('onClick').attr('onClick', 'editProduct(' + idProduct + ');');
	            $('#buttonSaveProduct').html('Изменить');
	    	});
	}

	//--------------------------------------------------------------------------------------------------
	// Получает информация для редактирования продукта
	//--------------------------------------------------------------------------------------------------
	function getProduct(idProduct) {

	}

	//--------------------------------------------------------------------------------------------------
	// Добавление нового продукта // будут проблемы с загрузкой картинок...
	//--------------------------------------------------------------------------------------------------
	function addProduct() {
		$('#addProductForm').submit();
	}

	//----------------------------------------------------------------------------------------------------------------------
	// Удаление продукта
	//----------------------------------------------------------------------------------------------------------------------
	function deleteProduct(idProduct) {
		if(window.confirm('Вы действительно хотите удалить продукт?')) {
			$.post("/catalog/deleteProduct", { idProduct: idProduct }).done(function(data){
	    		$('#products').html(data);
	    	});
		}
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
	function deleteImage(idImage, idProduct) {
		if(window.confirm('Вы действительно хотите удалить изображение продукта?')) {
			$.post("/catalog/deleteImage", { idImage: idImage, idProduct: idProduct }).done(function(data){
	    		$('#productImagePrew').html('');
	    	});
		}
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
	// Удалить опцию продукта
	//--------------------------------------------------------------------------------------------------
	function deleteOption(idOption, idField) {
		if(window.confirm('Вы действительно хотите удалить параметр данного продукта?')) {
			$.post("/catalog/removeProductOption", { idOption: idOption }).done(function(data){
	    		$('#optionName'+idField).remove();
				$('#optionValue'+idField).remove();
				$('#delOption'+idField).remove();
				$('#optionId'+idField).remove();
				$('#addProduct').modal('show');
	    	});
	    	return false;
		}

	}

	//--------------------------------------------------------------------------------------------------
	// Сброс формы добавления товара
	//--------------------------------------------------------------------------------------------------
	function cleatProductForm() {
		$('#image').val('');
		$('#name').val('');
		$('#title').val('');
		$('#description').val('');
		$('#content').val('');
		$('#price').val('');
		$('#productImagePrew').html('');
		$('#productOptionsBlock').html('');
		$('#addProductForm').attr('action', '/catalog/addProduct');
	    $('#buttonSaveProduct').html('Сохранить');

	    var optionNum = 0;
	}
	
	

</script>

@endsection