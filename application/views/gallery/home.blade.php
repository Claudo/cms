@layout('index')
<!-- Временно (убрать в общий css) -->
<style type="text/css">
.albumCover {
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

.imageBlock {
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
{{ $breadcrumbs }}
</div>

<div class="pull-right">
<br>
<a href="#addAlbumModal" role="button" class="btn btn-success" data-toggle="modal">
    <i class="icon icon-white icon-plus"></i>
    Добавить альбом
</a>
<a href="#addImagesModal" role="button" class="btn btn-success" data-toggle="modal">
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
<div id="addAlbumModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <input type="hidden" id="idAlbum" value="">            
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="buttonCancel">Отмена</button>
        <button class="btn btn-primary" id="buttonSave" onClick="addAlbum();">Сохранить</button>
    </div>
</div>
<!-- // -->

<!-- Модальное окно добавления новой картинки -->
<div id="addImagesModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Добавить изображение</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" method="POST" action="/gallery/" id="uploadImage" name="uploadImage" enctype="multipart/form-data">
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
            <div class="control-group" style="display: none;" id="coverBlock">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" id="cover"> Обложка альбома
                    </label>
                </div>
            </div>
            <input type="hidden" id="idAlbum" name="idAlbum" value="">            
            <input type="hidden" id="idImage" name="idImage" value="">            
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="buttonCancel">Отмена</button>
        <button class="btn btn-primary" id="buttonSave" onclick="uploadImage.submit();">Сохранить</button>
    </div>
</div>
<!-- // -->

<script type="text/javascript">

	// АЛЬБОМЫ -----------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------
    // Добавление нового альбома
    //--------------------------------------------------------------------------------------------------
    function addAlbum() {
        var albumName  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();

        if(albumName == '' || albumName == null){ 
        	alert('Незаполнено имя альбома');
        	return false;
        }

        $.post('/gallery/insertAlbum', 
        		{albumName: 	albumName, 
        		 title: 		title, 
        		 header: 		header, 
        		 description: 	description,
        		 content: 		content},
            	function(data){
                    clearForm();
                    $('#addAlbumModal').modal('hide');
                    getAlbums();
                    return false;
            	}
        );
        
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Получить альбомы AJAX'ом
    //----------------------------------------------------------------------------------------------------------------------
    function getAlbums () { 
        $.get('/gallery/', {val: 'true'}, function (data) {
            $('#listAlbums').html(data);
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Удаление альбома
    //--------------------------------------------------------------------------------------------------
    function deleteAlbum (idAlbum) {
        if(idAlbum == '' || idAlbum == null) return false;

        if(confirm('Вы действительно хотите удалить альбом?'+"\n"+
                '(ВНИМАНИЕ !!!Все изображения в данном альбоме будут удалены!!!)'))
        {                    
            $.post('/gallery/delAlbum/', {idAlbum: idAlbum}, function (data){
                    getAlbums ();
            });
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Получение данных для редактирования альбома
    //--------------------------------------------------------------------------------------------------
    function editAlbumData (idAlbum) {
        if(idAlbum == '' || idAlbum == null) return false;
        
        $.post('/gallery/getAlbumsJson', {idAlbum: idAlbum}, function (data) {
            data = $.parseJSON(data);
            console.debug(data);

            $('#inputName').val(data.name);
            $('#inputHeader').val(data.header);
            $('#inputTitle').val(data.title);
            $('#inputDescription').val(data.description);
            $('#inputContent').val(data.content);
            $('#idAlbum').val(data.id);
            $('#buttonSave').removeAttr('onClick').attr('onClick', 'updateAlbum(' + idAlbum +  ')');

            $('#myModalLabel').empty().append('Редактирование альбома');
           
            $('#addAlbumModal').modal('show');
        });
                

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Редактирование(обновление) альбома
    //--------------------------------------------------------------------------------------------------
    function updateAlbum () {
        var idAlbum    = $('#idAlbum').val();
        var albumName  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();

        if(idAlbum == '' || idAlbum == null) return false;       //сделать нормальную
        if(albumName == '' || albumName == null) return false;   //ошибку

        $.post('/gallery/updateAlbum', 
                {idAlbum: idAlbum,
                 albumName: albumName,
                 albumTitle: title,
                 albumDescription: description,
                 albumHeader: header,
                 albumContent: content}, 
                function (data) { 
                    
                    $('#addAlbumModal').modal('hide');        
                    //location.reload();
                });

        clearForm ();
        getAlbums ();

        return false;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Очистка формы
    //----------------------------------------------------------------------------------------------------------------------
    function clearForm() {
    	$('#inputName').val('');
        $('#inputTitle').val('');
        $('#inputDescription').val('');
        $('#inputHeader').val('');
        $('#inputContent').val('');

        return false;
    }
</script>

@endsection