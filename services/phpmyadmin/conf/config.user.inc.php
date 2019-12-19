<?php

$cfg['blowfish_secret'] = 'e10adc3949ba59abbe56e057f20f883e'; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */
$cfg['AllowArbitraryServer'] = false;

$connect_hosts = [
    1 => [
        'name' => 'localhost',
        'host' => 'mysql',
        'port' => 3306,
        'user' => 'docker',
        'password' => 'secret',
    ],
    2 => [
        'name' => 'wxyy',
        'host' => '172.18.0.2',
        'port' => 3306,
        'user' => 'wxyy_user',
        'password' => 'secret*73&23',
    ],
    3 => [
        'name' => 'maiguoer_test',
        'host' => 'rm-wz9bd20d3b7f4nefzco.mysql.rds.aliyuncs.com',
        'port' => 3306,
        'user' => 'wangzjun',
        'password' => 'jun@Mge%18$',
    ],
    4 => [
        'name' => 'maiguoer_prod',
        'host' => 'rm-bp11815ve74q663uuwo.mysql.rds.aliyuncs.com',
        'port' => 3306,
        'user' => 'jun',
        'password' => 'jun@Mge%18$',
    ],

];

foreach($connect_hosts as $key => $row)
{
    $cfg['Servers'][$key]['auth_type'] = 'config'; //cookie
    $cfg['Servers'][$key]['host'] = $row['host'];
    $cfg['Servers'][$key]['user'] = $row['user'];
    $cfg['Servers'][$key]['password'] = $row['password'];
    $cfg['Servers'][$key]['verbose'] = $row['name'];
    $cfg['Servers'][$key]['compress'] = false;
    $cfg['Servers'][$key]['AllowNoPassword'] = false;
    $cfg['Servers'][$key]['controlhost'] = $row['host'];
    $cfg['Servers'][$key]['controlport'] = $row['port'];
    $cfg['Servers'][$key]['controluser'] = $row['user'];
    $cfg['Servers'][$key]['controlpass'] = $row['password'];
}

$cfg['LoginCookieValidity'] = 60 * 60 * 24 * 30 * 12;
