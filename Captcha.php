<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one or more
 * contributor license agreements.  See the NOTICE file distributed with
 * this work for additional information regarding copyright ownership.
 * The ASF licenses this file to You under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with
 * the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require 'AbstractCaptcha.php';

/**
 * Captcha Generator
 *
 * @package
 * @copyright Copyright (C) 2011
 * @author Verdana Mu
 * @license
 */
class Captcha extends AbstractCaptcha
{
    /**
     * 随机字符串
     *
     * @var mixed
     * @access private
     */
    protected $word;

    /* public __construct(array $options) {{{ */
    /**
     * __construct
     *
     * @param array $options
     * @access public
     * @return void
     */
    public function __construct($options = array())
    {
        parent::__construct($options);

        // 生成一段随机的字符串，并保存到设置中
        // TODO 支持字典模式
        $this->word = $this->random();

        // 保存到 Session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['captcha'] = $this->word;
    }
    // }}}

    /* public create() {{{ */
    /**
     * 生成图片
     *
     * @access public
     * @return void
     */
    public function create()
    {
        $fontPath = __DIR__ . '/' . $this->fontDir . $this->font;
        if (!file_exists($fontPath)) {
            throw new \Exception('Image Captcha requires font');
        }

        $width     = $this->width;
        $height    = $this->height;
        $size      = $this->fontSize;
        $image     = $this->createCanvas($width, $height);
        $textColor = ImageColorAllocate($image, $this->textColor['r'], $this->textColor['g'], $this->textColor['b']);

        $hpos = $size;
        $word = $this->word;
        for ($i = 0; $i < $this->length; $i ++) {
            $char = $word[$i];

            // 控制字符的大小写
            if ($this->charCase == 'upper') {
                $char = strtoupper($char);
            } elseif ($this->charCase == 'lower') {
                $char = strtolower($char);
            } elseif ($this->charCase == 'random') {
                $func = (rand(1, 10) < 5) ? 'strtolower' : 'strtoupper'; // 50%
                $char = $func($char);
            }

            $vpos = mt_rand($size * 1.3, $size * 2.0);
            ImageFtText($image, $size, mt_rand(-25, 50), $hpos, $vpos, $textColor, $fontPath, $char);
            $hpos += mt_rand($size, $size * 1.8);
        }

        // 生成图片并发送到浏览器
        $this->preventCache();
        header('Content-type: image/png');
        ImagePNG($image);
        ImageDestroy($image);
    }
    // }}}

    /* protected createCanvas($width, $height) {{{ */
    /**
     * 生成初始的图片画布
     *
     * @param mixed $width
     * @param mixed $height
     * @access protected
     * @return void
     */
    protected function createCanvas($width, $height)
    {
        // 创建纯色背景的图片
        $image = ImageCreateTrueColor($width, $height);

        // 是否使用背景图片?
        if (!empty($this->background)) {
            $background = __DIR__ . '/' . $this->imageDir . $this->background;
            if (!file_exists($background)) {
                throw new \Exception("Image Captcha can not locate background image");
            }
            $bgImg = @ImageCreateFromGif($background);
            if (!$bgImg) {
                throw new \Exception("Can not load background image");
            }

            $fillType = strtolower($this->bgFillType);

            // 平铺背景图
            if ($fillType == 'tile') {
                ImageSetTile($image, $bgImg);
                ImageFilledRectangle($image, 0, 0, 800, 600, IMG_COLOR_TILED);
            }

            // 拉伸背景图
            if ($fillType == 'stretch') {
                $w = ImageSx($bgImg);
                $h = ImageSy($bgImg);
                ImageCopyResampled($image, $bgImg, 0, 0, 0, 0, $width, $height, $w, $h);
            }
            return $image;
        }

        $bgColor = ImageColorAllocate($image, $this->bgColor['r'], $this->bgColor['g'], $this->bgColor['b']);
        ImageFilledRectangle($image, 0, 0, $width-1, $height-1, $bgColor);
        return $image;
    }
    // }}}

    /* protected random() {{{ */
    /**
     * 生成随机的字符串
     * 每个字符之间将被随机插入1-3个空格
     *
     * @access protected
     * @return void
     */
    protected function random()
    {
        if ($this->length <= 0) {
            $this->length = 6;
        }
        $shuffle = $this->chars;
        $i = 0;
        while ($i < $this->length) {
            $shuffle = str_shuffle($shuffle);
            $i++;
        }
        return substr($shuffle, 0, $this->length);
    }
    // }}}

    /* protected preventCache() {{{ */
    /**
     * preventCache
     *
     * @access protected
     * @return void
     */
    protected function preventCache()
    {
        if (headers_sent($filename, $linenum)) {
            throw new \Exception(sprintf('Headers already sent in %s on line %s', $filename, $linenum));
        }

        // Send headers
        header('Expires: Wed, 1 Jan 1997 00:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }
    // }}}
}

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/
