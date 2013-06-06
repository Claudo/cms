<?php
//debug($tree);
echo buildTreeSelect($tree, 0);

//--------------------------------------------------------------------------------------------------
// Создает дерево из массива категорий
//--------------------------------------------------------------------------------------------------
function   buildTreeSelect($tree, $parentId, $tab = null) {
    $html = '';
    foreach ($tree as $row) {
        if ($row['parent_id'] == $parentId) {
            $tab  .= '&nbsp;&nbsp;&nbsp;';
            $html .= '<option value="'.$row['id'].'">'.$tab.$row['name_category'].'</option>';
            $html .= buildTreeSelect($tree, $row['id'], $tab);
            $html .= '</li>';
        }
    }

    return $html;
}
