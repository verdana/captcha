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

require_once 'Captcha.php';

$opt = array(
    'width'      => 150,
    'height'     => 35,
    'font'       => 'Dink.ttf',
    'fontSize'   => 18,
    'background' => 'absolute.gif',
    'bgFillType' => 0, // 平铺
    'bgColor'    => array('r' => 18,  'g' => 18,  'b' => 18),
    'textColor'  => array('r' => 255, 'g' => 255, 'b' => 255),
);
$captcha = new \net\phpvim\Captcha();
$captcha->create();

/*- vim: set ff=unix shiftwidth=4 tabstop=4 expandtab: -*/ 
 
