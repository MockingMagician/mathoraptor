#!/usr/bin/env php
<?php

$string = str_pad('aaa', round(PHP_INT_MAX / 10000000000), 'a');
echo mb_strlen($string)."\n";
echo $string."\n";
