@layout('index')

@section('content')
<link href="/css/blocks.css" rel="stylesheet" media="screen">
<!-- Подключаем CKEditor -->
<script src="/ckeditor/ckeditor.js"></script>

<div class="pull-left">
    <h2>Статичные HTML блоки</h2>
</div>
<div class="pull-right">
    <a href="#add-block" role="button" onClick="htmlBlocks.resetForm()" class="btn btn-success" data-toggle="modal">
        <i class="icon icon-white icon-plus"></i> Добавить блок
    </a>
</div>
<div style="clear: both; height: 30px"> </div>
<div id='content'>
    @render('blocks.blocklist', array('blocks' => $blocks, 'pages' => $pages, 'page' => $page))
</div>
<div class="modal hide fade" id="add-block">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Блок</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" onSubmit="htmlBlocks.saveBlock(); return false;" id="add-block-form">
            <div class="control-group">
                <label class="control-label" for="inputURL">URL:</label>
                <div class="controls">
                    <input type="text" id="input-url" name="input-url" placeholder="http://" class="span12">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputblock">Блок:</label>
                <div class="controls">
                    <textarea name="inputblock" id="inputblock" placeholder="Блок"></textarea>
                </div>
            </div>
            <input type="hidden" id="block-id" name="block-id" value=''>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Отмена</a>
        <a href="#" class="btn btn-primary" onClick="htmlBlocks.saveBlock(); return false;">Сохранить</a>
    </div>
</div>

<script>
    var pages = {{$pages}};
    var page = {{$page}};

    var htmlBlocks = {

        init: function(){
            CKEDITOR.replace( 'inputblock' );
        },

        saveBlock: function() {
            var inputURL = $('#input-url').val();
            var inputBlock = CKEDITOR.instances.inputblock.getData();

            if(inputURL == '' || inputBlock == '') {
                alert('Заполнены не все поля!');
                return false;
            }

            var blockId = $('#block-id').val();
            $.post('/blocks/saveBlock', { id: blockId, url: inputURL, block: inputBlock }, function (data) {
                data = $.parseJSON(data);
                alert('Сохранение прошло успешно');
                bUrl = $('#input-url').val();
                block = data.block;



                if ($('tr').is('#block'+data.id)) {
                    $('#block'+data.id+' .b-url').html(bUrl);
                    $('#block'+data.id+' .b-block').html(block);
                } else {
                    if ((page == pages) || !pages) {
                        newBlock = $("<tr>");
                        newBlock.attr('id', 'block' + data.id);
                        newBlock.append('<td class="b-id">'+data.id+'</td>');
                        newBlock.append('<td class="b-url">'+bUrl+'</span></td>');
                        newBlock.append('<td class="b-block">'+block+'</span></td>');
                        newBlock.append('<td class="activity-block"><a href="#" class="btn btn-warning" onClick="htmlBlocks.editBlock(' + data.id + '); return false;"><i class="icon icon-white icon-pencil"></i></a>\
                            <a href="#" class="btn btn-danger" onClick="htmlBlocks.removeBlock(' + data.id + '); return false;"><i class="icon icon-white icon-trash"></i></a></td>');
                        $('#block-list').append(newBlock);
                    }
                }
                $('#add-block').modal('hide');

            });
        },

        removeBlock: function(blockId) {
            $.post('/blocks/removeBlock', { id: blockId }, function (data) {
                alert('Блок #'+blockId+' удален');
                $('#block'+blockId).remove();
            });
        },

        editBlock: function(blockId) {
            this.resetForm();
            $.post('/blocks/getBlockById', { id: blockId }, function (data) {
                data = $.parseJSON(data);
                $('#block-id').val(data.id);
                $('#input-url').val(data.url);
                CKEDITOR.instances.inputblock.setData(data.block);
                $('#add-block').modal('show');
            });
        },

        resetForm: function() {
            $(':input','#add-block-form').not(':button, :submit, :reset').val('');
            CKEDITOR.instances.inputblock.setData('');
        },

        changePage: function(pageNum) {
            if(pageNum == '') return false;

            $.get('/blocks/', {page: pageNum}, function (data) {
                page = pageNum;
                $('#content').html(data);
            })
        }
    }
    htmlBlocks.init();
</script>

@endsection
