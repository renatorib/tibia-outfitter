<?php

/**
 *
 * @author Renato Ribeiro <renatoribroman@gmail.com>
 * @copyright Copyright (c) 2015, Renato Ribeiro
 * @version 1.0
 *
 */

class Outfit {

    public $outfits_dir = "outfits/";

    public $looktype = 0;
    public $addons = 0;
    public $movement = 1; // 1 = stopped
    public $direction = 3; // 3 = front
    public $mount = 0; // mount looktype

    public $head;
    public $body;
    public $legs;
    public $feet;

    public $hexmount = false;

    public $defaults = array(
        "looktype" => 128,
        "addons" => 0,
        "movement" => 1,
        "direction" => 3,
        "mount" => 0,
        "head" => "FFFFFF",
        "body" => "FFFFFF",
        "legs" => "FFFFFF",
        "feet" => "FFFFFF"
    );

    public $queries = array(
        "looktype" => "id",
        "addons" => "addons",
        "movement" => "movement",
        "direction" => "direction",
        "mount" => "mount",
        "head" => "head",
        "body" => "body",
        "legs" => "legs",
        "feet" => "feet"
    );

    public static $colors = array(
		"FFFFFF", "FFD4BF", "FFE9BF", "FFFFBF", "E9FFBF", "D4FFBF",
		"BFFFBF", "BFFFD4", "BFFFE9", "BFFFFF", "BFE9FF", "BFD4FF",
		"BFBFFF", "D4BFFF", "E9BFFF", "FFBFFF", "FFBFE9", "FFBFD4",
		"FFBFBF", "DADADA", "BF9F8F", "BFAF8F", "BFBF8F", "AFBF8F",
		"9FBF8F", "8FBF8F", "8FBF9F", "8FBFAF", "8FBFBF", "8FAFBF",
		"8F9FBF", "8F8FBF", "9F8FBF", "AF8FBF", "BF8FBF", "BF8FAF",
		"BF8F9F", "BF8F8F", "B6B6B6", "BF7F5F", "BFAF8F", "BFBF5F",
		"9FBF5F", "7FBF5F", "5FBF5F", "5FBF7F", "5FBF9F", "5FBFBF",
		"5F9FBF", "5F7FBF", "5F5FBF", "7F5FBF", "9F5FBF", "BF5FBF",
		"BF5F9F", "BF5F7F", "BF5F5F", "919191", "BF6A3F", "BF943F",
		"BFBF3F", "94BF3F", "6ABF3F", "3FBF3F", "3FBF6A", "3FBF94",
		"3FBFBF", "3F94BF", "3F6ABF", "3F3FBF", "6A3FBF", "943FBF",
		"BF3FBF", "BF3F94", "BF3F6A", "BF3F3F", "6D6D6D", "FF5500",
		"FFAA00", "FFFF00", "AAFF00", "54FF00", "00FF00", "00FF54",
		"00FFAA", "00FFFF", "00A9FF", "0055FF", "0000FF", "5500FF",
		"A900FF", "FE00FF", "FF00AA", "FF0055", "FF0000", "484848",
		"BF3F00", "BF7F00", "BFBF00", "7FBF00", "3FBF00", "00BF00",
		"00BF3F", "00BF7F", "00BFBF", "007FBF", "003FBF", "0000BF",
		"3F00BF", "7F00BF", "BF00BF", "BF007F", "BF003F", "BF0000",
		"242424", "7F2A00", "7F5500", "7F7F00", "557F00", "2A7F00",
		"007F00", "007F2A", "007F55", "007F7F", "00547F", "002A7F",
		"00007F", "2A007F", "54007F", "7F007F", "7F0055", "7F002A",
		"7F0000"
	);

