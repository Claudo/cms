    <table class='table' id='block-list'>
    <tr class = 'success'>
        <td>#</td>
        <td>url</td>
        <td>блок</td>
        <td class='activity-block'>действия</td>
    </tr>
    @if($blocks)
    @foreach($blocks as $num => $block)
    <tr id='block{{$block['id']}}'>
        <td class="b-id">{{$block['id']}}</td>
        <td class="b-url">{{ $block['url'] }}</td>
        <td class="b-block">{{ $block['block'] }}</td>
        <td class='activity-block'>
            <a href='#' class="btn btn-warning" onClick="htmlBlocks.editBlock({{$block['id']}}); return false;">
                <i class="icon icon-white icon-pencil"></i>
            </a>
            <a href='#' class="btn btn-danger" onClick="htmlBlocks.removeBlock({{$block['id']}}); return false;">
                <i class="icon icon-white icon-trash"></i>
            </a>
        </td>
    </tr>
    @endforeach
    @endif
    </table>

    <center>
        <div class="pagination">
            <ul>
                <li><a href='#' onClick="htmlBlocks.changePage('{{ $page-1 }}');return false;" id="prew">
                        <i class="icon icon-circle-arrow-left"></i>
                    </a></li>
                @for($i=1; $i<=$pages; $i++)
                @if ($i == $page)
                <li class="active">
                    @else
                <li>
                    @endif
                    <a href='#' onClick="htmlBlocks.changePage({{ $i }}); return false;" id="page_{{ $i }}">{{ $i }}</a>
                </li>
                @endfor
                <li><a href='#' onClick="htmlBlocks.changePage('{{ $page+1 }}'); return false;"  id="next">
                        <i class="icon icon-circle-arrow-right"></i>
                    </a></li>
                <ul>
        </div>
    </center>