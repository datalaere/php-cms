<?php

function e($string) {
    echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}