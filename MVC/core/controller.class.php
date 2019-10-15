<?php
class Controller{
    var $smarty;
    
    public function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->template_dir = ROOT . DS . 'app' . DS . 'view' . DS . get_called_class() . DS;
	}
    
    public function assign($name, $value){
        $this->smarty->assign($name, $value);
    }
    
    public function display($view = ''){
        if ($view == '') {
            $this->smarty->display('index.htm');
            return;
        }
        $this->smarty->display($view.'.htm');
    }
    
    public function cache() {
        $this->smarty->caching = TRUE;
        return $this;
    }
    
    public function clearCache($view = '') {
        if ($view == '') {
            $this->smarty->clearAllCache();
        }else {
            $this->smarty->clearCache($view.'.htm');
        }
    }
}