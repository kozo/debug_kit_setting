<?php
class SettingPanel extends DebugPanel {
    var $plugin = 'DebugKitSetting';
    var $title = 'Settings';
    
    var $controller;

    function startup(&$controller) {
        $this->controller = $controller;
    }

    function beforeRender(&$controller) {
        
        // cakeモードを取得
        $cakeEnvMode = $this->_getCakeEnvMode();
        // 定数一覧を取得
        $defines = $this->_getDefines();
        // server変数一覧
        $servers = $this->_getServers();
        // 読み込まれているモジュール一覧
        $extensions = $this->_getExtensions();
        
        $dbConfigs = $this->_getDbConnectInfo();
        
        $controller->set(compact('cakeEnvMode', 'defines', 'servers', 'extensions', 'dbConfigs'));
        
        
        //$persistModel
        //$modelClass
        //$modelKey
    }
    
    
    /**
     * cakeのモードを取得
     * 
     * @access private
     * @author sakuragawa
     */
    private function _getCakeEnvMode(){
        $servers = $_SERVER;
        
        if(isset($servers['CAKE_ENV_MODE'])){
            return array('CAKE_ENV_MODE' => $servers['CAKE_ENV_MODE']);
        }
        
        return '';
    }
    
    /**
     * 定数一覧を作成
     * 
     * @access private
     * @author sakuragawa
     */
    private function _getDefines(){
        $cake = array();
        $php = array();
        $cakeFlag = false;
        
        // 定数の取得
        $bufDefines = get_defined_constants() ;
        
        foreach($bufDefines as $key=>$val){
            if($key == 'DS'){
                $cakeFlag = true;
            }
            
            if($cakeFlag == false){
                // PHPの定数
                $php[$key] = $val;
            }else{
                // cakePHPの定数
                $cake[$key] = $val;
            }
        }

        $defines['CakePHP'] = $cake;
        $defines['php'] = $php;
        
        return $defines;
    }
    
    
    /**
     * $_SERVERの一覧を取得する
     * 
     * @access private
     * @author sakuragawa
     */
    private function _getServers(){
        $servers = $_SERVER;
        
        if(isset($servers['CAKE_ENV_MODE'])){
            unset($servers['CAKE_ENV_MODE']);
        }
        
        return array('SERVER' => $servers);
    }
    
    
    /**
     * 読み込まれているモジュール一覧を取得する
     * 
     * @access private
     * @author sakuragawa
     */
    private function _getExtensions(){
        return array('extension' => get_loaded_extensions());
    }
    
    
    /**
     * データベースの接続先情報を取得する
     * 
     * @access private
     * @author sakuragawa
     */
    private function _getDbConnectInfo(){
        $dbConfigInfo = array();
        $dbConfig = new DATABASE_CONFIG();
        
        // 読み込まれているModel分ループ
        foreach($this->controller->modelNames as $key=>$val)
        {
            APP::import('Model', $this->controller->modelNames[$key]);
            $model = new $this->controller->modelNames[$key];
            $useDbConfig = $model->useDbConfig;
            
            if(!isset($dbConfig->{$useDbConfig})){
                // 定義されてない
                unset($model);
                continue;
            }
            
            // 接続設定
            $one = $dbConfig->{$useDbConfig};
            
            // 必要な分のみ取り出し
            $buf['driver'] = $one['driver'];
            $buf['host'] = $one['host'];
            $buf['database'] = $one['database'];
            if(count($dbConfigInfo) != 0){
                // 初回以外
                if(!in_array($buf, $dbConfigInfo)){
                    $dbConfigInfo[$useDbConfig] = $buf;
                }
            }else{
                // 初回
                $dbConfigInfo[$useDbConfig] = $buf;
            }
            
            unset($model);
        }
        
        return $dbConfigInfo;
    }
}
?>