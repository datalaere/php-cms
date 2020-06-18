<?php

class Response
{
    public static function redirect($location = null, $custom_errors = null)
    {
        if($location) {

            if(is_numeric($location)) {
                switch($location) {
                    case 200:
                        header('HTTP/1.1 200 OK');
                        if($custom_errors) {
                            include($custom_errors);
                        }
                        exit();
                    break;

                    case 401:
                        header('HTTP/1.1 401 Unauthorized');
                        if($custom_errors) {
                            include($custom_errors);
                        }
                        exit();
                    break;

                    case 404:
                        header('HTTP/1.1 404 Not Found');
                        if($custom_errors) {
                            include($custom_errors);
                        }
                        exit();
                    break;
                }
            }

            header("Location: {$location}");
            exit();
        }
    }
}