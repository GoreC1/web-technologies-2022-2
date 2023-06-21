<script type="module" src="js/folders.js"></script>
<link href="css/style.css" rel="stylesheet"/>
<?php
function renderFolders($elements, $child) {
    foreach ($elements as $item) {
        if ($item["child"] == $child) {
            echo '<div class="list-item list-item_open" data-parent>' .
                '<div class="list-item__inner">' .
                '<img class="list-item__arrow" src="img/chevron-down.png" alt="chevron-down" data-open>' .
                '<img class="list-item__folder" src="img/folder.png" alt="folder">';
            echo    '<span>' . $item["name"] . '</span>' .
             '</div>' .
             '<div class="list-item__items">';
            renderFolders($elements, $item["id"]);
            echo '</div>' .
             '</div>';
        }
    }
}
echo '<div class="list-items" id="list-items">';
renderFolders($folders, null);
echo '</div>';
?>