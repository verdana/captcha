<?php
/**
 * @namespace 
 */
namespace net\phpvim;

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
        'width'      => 100,
        'height'     => 24,
        'background' => 'paper.gif',
        'bgFillType' => 0, // 0: 平铺, 1: 拉伸
        'chars'      => 'abcdefghijkmnpqrstuvwxyz23456789',
        'length'     => 6,
        'font'       => 'Dink.ttf',
        'fontSize'   => 14,
        'bgColor'    => array('r' => 255, 'g' => 255, 'b' => 255),
        'textColor'  => array('r' => 0,   'g' => 0,   'b' => 0),
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
}

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/ 

