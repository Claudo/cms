@layout('index')

@section('content')

<!-- Подключаем CKEditor -->
<script src="/ckeditor/ckeditor.js"></script>

<div class="pull-left">
    <h2>Статичные HTML блоки</h2>
</div>
<div class="pull-right">
    <a href="#addBlock" role="button" onClick="resetForm()" class="btn btn-success" data-toggle="modal">
        <i class="icon icon-white icon-plus"></i> Добавить блок
    </a>
</div>
<div style="clear: both;"></div>
<div id='contentBlock'>
@if($blocks)
    @render('blocks.blocklist', array('blocks' => $blocks, 'pages' => $pages, 'page' => $page))
@endif
</div>
<div class="modal hide fade" id="addBlock">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Блок</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" onSubmit="insertBlock(); return false;" id="addBlockForm">
            <div class="control-group">
                <label class="control-label" for="inputURL">URL:</label>
                <div class="controls">
                    <input type="text" id="inputURL" name="inputURL" placeholder="http://" class="span12">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputBlock">Блок:</label>
                <div class="controls">
                    <textarea name="inputBlock" id="inputBlock" placeholder="Блок"></textarea>
                </div>
            </div>
            <input type="hidden" id="blockId" name="blockId" value=''>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Отмена</a>
        <a href="#" class="btn btn-primary" onClick="saveBlock(); return false;">Сохранить</a>
    </div>
</div>

<script>

    CKEDITOR.replace( 'inputBlock' );

    function saveBlock() {
        var inputURL = $('#inputURL').val();
        var inputBlock = CKEDITOR.instances.inputBlock.getData();

        if(inputURL == '' || inputBlock == '') {
            alert('Заполнены не все поля!');
            return false;
        }
        var blockId = $('#blockId').val();

        $.post('/blocks/saveBlock', { id: blockId, url: inputURL, block: inputBlock }, function (data) {
            data = $.parseJSON(data);
            alert('Сохранение прошло успешно');
            bUrl = $('#inputURL').val();
            block = CKEDITOR.instances.inputBlock.getData();



            if ($('div').is('#block'+data.id)) {
                $('#block'+data.id+' .bUrl').html(bUrl);
                $('#block'+data.id+' .bBlock').html(block);
            } else {
                newBlock = $("<div>");
                newBlock.attr('id', 'block' + data.id);
                newBlock.append('<div>id: <span class="bId"></span>'+data.id+'</div>');
                newBlock.append('<div>URL: <span class="bUrl">'+bUrl+'</span></div>');
                newBlock.append('<div>Блок: <span class="bBlock">'+block+'</span></div>');
                newBlock.append('<div><a href="#" class="btn btn-danger" onClick="removeBlock('+data.id+'); return false;">Удалить</a> <a href="#" class="btn btn-success" onClick="editBlock('+data.id+'); return false;">Редактировать</a></div>');
                $('#blockList').append(newBlock);
            }
            resetForm();
            $('#addBlock').modal('hide');

        });
    }

    function removeBlock(blockId) {
        $.post('/blocks/removeBlock', { id: blockId }, function (data) {
            alert('Блок #'+blockId+' удален');
            $('#block'+blockId).remove();
        });
    }

    function editBlock(blockId) {
        resetForm();
        $.post('/blocks/getBlockById', { id: blockId }, function (data) {
            data = $.parseJSON(data);
            $('#blockId').val(data.id);
            $('#inputURL').val(data.url);
            CKEDITOR.instances.inputBlock.setData(data.block);
            $('#addBlock').modal('show');
        });
    }

    function resetForm() {
        $(':input','#addBlockForm').not(':button, :submit, :reset').val('');
        CKEDITOR.instances.inputBlock.setData('');
    }

    function changePage(pageNum) {
        if(pageNum == '') return false;
        $.get('/blocks/', {page: pageNum}, function (data) {
            $('#contentBlock').html(data);
        })
    }

</script>

@endsection