    public function __construct($options = array()){
        if(isset($options['defaults']))
            $this->defaults = array_merge($this->defaults, $options['defaults']);

        $this->looktype = $this->defaults['looktype'];
        $this->addons = $this->defaults['addons'];
        $this->movement = $this->defaults['movement'];
        $this->direction = $this->defaults['direction'];
        $this->mount = $this->defaults['mount'];
        $this->head = $this->defaults['head'];
        $this->body = $this->defaults['body'];
        $this->legs = $this->defaults['legs'];
        $this->feet = $this->defaults['feet'];

        if(isset($options['queries']))
            $this->queries = array_merge($this->queries, $options['queries']);

        if(isset($options['query']) && $options['query'] == true)
            $this->queriefy();

        if(isset($options['hexmount']) && $options['hexmount'] == true)
            $this->hexmount = true;

        $verboseColors = array(
            'black' => '000000',
            'white' => 'FFFFFF',
            'gray' => '777777',
            'red' => 'FF0000',
            'redlight' => 'FF4444',
            'reddark' => '880000',
            'firebrick' => 'B22222',
            'brown' => 'A52A2A',
            'sienna' => 'A0522D',
            'green' => '00FF00',
            'greenlight' => '44FF44',
            'greendark' => '008800',
            'greenyellow' => 'ADFF2F',
            'yellow' => 'FFFF00',
            'cyan' => '00FFFF',
            'blue' => '0000FF',
            'bluelight' => '4444FF',
            'bluedark' => '000088',
            'royalblue' => '4169E1',
            'skyblue' => '87CEEB',
            'magenta' => 'FF00FF',
            'purple' => 'A020F0',
            'pink' => 'EE799F',
            'pinklight' => 'FFC0CB',
            'pinkdark' => '8B475D',
            'salmon' => 'FA8072',
            'seashell' => 'FFF5EE',
            'flat-turquoise' => '1abc9c',
            'flat-greensea' => '16a085',
            'flat-emerald' => '2ecc71',
            'flat-nephritis' => '27ae60',
            'flat-peterriver' => '3498db',
            'flat-belizehole' => '2980b9',
            'flat-amethyst' => '9b59b6',
            'flat-wisteria' => '8e44ad',
            'flat-wetasphalt' => '34495e',
            'flat-midnightblue' => '2c3e50',
            'flat-sunflower' => 'f1c40f',
            'flat-orange' => 'f39c12',
            'flat-carrot' => 'e67e22',
            'flat-pumpkin' => 'd35400',
            'flat-alizarin' => 'e74c3c',
            'flat-pomegranate' => 'c0392b',
            'flat-clouds' => 'ecf0f1',
            'flat-silver' => 'bdc3c7',
            'flat-concrete' => '95a5a6',
            'flat-asbestos' => '7f8c8d'
        );
        self::$colors = array_merge(self::$colors, $verboseColors);

        return $this;
    }

    public function queriefy(){
        $q = $this->queries;
        isset($_GET[$q['looktype']]) ? $this->looktype = $_GET[$q['looktype']] : null;
        isset($_GET[$q['addons']]) ? $this->addons = $_GET[$q['addons']] : null;
        isset($_GET[$q['movement']]) ? $this->movement = $_GET[$q['movement']] : null;
        isset($_GET[$q['direction']]) ? $this->direction = $_GET[$q['direction']] : null;
        isset($_GET[$q['mount']]) ? $this->mount = $_GET[$q['mount']] : null;
        isset($_GET[$q['head']]) ? $this->head = $_GET[$q['head']] : null;
        isset($_GET[$q['body']]) ? $this->body = $_GET[$q['body']] : null;
        isset($_GET[$q['legs']]) ? $this->legs = $_GET[$q['legs']] : null;
        isset($_GET[$q['feet']]) ? $this->feet = $_GET[$q['feet']] : null;

        return $this;
    }

