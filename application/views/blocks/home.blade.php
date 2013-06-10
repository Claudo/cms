@layout('index')

@section('content')
<h2>Статичные HTML блоки</h2>


<<<<<<< HEAD
=======
<div class="pull-left">
    <h2>Статичные HTML блоки</h2>
</div>
<div class="pull-right">
    <a href="#addBlock" role="button" class="btn btn-success" data-toggle="modal">
        <i class="icon icon-white icon-plus"></i> Добавить блок
    </a>
</div>
<div style="clear: both;"></div>
<div>
    @if($blocks)
        @foreach($blocks as $num => $block)
            <div>
                блок {{$num+1}}<br>
                URL: {{ $block['url'] }}<br>
                Блок:<br> {{ $block['block'] }}
            </div>
        @endforeach
    @endif
</div>
<div class="modal hide fade" id="addBlock">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Добавить блок</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" onSubmit="insertBlock(); return false;" id="addCategoryForm">
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
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Отмена</a>
        <a href="#" class="btn btn-primary" onClick="insertBlock(); return false;">Добавить</a>
    </div>
</div>

<script>

    CKEDITOR.replace( 'inputBlock' );

    function insertBlock() {
        var inputURL = $('#inputURL').val();
        var inputBlock = CKEDITOR.instances.inputBlock.getData();

        if(inputURL == '' || inputBlock == '') {
            alert('Заполнены не все поля!');
            return false;
        }

        $.post('/blocks/insertBlock', { url: inputURL, block: inputBlock }, function (data) {
            alert('Блок добавлен');
            $('#addArticle').modal('hide');
        });
    }
</script>
>>>>>>> 4b211cc633c6b68c3d12ca30f1ab7744c23cf6f0
@endsection