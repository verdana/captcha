<?php
/**
 * AbstractCaptcha
 *
 * @abstract
 * @package
 * @copyright Copyright (C) 2011
 * @author Verdana Mu
 * @license
 */
abstract class AbstractCaptcha
{
    /**
     * Captcha 设置信息
     *
     * @var bool
     * @access private
     */
    protected $_data = array(
        // Common
        'imageDir'   => 'backgrounds/',
        'fontDir'    => 'fonts/',
        'dictFile'   => 'dict.dat',

        // Images
        'width'      => 250,
        'height'     => 50,
        'background' => 'paper.gif',
        'bgFillType' => 0, // 0: 平铺, 1: 拉伸
        'chars'      => 'abcdefghjkmnpqrstuvwxyz23456789',
        'charCase'   => 'upper',
        'length'     => 6,
        'font'       => 'Dink.ttf',
        'fontSize'   => 14,
        'bgColor'    => ['r' => 255, 'g' => 255, 'b' => 255],
        'textColor'  => ['r' => 0,   'g' => 0,   'b' => 0],
    );

    /* public __construct(array $options = array()) {{{ */
    /**
     * __construct
     *
     * @param array $options
     * @access public
     * @return void
     */
    public function __construct(array $options = array())
    {
        if (!extension_loaded('gd')) {
            throw new \Exception("Image Captcha requires GD extension");
        }

        if (!function_exists('imagepng')) {
            throw new \Exception("Image Captcha requires PNG support");
        }

        if (!function_exists('imageftbbox')) {
            throw new \Exception("Image Captcha requires FT fonts support");
        }

        // 覆盖默认配置信息
        if (count($options)) {
            foreach ($options as $k => $v) {
                if (isset($this->_data[$k])) {
                    if (false !== stripos($k, 'color')) {
                        $v   = (array) $v;
                        $key = array_rand($v);
                        $v   = $this->toRGB($v[$key]);
                    }
                    $this->_data[$k] = $v;
                }
            }
        }
    }
    // }}}

    /* public __isset($key) {{{ */
    /**
     * __isset
     *
     * @param mixed $key
     * @access public
     * @return void
     */
    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }
    // }}}

    /* public __get($key) {{{ */
    /**
     * __get
     *
     * @param mixed $key
     * @access public
     * @return void
     */
    public function __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
    }
    // }}}

    /* public __set($key, $val) {{{ */
    /**
     * __set
     *
     * @param mixed $key
     * @param mixed $val
     * @access public
     * @return void
     */
    public function __set($key, $val) {
        if (isset($this->_data[$key])) {
            $this->_data[$key] = $val;
        }
    }
    // }}}

    /* protected toRGB(string $color) {{{ */
    /**
     * toRGB
     *
     * @param string $color
     * @access protected
     * @return void
     */
    protected function toRGB($color)
    {
        $color = ltrim($color, '#');
        if (!preg_match("/^[0-9a-f]{3}$|^[0-9a-f]{6}$/i", $color, $matches)) {
            throw new \Exception("Invalid HTML hex color code");
        }
        if (strlen($color) == 6) {
            $r = $color[0] . $color[1];
            $g = $color[2] . $color[3];
            $b = $color[4] . $color[5];
        } elseif (strlen($color) == 3) {
            $r = $color[0] . $color[0];
            $g = $color[1] . $color[1];
            $b = $color[2] . $color[2];
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return array(
            'r' => $r,
            'g' => $g,
            'b' => $b,
        );
    }
    // }}}
}

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/
