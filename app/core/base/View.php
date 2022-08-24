<?php


namespace App\core\base;


class View
{
    /**
     * Render view
     * @param string $name path to file
     * @param array|null $params ['title' => 'some title'] must have
     */
    public static function render(string $name, ?array $params = [])
    {
        extract($params);
        ob_start();
        require_once APP . "/mvc/views/$name.php";
        $content = ob_get_clean();
        require_once DEFAULT_LAYOUT;
    }

}