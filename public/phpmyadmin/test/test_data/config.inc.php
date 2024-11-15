<?php
/**
 * Minimal config file for test
 */

declare(strict_types=1);

$i = 0;

/* Server: localhost [1] */
$i++;
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Servers'][$i]['verbose'] = '';
$cfg['Servers'][$i]['host'] = '127.0.0.1:3306';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['socket'] = '';
$cfg['Servers'][$i]['auth_type'] = 'cookie';
