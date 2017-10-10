<?php

if (!function_exists('view')) {
    function view($file, $data = [])
    {
        $filePath = view . $file . '.php';
        if (file_exists($filePath)) {
            extract($data);
            require_once $filePath;
        } else {
            exit('Dosya bulunamadı.' . '<b> View : </b>' . $file);
        }
    }
}
if (!function_exists('config')) {
    function config($file)
    {
        $filePath = config . $file . '.php';
        if (file_exists($filePath)) {
            return require_once $filePath;
        } else {
            exit('Dosya bulunamadı.' . '<b> config : </b>' . $file);
        }
    }
}

if (!function_exists('dd')) {
    function dd($val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
    }
}

if (!function_exists('file_to_class')) {
    function file_to_class($files)
    {
        if (file_exists($file = "/{$files}.php")) {
            require_once $file;

            if (class_exists($file)) {
                return new $file;

            } else {
                exit("{$files} dosyasında sınıf tanımlı değil: $file");
            }

        } else {
            exit("{$files} dosyası bulunamadı: {$file}.php");
        }
    }
}
if (!function_exists('libary')) {
    function libary($val)
    {
        file_to_class($file = libary . $val);
    }
}
if (!function_exists('tag')) {
    function tag($tag)
    {
        foreach ($tag as $key => $value) {
            # code...
            return "{$key} = '{$value}' ";
        }
    }
}

if (!function_exists('get')) {
    /**
     * $_GET verisi döndürür
     * Boş değer aldığında istek metodu doğrular
     * Eğer mevcut veri yoksa, false döndürür
     * @example get('sorguAdi')
     * @param string $key anahtar
     * @return mixed
     */
    function get($key = null)
    {
        if (is_null($key)) {
            return ($_SERVER['REQUEST_METHOD'] === 'GET');
        } else {
            return isset($_GET[$key]) ?
                $_GET[$key] : false;
        }
    }
}
if (!function_exists('post')) {
    /**
     * $_POST verisi döndürür
     * Boş değer aldığında istek metodu doğrular
     * Eğer mevcut veri yoksa, false döndürür
     * @example post('kullaniciAdi')
     * @param string $key anahtar
     * @return mixed
     */
    function post($key = null)
    {
        if (is_null($key)) {
            return ($_SERVER['REQUEST_METHOD'] === 'POST');
        } else {
            return isset($_POST[$key]) ?
                $_POST[$key] : false;
        }
    }
}
if (!function_exists('files')) {
    /**
     * $_FILES verisi döndürür
     * Boş değer alırsa doğrulama yapar
     * Alınan değer yok ise false döner
     * @example files('gorsel')
     * @param string $key anahtar
     * @return mixed
     */
    function files($key = null)
    {
        if (is_null($key)) {
            return isset($_FILES) && !empty($_FILES) ?
                $_FILES : false;
        } else {
            return isset($_FILES[$key]) ?
                $_FILES[$key] : false;
        }
    }
}
if (!function_exists('ajax')) {
    /**
     * Bir AJAX isteği olup olmadığını sorar
     * @example if (ajax()) echo 'Bu bir AJAX isteği!'
     * @return bool
     */
    function ajax()
    {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        );
    }
}
if (!function_exists('session')) {
    /**
     * Oturum anahtarı döndürür
     * Oturum başlatılmamışsa false döner
     * Oturum anahtarı yoksa false döner
     * @example session('kullaniciID')
     * @param string $key anahtar
     * @return mixed
     */
    function session($key = null)
    {
        if (session_id() === '') return false;
        if (is_null($key)) {
            return isset($_SESSION) && !empty($_SESSION) ?
                $_SESSION : false;
        } else {
            return isset($_SESSION[$key]) ?
                $_SESSION[$key] : false;
        }
    }
}
if (!function_exists('dump')) {
    /**
     * Bir dize veya objeyi okunabilir hale getirir
     * @example dump([1,2,3,4,5])
     * @param mixed $data
     */
    function dump($data)
    {
        echo '<pre>' . print_r($data, true) . '</pre>';
    }
}
/**
 * Kayıtçı (registry)
 * Belirtilen verileri depolara
 * Bir konteyner görevi görür
 * @var mixed
 */
$_r = [];
if (!function_exists('set')) {
    /**
     * Kayıtçıya veri depolar
     * @example set('siteBasligi', 'Sitenin Başlığı')
     * @param mixed $key Anahtar
     * @param mixed $value Değer
     */
    function set($key, $value = null)
    {
        global $_r;
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $_r = array_merge($_r, [$k => $v]);
            }
        } else {
            $_r = array_merge($_r, [$key => $value]);
        }
    }
}
if (!function_exists('r')) {
    /**
     * Kayıtçıdan veri döndürür
     * @example r('siteBasligi')
     * @param string $key Anahtar
     * @return mixed
     */
    function r($key = null)
    {
        global $_r;
        if (is_null($key)) {
            return isset($_r) && !empty($_r) ?
                $_r : false;
        } else {
            return array_key_exists($key, $_r) ?
                $_r[$key] : false;
        }
    }
}
if (!function_exists('render')) {
    /**
     * Bir tema dosyası çağırıcısıdır
     * @example render('index.php', ['title' => 'Başlık'])
     * @param string $file Dosya adı/yolu
     * @param array $params Parametreler
     */
    function render($file, array $params = [])
    {
        if (is_file($file)) {
            extract($params);
            ob_start();
            require $file;
            echo ob_get_clean();
        }
    }
}
if (!function_exists('url')) {
    /**
     * URL dizgesi yaratıcısı
     * @example url('kategori', 5, ['sayfa' => 1])
     * @return string URL
     */
    function url()
    {
        $args = func_get_args();
        $qs = null;
        if (is_array(end($args))) {
            $qs = '?';
            foreach (end($args) as $key => $value) {
                $qs .= $key.'='.$value.'&';
            }
            $qs = substr($qs, 0, -1);
            array_pop($args);
        }
        return '/'.implode('/', $args).$qs;
    }
}
if (!function_exists('redirect')) {
    /**
     * Yönlendirme yapar
     * @param string $to Adres
     * @return void
     */
    function redirect($to)
    {
        if (headers_sent()) {
            exit("<script>window.location.href='{$to}';</script>");
        } else {
            header("Location: {$to}");
        }
    }
}
if (!function_exists('timeToString')) {
    /**
     * Tarih/saat dizgesini biçimlendirir
     * @param string $time
     * @param string $type
     * @return string
     */
    function timeToString($time, $type = 'd.m.Y')
    {
        $time = strtotime($time);
        return date($type, $time);
    }
}
if (!function_exists('htmlEncode')) {
    /**
     * HTML içeriğini filtreler
     * @param string $content
     * @return string
     */
    function htmlEncode($content)
    {
        return htmlspecialchars($content, ENT_QUOTES);
    }
}
if (!function_exists('htmlDecode')) {
    /**
     * HTML içeriğinin filtresini kaldırır
     * @param string $content
     * @return string
     */
    function htmlDecode($content)
    {
        return htmlspecialchars_decode($content, ENT_QUOTES);
    }
}
if (!function_exists('concat')) {
    /**
     * Dizgeleri birleştirir
     * @return string
     */
    function concat()
    {
        return implode(' ', func_get_args());
    }
}
if (!function_exists('permalink')) {
    /**
     * URL dostu dizge üretir
     * @param string $string
     * @return string
     */
    function permalink($string)
    {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i');
        $string = strtolower(str_replace($find, $replace, $string));
        $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = str_replace(' ', '-', $string);
        return $string;
    }
}