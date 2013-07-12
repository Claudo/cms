<?php
//debug($categories);
echo buildCategories($categories, 0);

//--------------------------------------------------------------------------------------------------
// Создает дерево из массива категорий
//--------------------------------------------------------------------------------------------------
function buildCategories($tree, $parentId) {
    $html = '';
    foreach ($tree as $row) {
        if ($row['parent_id'] == $parentId) {
            $html .= '<li class="tree"><i class="icon icon-folder-open" style="padding: 2px 5px;"></i>';
            $html .= '<a href="" style="color: #fff;" onClick="showAddSubcategoryForm('.$row['id'].'); return false;" title="Добавить подкатегорию"><i class="icon icon-plus"></i></a> ';
            $html .= '<a href="" style="color: #fff;" onClick="showEditCategory('.$row['id'].'); return false;">'.$row['name_category'].'</a>';
            $html .= buildCategories($tree, $row['id']);
            $html .= '</li>';
        }
    }

    return $html ? '<ul class="tree">' . $html . '</ul>' . "\n" : '';
}
