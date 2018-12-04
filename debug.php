<?php
function bitflagsToPermissions($bitflag) {
    $permissions = array();
    if ($bitflag & 1) {array_push($permissions, "+BMD");} else {array_push($permissions, "-BMD");}
    if ($bitflag & 2) {array_push($permissions, "+ADM");} else {array_push($permissions, "-ADM");}
    if ($bitflag & 4) {array_push($permissions, "+BAN");} else {array_push($permissions, "-BAN");}
    if ($bitflag & 8) {array_push($permissions, "+VNT");} else {array_push($permissions, "-VNT");}
    if ($bitflag & 16) {array_push($permissions, "+SRV");} else {array_push($permissions, "-SRV");}
    if ($bitflag & 32) {array_push($permissions, "+DBG");} else {array_push($permissions, "-DBG");}
    if ($bitflag & 64) {array_push($permissions, "+PRM");} else {array_push($permissions, "-PRM");}
    if ($bitflag & 128) {array_push($permissions, "+PSS");} else {array_push($permissions, "-PSS");}
    if ($bitflag & 256) {array_push($permissions, "+STH");} else {array_push($permissions, "-STH");}
    if ($bitflag & 512) {array_push($permissions, "+RJV");} else {array_push($permissions, "-RJV");}
    if ($bitflag & 1024) {array_push($permissions, "+VAR");} else {array_push($permissions, "-VAR");}
    if ($bitflag & 2048) {array_push($permissions, "+SND");} else {array_push($permissions, "-SND");}
    if ($bitflag & 4096) {array_push($permissions, "+SPW");} else {array_push($permissions, "-SPW");}
    if ($bitflag & 8192) {array_push($permissions, "+MOD");} else {array_push($permissions, "-MOD");}
    if ($bitflag & 16384) {array_push($permissions, "+MTR");} else {array_push($permissions, "-MTR");}
    if ($bitflag & 32768) {array_push($permissions, "+PRC");} else {array_push($permissions, "-PRC");}
    return $permissions;
}
?>