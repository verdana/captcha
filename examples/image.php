<?php
use net\phpvim\Captcha;

require_once 'lib/Captcha.php';

$opt = array(
    'width'      => 250,
    'height'     => 60,
    'background' => 'absolute.gif',
    'bgFillType' => 'tile',         // 'tile' or 'stretch'
    //'chars'      => 'abcdefghjkmnpqrstuvwxyz23456789',
    'charCase'   => 'random',        // 'upper', 'lower' or 'random'
    'length'     => 6,
    'font'       => 'Dink.ttf',     // font path or 'random'
    'fontSize'   => 24,
    'bgColor'    => '#000',
    'textColor'  => '#FFF',
    //'textColor'  => array('#FFF', '#CCC', '#FF0000', '#00FFFF', '#00CC00'),
);

$captcha = new Captcha($opt);
$captcha->create();

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/

