<?php

class Image {

    private $folder;

    public function __construct() {
        $this->folder = $folder;
    }
    
    public function gallery() {
        $handle = opendir($this->folder);
        while (false !== ($image = readdir($handle))) {
            if ($image != '.' && $image != '..') {
                $gallery[] = $image;
            }
        }
    }
    
    public function resizeJpegImage($img, $w, $h) {
        $thumbnail = imagecreatetruecolor($w, $h);
        $image = imagecreatefromjpeg($img);

        $imageize = getimagesize($img);
        imagecopyresized($thumbnail, $image, 0, 0, 0, 0, $w, $h, $imagesize[0], $imagesize[1]);
        imagejpeg($thumbnail, $img);
    }

    public function resizePngImage($img, $w, $h) {
        $thumbnail = imagecreatetruecolor($w, $h);
        $image = imagecreatefrompng($img);

        $imagesize = getimagesize($img);
        imagecopyresized($thumbnail, $image, 0, 0, 0, 0, $w, $h, $imagesize[0], $imagesize[1]);
        imagepng($thumbnail, $img);
    }

    public function resizeGifImage($img, $w, $h) {
        $thumbnail = imagecreatetruecolor($w, $h);
        $image = imagecreatefromgif($img);

        $imagesize = getimagesize($img);
        imagecopyresized($thumbnail, $image, 0, 0, 0, 0, $w, $h, $imagesize[0], $imagesize[1]);
        imagegif($thumbnail, $img);
    }

}