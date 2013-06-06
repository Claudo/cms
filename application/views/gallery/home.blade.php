@layout('index')
<!-- Временно (убрать в общий css) -->
<style type="text/css">
.album_cover {
	position: relative;
    border-radius: 15px;
	border: 1px solid #DDDDDD;
	width: 170px;
	
	margin: 30px;
	float: left;
	text-align: center;
	word-wrap: break-word;
	padding: 5px 5px 0 5px;
}

.image_block {
        position: relative;
        border: 1px solid #DDDDDD;
        height: 170px; 
        width: 150px;   
        margin: 30px;
        float: left;
        text-align: center;
        word-wrap: break-word;
        padding: 5px 5px 0 5px;
    }
</style>

@section('content')

<!-- шапка. название, элементы управления -->
<div class="pull-left">
<h2>Галерея</h2>
</div>

<div class="pull-right">
<a href="#add_album_modal" role="button" class="btn btn-success" data-toggle="modal">
    <i class="icon icon-white icon-plus"></i>
    Добавить альбом
</a></div><br><br>
<div class="pull-right">
<a href="#add_images_modal" role="button" class="btn btn-success" data-toggle="modal">
    <i class="icon icon-white icon-plus"></i>
    Добавить изображение
</a>
</div>
<div style="clear:both"></div>
<hr>
<!-- / -->

<!-- Контент -->

<!-- Альбомы -->
<div id="listAlbums">
<div class="row">
	@render ('gallery.list_albums', array('albums' => $albums))
</div>
</div>
<!-- // -->

<!-- // -->

<!-- Модальное окно, добавления нового альбома -->
<div id="add_album_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Добавить альбом</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" onsubmit="return: false;">
            <div class="control-group">
                <label class="control-label" for="inputName">Название альбома: </label>
                <div class="controls">
                    <input type="text" id="inputName" class="span12" placeholder="Название альбома">
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label" for="inputTitle">Title альбома: </label>
                <div class="controls">
                    <input type="text" id="inputTitle" class="span12" placeholder="Title альбома">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputHeader">H1 альбома: </label>
                <div class="controls">
                    <input type="text" id="inputHeader" class="span12" placeholder="H1 альбома">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Description альбома: </label>
                <div class="controls">
                    <textarea id="inputDescription" class="span12" placeholder="Description альбома"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputContent">Описание альбома: </label>
                <div class="controls">
                    <textarea id="inputContent" rows="4" class="span12" placeholder="Описание альбома(видно пользователю)"></textarea>
                </div>
            </div>
            <input type="hidden" id="id_album" value="">            
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="buttonCancel">Отмена</button>
        <button class="btn btn-primary" id="buttonSave" onClick="add_album();">Сохранить</button>
    </div>
</div>
<!-- // -->

<!-- Модальное окно добавления новой картинки -->
<div id="add_images_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Добавить изображение</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" method="POST" action="/gallery/" id="upload_image" name="upload_image" enctype="multipart/form-data">
            <div class="control-group">
                <label class="control-label" for="inputName">Альбом: </label>
                <div class="controls">
                    <select id="inputAlbumId" name="inputAlbumId" class="span12" placeholder="Выберите альбом">
                        <!--option value="0">Выберите альбом</option-->
                            @render('gallery.albums_tree', array('albums' => $albums));
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputName">Имя изображения: </label>
                <div class="controls">
                    <input type="text" id="inputName" name="inputName" class="span12" placeholder="Имя изображения">
                </div>
            </div>
            <div class="control-group" id="inputFile">
                <label class="control-label" for="inputName">Файл: </label>
                <div class="controls">
                    <input type="file"  name="inputFile">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputTitle">Title: </label>
                <div class="controls">
                    <input type="text" id="inputTitle" name="inputTitle" class="span12" placeholder="Title">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputHeader">H1: </label>
                <div class="controls">
                    <input type="text" id="inputHeader" name="inputHeader" class="span12" placeholder="H1">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDescription">Description: </label>
                <div class="controls">
                    <textarea id="inputDescription" name="inputDescription" class="span12" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputContent">Описание изображения: </label>
                <div class="controls">
                    <textarea id="inputContent" name="inputContent" rows="4" class="span12" placeholder="Описание изображения(видно пользователю)"></textarea>
                </div>
            </div>
            <div class="control-group" style="display: none;" id="cover_block">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" id="cover"> Обложка альбома
                    </label>
                </div>
            </div>
            <input type="hidden" id="id_album" name="id_album" value="">            
            <input type="hidden" id="id_image" name="id_image" value="">            
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="buttonCancel">Отмена</button>
        <button class="btn btn-primary" id="buttonSave" onclick="upload_image.submit();">Сохранить</button>
    </div>
