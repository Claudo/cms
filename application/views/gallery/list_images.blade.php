
@foreach ($images as $image) 
<div class="imageBlock">
	<div style="min-height: 150px;">
		{{ $image['name'] }} <br>
		<img src="/img/gallery/small/{{ $image['preview'] }}" width="100"><br><br>
	</div>
	<a onclick="editImageData({{ $image['id'] }});"><i class="icon icon-pencil pull-right"></i></a>
	<a onclick="deleteImage({{ $image['id'] }});"><i class="icon icon-trash pull-right"></i></a>
</div>
@endforeach

<div style="clear:both"></div><center>
	<div class="pagination">
		<ul>
		 <li><a onClick="changePage({{ ($page-1) }});return false;" id="prew"><-</a></li>

@for($i=1; $i<=$pages; $i++)
    
    @if ($i == $page) 
    	<li class="active">
     @else 
    	<li>
    @endif
    	<a onClick="changePage({{ $i }}); return false;" id="page_{{ $i }}">{{ $i }}</a>
		</li>
@endfor

		 <li><a onClick="changePage({{ ($page+1) }}); return false;"  id="next">-></a></li>
		</ul>
	</div>
</center>