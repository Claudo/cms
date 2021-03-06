<?php

echo buildTree($tree, 0);

//--------------------------------------------------------------------------------------------------
// Создает дерево из массива категорий
//--------------------------------------------------------------------------------------------------
function   buildTree($tree, $parentId) {
    $html = '';
    foreach ($tree as $row) {
        if ($row['parent_id'] == $parentId) {
            $html .= '<li class="tree"><i class="icon icon-folder-open" style="padding: 2px 5px;"></i>';
            $html .= '<a href="" onClick="showAddSubcategoryForm('.$row['id'].'); return false;" title="Добавить подкатегорию"><i class="icon icon-plus"></i></a> ';
            $html .= '<a href="" onClick="showEditCategory('.$row['id'].'); return false;">'.$row['name_category'].'</a>';
            $html .= buildTree($tree, $row['id']);
            $html .= '</li>';
        }
    }

    return $html ? '<ul class="tree">' . $html . '</ul>' . "\n" : '';
}