    public function render(){

        $basepath = $this->outfits_dir;

        // Setup and validates
        $looktype = $this->looktype;
        $movement = $this->movement;
        if(!in_array($movement, array(1,2,3))){
            $movement = 1;
        }
        $direction = $this->direction;
        if(!in_array($direction, array(1,2,3,4))){
            $direction = 3;
        }
        $addons = $this->addons;
        if(!in_array($addons, array(0,1,2,3))){
            $addons = 0;
        }
        $mountid = $this->mount;
        if($this->hexmount == true){
            $mountid = ($mountid & 0xFFFF);
        }
        $haveTemplate = true;
        $mountstate = 1;
        if($mountid > 0)
            $mountstate = 2;

        // Setup Paths
        $looktype_check = $basepath  . "{$looktype}/1_1_1_1.png";
        $outfit         = $basepath  . "{$looktype}/{$movement}_{$mountstate}_1_{$direction}.png";
        $outfit_tpl     = $basepath  . "{$looktype}/{$movement}_{$mountstate}_1_{$direction}_template.png";
        $addon1         = $basepath  . "{$looktype}/{$movement}_{$mountstate}_2_{$direction}.png";
        $addon1_tpl     = $basepath  . "{$looktype}/{$movement}_{$mountstate}_2_{$direction}_template.png";
        $addon2         = $basepath  . "{$looktype}/{$movement}_{$mountstate}_3_{$direction}.png";
        $addon2_tpl     = $basepath  . "{$looktype}/{$movement}_{$mountstate}_3_{$direction}_template.png";
        $mount          = $basepath  . "{$mountid}/{$movement}_1_1_{$direction}.png";

        // Check if is available looktype and set $image,
        // if not, it uses male citizen
        if(file_exists($looktype_check)){
            if(!file_exists($outfit) && $mountstate == 2){
                $this->mount = 0;
                return $this->render();
            }
            if(!file_exists($outfit) && $movement != 1){
                $this->movement = 1;
                return $this->render();
            }
            if(!file_exists($outfit) && $direction == 3){
                $this->direction = 1;
                return $this->render();
            }
            $image = imagecreatefrompng($outfit);
        } else {
            $this->looktype = 128;
            return $this->render();
        }

        // Check if has template
        // monsters dont have template (with exceptions like elf, frog...)
        if(file_exists($outfit_tpl)){
            $template = imagecreatefrompng($outfit_tpl);
        } else {
            $haveTemplate = false;
        }

        //addons
        if($addons == 1 || $addons == 3){
            if(file_exists($addon1)){
                $addon1_image = imagecreatefrompng($addon1);
                self::overlay($image, $addon1_image);
                $addon1_template_image = imagecreatefrompng($addon1_tpl);
    			self::overlay($template, $addon1_template_image);
            }
        }
        if($addons == 2 || $addons == 3){
            if(file_exists($addon2)){
                $addon2_image = imagecreatefrompng($addon2);
                self::overlay($image, $addon2_image);
                $addon2_template_image = imagecreatefrompng($addon2_tpl);
    			self::overlay($template, $addon2_template_image);
            }
        }

        // paint if has template
        if($haveTemplate)
            self::colorize($image, $template, $this->head, $this->body, $this->legs, $this->feet);

        // add mount if have
        if($mountid > 0){
            if(file_exists($mount)){
                $mount_image = imagecreatefrompng($mount);
                if(imagesx($mount_image) < 64){
                    //transform 32x32 into 64x64
                    $base_mount = imagecreatetruecolor(64, 64);
                    imagesavealpha($base_mount, true);
                    imagefill($base_mount, 0, 0, imagecolorallocatealpha($base_mount, 0, 0, 0, 127));

                    imagecopyresampled($base_mount, $mount_image, 32, 32, 0, 0, 32, 32, 32, 32);
                    $mount_image = $base_mount;
                }
                self::overlay($mount_image, $image);
                $image = $mount_image;
            } else {
                $this->mount = 0;
                $this->render();
            }
        }

        // transform 32x32 into 64x64
        if(imagesx($image) < 64){
            $base = imagecreatetruecolor(64, 64);
            imagesavealpha($base, true);
            imagefill($base, 0, 0, imagecolorallocatealpha($base, 0, 0, 0, 127));

            imagecopyresampled($base, $image, 32, 32, 0, 0, 32, 32, 32, 32);
            $image = $base;
        }

        imagealphablending($image, false);
        imagesavealpha($image, true);
        imagepng($image);
    }

