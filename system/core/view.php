<?php

namespace system\core;

use Windwalker\Edge\Cache\EdgeFileCache;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;
use system\libary\html as html;
use system\libary\form as form;

class view
{
    // Active Theme
    private static $theme = null;

    public static function render($file, $vars = [], $cache = false)
    {

        $paths 	= ["app/view"];
        $loader = new EdgeFileLoader($paths);
        $loader->addFileExtension('.blade.php');
        if ($cache === false)
            $edge = new Edge($loader);
        else
            $edge = new Edge($loader, null, new EdgeFileCache(app . '/storage/cache'));
        if (is_null(self::$theme))
            echo $edge->render($file, $vars);
        else
            echo $edge->render(self::$theme . '.' . $file, $vars);
    }
    /**
     * Set Activated Theme
     *
     * @param string $theme
     * @return $this
     */
    public function theme($theme)
    {
        if (file_exists(view . $theme)) {
            $this->theme = $theme;
        } else {
            throw new \System\Libs\Exception\ExceptionHandler("Hata", "Tema dizini bulunamadı. { $theme }");
        }
        return $this;
    }
}
