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


<br><br>
<div class="pull-right">
<a onClick='addImageInAlbum({{ $idAlbum }});' role="button" class="btn btn-success" data-toggle="modal">
    <i class="icon icon-white icon-plus"></i>
    Добавить изображение
</a>
</div>
<div style="clear:both"></div>
<hr>
<!-- / -->

<div id="listImages">
       @render('gallery.list_images', array('images' => $images, 'pages' => $pages, 'page' => $page))  
</div>

<!-- Модальное окно добавления новой картинки -->
<div id="addImagesModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Добавить изображение (Пока что не работает, кликать бесполезно =) )</h3>
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
                    <span id='message'></span>
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

    // ИЗОБРАЖЕНИЯ -------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------
    // Удаление изображения
    //--------------------------------------------------------------------------------------------------
    function deleteImage (idImage) {
        if(idImage == '' || idImage == null) return false;

        if(confirm('Вы действительно хотите удалить изображение?'))
        {
            $.post('/gallery/delImage', {idImage: idImage}, function(html){
                    getImages ();
            });
        }

        return false;
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Получить изображения AJAX'ом 
    //----------------------------------------------------------------------------------------------------------------------
    function getImages() { 
        $.get('/gallery/{{ $idAlbum }}', {}, function (data) {
            $('#listImages').html(data);
        });
    }

    //--------------------------------------------------------------------------------------------------
    // Получение данных для редактирования изображения
    //--------------------------------------------------------------------------------------------------
    function editImageData (idImage) {

        if(idImage == '' || idImage == null) return false;
        $('#inputAlbumId').show();
        $('#message').html('');


        $.post('/gallery/getImagesJson', {idImage: idImage}, function (data) {
            data = $.parseJSON(data);
            
            $('#idImage').val(data.id);
            $('#inputName').val(data.name);
            $('#inputTitle').val(data.title);
            $('#inputDescription').val(data.description);
            $('#inputHeader').val(data.header);
            $('#inputContent').val(data.content);
            $('#inputAlbumId').val(data.id_album);

            $('#myModalLabel').empty().append('Редактирование изображения');
            $('#buttonSave').removeAttr('onclick').attr('onclick', 'updateImage();');
            $('#coverBlock').removeAttr('style');
            $('#inputFile').hide();

            //$('#myModalLabel').empty().append('Редактирование альбома');
           
            $('#addImagesModal').modal('show');

            return false;
        });
                

        
       
    }

    //--------------------------------------------------------------------------------------------------
    // Редактирование(обновление) изображения
    //--------------------------------------------------------------------------------------------------
    function updateImage () { 
        var idImage    = $('#idImage').val();
        var idAlbum    = $('#inputAlbumId').val();
        var imageName  = $('#inputName').val();
        var title       = $('#inputTitle').val();
        var description = $('#inputDescription').val();
        var header      = $('#inputHeader').val();
        var content     = $('#inputContent').val();
        var cover       = $('#cover').prop('checked');
    
        if(idImage == '' || idImage == null) return false;        // Опять таки нужна
                                                                  // адекватная реакция
        if(imageName == '' || imageName == null) return false;  // на ошибки

        $.post('/gallery/updateImage', {
                                            idImage: idImage,
                                             inputName: imageName,
                                             inputTitle: title,
                                             inputDescription: description,
                                             inputHeader: header,
                                             inputContent: content,
                                             idAlbum: idAlbum,
                                             cover: cover
                                        }, 
                 function (data) {
                    $('#addImagesModal').modal('hide');

                    clearFormImage();

                    $('#myModalLabel').empty().append('Добавить изображение');

                    getImages();
                    
                    return false;
                 });

       
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Модальное окно для добавления картинки в текущий альбом
    //----------------------------------------------------------------------------------------------------------------------
    function addImageInAlbum(idAlbum) {
        clearFormImage();
        $('#inputAlbumId').hide();
        $('#inputFile').show();
        $('#inputAlbumId').val(idAlbum);
        $('#message').html('Текущий альбом');
        $('#myModalLabel').empty().append('Добавление изображения');
        $('#buttonSave').removeAttr('onclick').attr('onclick', 'uploadImage.submit();');

        $('#addImagesModal').modal('show');
    }

    //----------------------------------------------------------------------------------------------------------------------
    // Очистка формы
    //----------------------------------------------------------------------------------------------------------------------
    function clearFormImage() {

                    $('#idImage').val(''); 
                    $('#inputName').val('');
                    $('#inputTitle').val('');
                    $('#inputDescription').val('');
                    $('#inputHeader').val('');
                    $('#inputContent').val('');
                    $('#cover').prop('checked', false);
    }


    //--------------------------------------------------------------------------------------------------
    // Обработка отмены
    //--------------------------------------------------------------------------------------------------
    $(document).ready(function () {
        $('#buttonCancel').click(function () {
            $('#addImagesModal').modal('hide');

            $('#idImage').val(''); 
            $('#inputName').val('');
            $('#inputTitle').val('');
            $('#inputDescription').val('');
            $('#inputHeader').val('');
            $('#inputContent').val('');

            $('#myModalLabel').empty().append('Добавить изображение');
            $('#buttonSave').removeAttr('onclick').attr('onclick', 'uploadImage.submit();');
            $('#inputFile').removeAttr('style');
            $('#coverBlock').removeAttr('style').attr('style', 'display: none;')
        });

        $('#buttonAdd').click(function () {
            $('#addImagesModal').modal('hide');

            clearFormImage();

            $('#myModalLabel').empty().append('Добавить изображение');
            $('#buttonSave').removeAttr('onclick').attr('onclick', 'uploadImage.submit();');
            $('#inputFile').removeAttr('style');
            $('#coverBlock').removeAttr('style').attr('style', 'display: none;')
        })
    });

    //----------------------------------------------------------------------------------------------------------------------
    // Смена страниц
    //----------------------------------------------------------------------------------------------------------------------
    function changePage(pageNo) {
        if(pageNo == '') return false;
        $.get('/gallery/{{ $idAlbum }}', {page: pageNo}, function (data) {
            console.debug(data);
            $('#listImages').html(data);

        });
        return false;
    }

</script>



@endsection