    /**
    *
    * Image helpers (static functions)
    * Author: Kamil Karkus <kaker@wp.eu>
    * adapted by Renato Ribeiro
    *
    */

    public static function overlay(&$destImg, &$overlayImg) {
        $imgW = min(imagesx($destImg), imagesx($overlayImg));
        $imgH = min(imagesy($destImg), imagesy($overlayImg));
		for ($y = 0; $y < $imgH; $y++) {
			for ($x = 0; $x < $imgW; $x++) {
				$ovrARGB = imagecolorat($overlayImg, $x, $y);
				$ovrA = ($ovrARGB >> 24) << 1;
				$ovrR = $ovrARGB >> 16 & 0xFF;
				$ovrG = $ovrARGB >> 8 & 0xFF;
				$ovrB = $ovrARGB & 0xFF;

				$change = false;
				if ($ovrA == 0) {
					$dstR = $ovrR;
					$dstG = $ovrG;
					$dstB = $ovrB;
					$change = true;
				} elseif ($ovrA < 254) {
					$dstARGB = imagecolorat($destImg, $x, $y);
					$dstR = $dstARGB >> 16 & 0xFF;
					$dstG = $dstARGB >> 8 & 0xFF;
					$dstB = $dstARGB & 0xFF;

					$dstR = (($ovrR * (0xFF - $ovrA)) >> 8) + (($dstR * $ovrA) >> 8);
					$dstG = (($ovrG * (0xFF - $ovrA)) >> 8) + (($dstG * $ovrA) >> 8);
					$dstB = (($ovrB * (0xFF - $ovrA)) >> 8) + (($dstB * $ovrA) >> 8);
					$change = true;
				}
				if ($change) {
					$dstRGB = imagecolorallocatealpha($destImg, $dstR, $dstG, $dstB, 0);
					imagesetpixel($destImg, $x, $y, $dstRGB);
				}
			}
		}
		return $destImg;
	}

    public static function colorizePixel($color, &$_r, &$_g, &$_b){
        if(isset(self::$colors[$color]))
            $color = self::$colors[$color];

        $value = hexdec("0x" . ltrim($color, '#'));
        $ro = ($value & 0xFF0000) >> 16; // rgb outfit
        $go = ($value & 0xFF00) >> 8;
        $bo = ($value & 0xFF);
        $_r = (int) ($_r * ($ro / 255));
        $_g = (int) ($_g * ($go / 255));
        $_b = (int) ($_b * ($bo / 255));
    }

    public static function colorize($_image_outfit, $_image_template, $_head, $_body, $_legs, $_feet){
        for ($i = 0; $i < imagesy($_image_template); $i++) {
			for ($j = 0; $j < imagesx($_image_template); $j++) {
				$templatepixel = imagecolorat($_image_template, $j, $i);
				$outfit = imagecolorat($_image_outfit, $j, $i);

				if ($templatepixel == $outfit)
					continue;

				$rt = ($templatepixel >> 16) & 0xFF;
				$gt = ($templatepixel >> 8) & 0xFF;
				$bt = $templatepixel & 0xFF;
				$ro = ($outfit >> 16) & 0xFF;
				$go = ($outfit >> 8) & 0xFF;
				$bo = $outfit & 0xFF;

				if ($rt && $gt && !$bt) { // yellow == head
					self::colorizePixel($_head, $ro, $go, $bo);
				} else if ($rt && !$gt && !$bt) { // red == body
					self::colorizePixel($_body, $ro, $go, $bo);
				} else if (!$rt && $gt && !$bt) { // green == legs
					self::colorizePixel($_legs, $ro, $go, $bo);
				} else if (!$rt && !$gt && $bt) { // blue == feet
					self::colorizePixel($_feet, $ro, $go, $bo);
				} else {
					continue; // if nothing changed, skip the change of pixel
				}

				imagesetpixel($_image_outfit, $j, $i, imagecolorallocate($_image_outfit, $ro, $go, $bo));
			}
		}
    }

}
