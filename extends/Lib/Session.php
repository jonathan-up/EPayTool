<?php
// +----------------------------------------------------------------------
// | I was crazy about a girl
// +----------------------------------------------------------------------
// | Created By PhpStorm
// +----------------------------------------------------------------------
// | Author: J0n4than.L <admin@56fkj.cn>
// +----------------------------------------------------------------------

namespace Lib;

class Session
{
    /**
     * Session constructor.
     * @param $path
     */
    public function __construct($path)
    {
        if (!(session_status() == PHP_SESSION_ACTIVE)) {
            session_save_path($path);
            session_start();
        }
    }

    /**
     * GET
     * @param  null  $key
     * @return array|string|null
     */
    public function get($key = null)
    {
        if ($key == null) {
            return $_SESSION;
        }

        if (is_array($key)) {
            $v = [];
            foreach ($key as $item) {
                $k = isset($_SESSION[$item]) ? $_SESSION[$item] : null;
                $v[$item] = $k;
            }
            return $v;
        }

        return $_SESSION[$key];
    }

    /**
     * SET
     *
     * @param $key
     * @param  null  $value
     * @return bool
     */
    public function set($key, $value = null): bool
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
            return true;
        } else {
            if ($value == null) {
                //不是数组且value为空
                return false;
            }
        }
        $_SESSION[$key] = $value;
        return true;
    }

    /**
     * REMOVE
     *
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * 清空Session
     */
    public function clear()
    {
        session_unset();
    }
}
