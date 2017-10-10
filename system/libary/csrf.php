<?php

namespace system\libary;
/**
 * CSRF Koruma Sınıfı
 *https://github.com/DemirPHP/CSRF-Korumasi
 */
class csrf
{
    /**
     * Zaman aşımını belirler (saniye)
     * 300 saniye 5 dakika
     * 900 saniye 15 dakika
     * @var integer
     */
    public static $timeout = 900;
    /**
     * HTML biçiminde, saklı bir girdi kodu döndürür
     * @return string
     */
    public static function field()
    {
        return '<input type="hidden" name="csrf" value="' . self::token() . '">';
    }
    /**
     * Güvenlik için bir belirti yaratır, bunu yaratırken
     * Zaman, rastgele oluşturulmuş bir metin, oturum ID'si ve IP adresi
     * kullanır. Bunları oturum verisi olarak saklar. Daha sonra tüm bunları
     * calculate ile hesaplayarak şifreler.
     * @return string
     */
    public static function token()
    {
        if (!session_id()) throw new \Exception('Oturum (Session) başlatılmamış');
        $_SESSION['csrf']['time'] = time();
        $_SESSION['csrf']['salt'] = self::randomize(32);
        $_SESSION['csrf']['sid'] = session_id();
        $_SESSION['csrf']['ip'] = $_SERVER['REMOTE_ADDR'];
        return base64_encode(self::hash());
    }
    /**
     * Geçerli olarak 32 haneli rastgele bir metin üreten metod
     * @param integer $len
     * @return string
     */
    protected static function randomize($len = 32)
    {
        $rs = null;
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz2345678901_-/+!~()';
        $totalChars = strlen($chars);
        for ($i=0; $i < $len; $i++) {
            $rInt = (integer) mt_rand(0, $totalChars);
            $rs .= substr($chars, $rInt, 1);
        }
        return $rs;
    }
    /**
     * Oturum verilerini metine çevirip sha1 ile şifreler
     * @return string
     */
    protected static function hash()
    {
        return sha1(implode('', $_SESSION['csrf']));
    }
    /**
     * Gelen belirti (token) hala geçerli mi, bunu kontrol eder
     * Değer olarak gelen post verisini alır, yoksa birinci parametre
     * olarak değer belirtmek gerekir. Zaman aşımı istenirse ikinci
     * parametreden ayarlanabilir. Zaman aşımına uğramışa false döner.
     * Belirti değerleri eşitse, olumlu döndürür
     * @param string $token
     * @param integer $timeout
     * @return boolean
     */
    public static function check($token = null)
    {
        if (isset($_POST['csrf'])) {
            if (is_null($token)) $token = $_POST['csrf'];
        }
        if (!self::timeout()) return false;
        if (isset($_SESSION['csrf']) && $token) {
            return (base64_decode($token) == self::hash());
        }
        return false;
    }
    /**
     * Oturumun zaman aşımını belirler ve kontrol eder
     * @param integer $timeout
     * @return mixed
     */
    public static function timeout($timeout = null)
    {
        if (!is_null($timeout)) self::$timeout = $timeout;
        if (isset($_SESSION['csrf']['time'])) {
            return ($_SERVER['REQUEST_TIME'] - $_SESSION['csrf']['time']) < self::$timeout;
        }
        return;
    }
}