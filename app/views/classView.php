<?php


class View
{
    private $layout;

    public function __construct()
    {
        $this->layout = DOC_ROOT . '/content/layouts/general-layout.php';
    }

    public function render_page($template, $data = null, $layout = null)
    {
        $this->layout = $layout ? DOC_ROOT . '/content/layouts/' . $layout : $this->layout;
        include $this->layout;
    }

    public function render_template($template, $data = null) {
        include DOC_ROOT . '/content/templates/' . $template;
    }

}