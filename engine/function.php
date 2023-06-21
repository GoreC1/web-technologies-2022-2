<?php
function renderTemplate($page, $params = []) {

    /*    foreach ($params as $key => $value) {
            $$key = $value;
        }*/
    extract($params);

    ob_start();
    include TEMPLATES_DIR . $page . ".php";
    return ob_get_clean();
}

function render($page, $params = [], $layout = 'main') {
    return renderTemplate(LAYOUTS_DIR . $layout, [
        'title' => $params['title'],
        'menu' => renderTemplate('menu', ['menus'=> getMenu()] ),
        'content' => renderTemplate($page, $params)
    ]);
}
