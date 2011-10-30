<?php
use net\phpvim\Captcha;

require_once 'lib/Captcha.php';

$opt = array(
    'width'      => 200,
    'height'     => 60,
    'font'       => 'Dink.ttf',
    'fontSize'   => 22, // px
    'background' => 'absolute.gif',
    'bgFillType' => 0, // 平铺
    'bgColor'    => '#000',
    'textColor'  => '#FFF',
);

$captcha = new Captcha($opt);
$captcha->create();

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/ 
 
