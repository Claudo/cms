<? $i=0 ?>
<table style="width:100%;">
	<tr>
		@foreach ($products as $product)
		<td valign="top" style="width:50%; padding: 5px 30px; ">
		<div style="float:right">
			<a href="" style="color: #fff;" onClick="deleteProduct({{ $product['id'] }}); return false;" title="Добавить подкатегорию"><i class="icon icon-remove"></i></a> 
           	<a href="" style="color: #fff;" onClick="showEditProductForm({{ $product['id'] }}); return false;"><i class="icon icon-pencil" style="margin-right:3px;"></i></a>
		</div>
		
		
		 <img src="{{ $product['imagePath'] }}" style="float:left; margin: 5px;">
		
		<h4>{{ $product['name'] }}</h4>
		<p style="font-size:18px">{{ $product['price']}}</p>
		<p style="font-size:9px; line-height:12px"><i>{{ $product['content'] }}</i></p>
		<div style="clear:both"></div>
		</td>
		<? if ($i==1) {
			echo'</tr><tr>'; 
			$i=0;  
		   } else $i++ ; ?>
		@endforeach
		<? if ($i==1) echo'<td></td>'; ?>
	</tr>
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