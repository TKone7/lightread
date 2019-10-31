<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 07:41
 */

namespace view;


class TemplateView{
    private $view;
    private $variables = array();

    public function __construct($view) {
        $this->view = $view;
    }
    public function __set($key, $variable) {
        $this->variables[$key] = $variable;
    }

    public function render() {
        extract($this->variables, EXTR_OVERWRITE);
        ob_start();
        require($this->view);
        return ob_get_clean();
    }
}