@if($articles != '')
<table class="table table-bordered" width="100%">
    <tr>
        <th>id</th>
        <th>Заголовок</th>
        <th>Описание</th>
        <th>Действия</th>
    </tr>
    @foreach($articles as $article)
        <tr>
            <td class="span1">{{ $article['id'] }}</td>
            <td>
            <a href="{{ $article['id_category'] }}/{{ $article['id'] }}">
                {{ $article['header'] }}</a>
            </td>
            <td>{{ $article['description'] }}</td>
            <td class="span2" style="text-align: center;">
                <a onClick="showEditArticleForm({{ $article['id'] }}); return false;" class="btn btn-warning">
                    <i class="icon icon-white icon-pencil"></i>
                </a>
                <a onClick="deleteArticle({{ $article['id'] }}, {{ $article['id_category'] }}); return false;" class="btn btn-danger">
                    <i class="icon icon-white icon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>

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
    <a onClick="changePage({{ $i }}); return false;" id="page_{{ $i }}">{{ $i }}</a>
</li>
@endfor
<li><a onClick="changePage('{{ $page+1 }}'); return false;"  id="next">
        <i class="icon icon-circle-arrow-right"></i>
</a></li>
<ul>
</div>
</center>
@endif
