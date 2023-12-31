<?php

namespace koolreport\instant;

use \koolreport\core\Utility;

trait SinglePage
{
    protected $_oldActiveReport;
    public function __constructSinglePage()
    {
        //assets folder
        $assets = Utility::get($this->reportSettings,"assets");
        if($assets===null)
        {
            $asset_path = str_replace("\\","/",dirname($_SERVER["SCRIPT_FILENAME"])."/koolreport_assets");
            
            if(!is_dir($asset_path))
            {
                mkdir($asset_path,0755);
            }
            $assets = array(
                "url"=>"koolreport_assets",
                "path"=>$asset_path,
            );
            $this->reportSettings["assets"] = $assets;
        }
    }

    public function start()
    {
        $this->run();
        $this->_oldActiveReport = isset($GLOBALS["__ACTIVE_KOOLREPORT__"])?$GLOBALS["__ACTIVE_KOOLREPORT__"]:null;
        $GLOBALS["__ACTIVE_KOOLREPORT__"] = $this;
        $this->getResourceManager()->init();
        ob_start();
    }
    public function end()
    {
        $content = ob_get_clean();
        if($this->_oldActiveReport===null)
        {
            unset($GLOBALS["__ACTIVE_KOOLREPORT__"]);
        }
        else
        {
            $GLOBALS["__ACTIVE_KOOLREPORT__"] = $this->_oldActiveReport;    
        }
        if($this->fireEvent("OnBeforeResourceAttached"))
        {
            $this->getResourceManager()->process($content);
            $this->fireEvent("OnResourceAttached");
        }
        $this->fireEvent("OnRenderEnd",array('content'=>&$content));
        echo $content;
    }
}