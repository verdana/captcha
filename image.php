<?php
use net\phpvim\Captcha;

require_once 'lib/Captcha.php';

$opt = array(
    'width'      => 250,
    'height'     => 60,
    'font'       => 'Dink.ttf',
    //'font'     => 'random',
    'fontSize'   => 24, // px
    'fontSize'   => 24, // px
    'background' => 'absolute.gif',
    'bgFillType' => 0, // 平铺
    'bgColor'    => '#000',
    'textColor'  => '#FFF',
    //'textColor' => array('#FFF', '#CCC', '#FF0000', '#00FFFF', '#00CC00'),
);

$captcha = new Captcha($opt);
$captcha->create();

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/ 
 
