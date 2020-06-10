<?php

function esc($string) {
    echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}