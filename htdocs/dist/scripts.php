<?php

$dev = false;

$scripts = [];

if ($dev) {
    $scripts['lab'] = 'http://localhost:8081/dist/build.js';
} else {
    $scripts['lab'] = '/dist/build.js';
}