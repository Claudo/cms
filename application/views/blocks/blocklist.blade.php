<div id='blockList'>
    @if($blocks)
    @foreach($blocks as $num => $block)
    <div id='block{{$block['id']}}'>
        <div>id: <span class='bId'>{{$block['id']}}</span></div>
        <div>URL: <span class='bUrl'>{{ $block['url'] }}</span></div>
        <div>Блок:<br> <span class='bBlock'>{{ $block['block'] }}</span></div>
        <div>
            <a href='#' class='btn btn-danger' onClick="removeBlock({{$block['id']}}); return false;">Удалить</a>
            <a href='#' class='btn btn-success'onClick="editBlock({{$block['id']}}); return false;">Редактировать</a>
        </div>
    </div>
    @endforeach
    @endif
</div>

<center>
    <div class="pagination">
        <ul>
            <li><a onClick="changePage('{{ $page-1 }}');return false;" id="prew">
                    <i class="icon icon-circle-arrow-left"></i>
                </a></li>
            @for($i=1; $i<=$pages; $i++)
            @if ($i == $page)
            <li class="active">
                @else
            <li>
                @endif
                <a href='#' onClick="changePage({{ $i }}); return false;" id="page_{{ $i }}">{{ $i }}</a>
            </li>
            @endfor
            <li><a onClick="changePage('{{ $page+1 }}'); return false;"  id="next">
                    <i class="icon icon-circle-arrow-right"></i>
                </a></li>
            <ul>
    </div>
</center>