</div>
<!-- // -->

<script type="text/javascript">

	// АЛЬБОМЫ -----------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------
    // Добавление нового альбома
    //--------------------------------------------------------------------------------------------------
    function add_album() {
        var album_name  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();

        if(album_name == '' || album_name == null){ 
        	alert('Незаполнено имя альбома');
        	return false;
        }

        $.post('/gallery/insertAlbum', 
        		{albumName: 	album_name, 
        		 title: 		title, 
        		 header: 		header, 
        		 description: 	description,
        		 content: 		content},
            	function(data){
                $("#list_albums").empty().html(data);
            	}
        );

        clear_form();

        $('#add_album_modal').modal('hide');

        //location.reload();

        return false;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Получить альбомы AJAX'ом
    //----------------------------------------------------------------------------------------------------------------------
    function getAlbums () { 
        $.get('/gallery/', {}, function (data) {
            $('#listAlbums').html(data);
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление альбома
    //--------------------------------------------------------------------------------------------------
    function delete_album (id_album) {
        if(id_album == '' || id_album == null) return false;

        if(confirm('Вы действительно хотите удалить альбом?'))
        {
            $.ajax({  
                type: "POST",  
                url: "index.php?class=albums",  
                data: "method=delete_album&id_album="+id_album,  
                success: function(html){
                    $("#list_albums").empty().html(html);
                }
            });
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Получение данных для редактирования альбома
    //--------------------------------------------------------------------------------------------------
    function edit_album_data (id_album) {
        if(id_album == '' || id_album == null) return false;
        
        $.post('/gallery/getAlbumsJson', {idAlbum: id_album}, function (data) {
            data = $.parseJSON(data);
            console.debug(data);

            $('#inputName').val(data.name);
            $('#inputHeader').val(data.header);
            $('#inputTitle').val(data.title);
            $('#inputDescription').val(data.description);
            $('#inputContent').val(data.content);
            $('#id_album').val(data.id);
            $('#buttonSave').removeAttr('onClick').attr('onClick', 'updateAlbum(' + id_album +  ')');

            $('#myModalLabel').empty().append('Редактирование альбома');
           
            $('#add_album_modal').modal('show');
        });
                

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Редактирование(обновление) альбома
    //--------------------------------------------------------------------------------------------------
    function updateAlbum () {
        var id_album    = $('#id_album').val();
        var album_name  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();

        if(id_album == '' || id_album == null) return false;       //сделать нормальную
        if(album_name == '' || album_name == null) return false;   //ошибку

        $.post('/gallery/updateAlbum', 
                {idAlbum: id_album,
                 albumName: album_name,
                 albumTitle: title,
                 albumDescription: description,
                 albumHeader: header,
                 albumContent: content}, 
                function (data) { 
                    
                    $('#add_album_modal').modal('hide');
                    clear_form();
                    getAlbums();
                    //location.reload();
                });

        //clear_form();

        //$('#add_album_modal').modal('hide');

        return false;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Очистка формы
    //----------------------------------------------------------------------------------------------------------------------
    function clear_form() {
    	$('#inputName').val('');
        $('#inputTitle').val('');
        $('#inputDescription').val('');
        $('#inputHeader').val('');
        $('#inputContent').val('');

        return false;
    }

    // ИЗОБРАЖЕНИЯ -------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------
    // Удаление изображения
    //--------------------------------------------------------------------------------------------------
    function delete_image (id_image) {
        if(id_image == '' || id_image == null) return false;

        if(confirm('Вы действительно хотите удалить изображение?'))
        {
            $.ajax({  
                type: "POST",  
                url: "index.php?class=images&id_album=",  
                data: "method=delete_image&id_image="+id_image,  
                success: function(html){
                    //$("#list_images").empty().html(html);
                    document.location = 'index.php?class=images&id_album=';
                }
            });
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Получение данных для редактирования изображения
    //--------------------------------------------------------------------------------------------------
    function edit_image_data (id_image) {
        if(id_image == '' || id_image == null) return false;

        $.ajax({  
            type: "POST",  
            url: "index.php?class=images&id_album=",  
            data: "method=edit_image_data&id_image="+id_image,  
            success: function(html){              
                var response = html.split('|||');

                $('#id_image').val(response[0])
                $('#inputName').val(response[1]);
                $('#inputTitle').val(response[2]);
                $('#inputDescription').val(response[3]);
                $('#inputHeader').val(response[4]);
                $('#inputContent').val(response[5]);

                $('#myModalLabel').empty().append('Редактирование изображения');
                $('#buttonSave').removeAttr('onclick').attr('onclick', 'update_image();');
                $('#cover_block').removeAttr('style');
                $('#inputFile').attr('style', 'display:none;');
            }
        });

        $('#add_images_modal').modal('show');

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Редактирование(обновление) изображения
    //--------------------------------------------------------------------------------------------------
    function update_image () { 
        var id_image    = $('#id_image').val();
        var id_album    = $('#id_album').val();
        var image_name  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();
        var cover       = $('#cover').prop('checked');
	
        if(id_image == '' || id_image == null) return false;
        if(id_album == '' || id_album == null) return false;
        if(image_name == '' || image_name == null) return false;

        $.ajax({  
            type: "POST",  
            url: "index.php?class=images&id_album=",  
            data: "method=update_image&name="+image_name+"&title="+title+"&description="+description+"&header="+header+"&content="+content+"&id_image="+id_image+"&cover="+cover,  
            success: function(html){
                //$("#list_images").empty().html(html);
                document.location = 'index.php?class=images&id_album=';
            }
        });

        $('#add_images_modal').modal('hide');

        $('#id_image').val('');	
        $('#inputName').val('');
        $('#inputTitle').val('');
        $('#inputDescription').val('');
        $('#inputHeader').val('');
        $('#inputContent').val('');
        $('#cover').prop('checked', false);

        $('#myModalLabel').empty().append('Добавить изображение');
        $('#buttonSave').removeAttr('onclick').attr('onclick', 'add_image();');
        $('#inputFile').removeAttr('style');

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Обработка отмены
    //--------------------------------------------------------------------------------------------------
    $(document).ready(function () {
        $('#buttonCancel').click(function () {
            $('#add_images_modal').modal('hide');

            $('#id_image').val('');	
            $('#inputName').val('');
            $('#inputTitle').val('');
            $('#inputDescription').val('');
            $('#inputHeader').val('');
            $('#inputContent').val('');

            $('#myModalLabel').empty().append('Добавить изображение');
            $('#buttonSave').removeAttr('onclick').attr('onclick', 'upload_image.submit();');
            $('#inputFile').removeAttr('style');
            $('#cover_block').removeAttr('style').attr('style', 'display: none;')
        });

        $('#buttonAdd').click(function () {
            $('#add_images_modal').modal('hide');

            $('#id_image').val('');	
            $('#inputName').val('');
            $('#inputTitle').val('');
            $('#inputDescription').val('');
            $('#inputHeader').val('');
            $('#inputContent').val('');

            $('#myModalLabel').empty().append('Добавить изображение');
            $('#buttonSave').removeAttr('onclick').attr('onclick', 'upload_image.submit();');
            $('#inputFile').removeAttr('style');
            $('#cover_block').removeAttr('style').attr('style', 'display: none;')
        })
    });

</script>

@endsection