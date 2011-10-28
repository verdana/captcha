<?php
use net\phpvim\Captcha;

require_once 'lib/Captcha.php';

$opt = array(
    'width'      => 250,
    'height'     => 35,
    'font'       => 'Dink.ttf',
    'fontSize'   => 18,
    'background' => 'absolute.gif',
    'bgFillType' => 0, // 平铺
    'bgColor'    => array('r' => 18,  'g' => 18,  'b' => 18),
    'textColor'  => array('r' => 255, 'g' => 255, 'b' => 255),
);

$captcha = new Captcha($opt);
$captcha->create();

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/ 
 
