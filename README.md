# tibia-outfitter
New Tibia Outfitter.php

## Why?
I've refactored an existing lib (by Kamil Karkus, used by Gesior) to implement some new features like consistent image output and standardize all to 64x64 sprites (transform 32x32 to 64x64).

## What's different?
* **Consistent Image Output:** all arguments are optional, no exceptions. And all arguments have validations. It means it will never output an inexistent image. For example, if you pass an inexistent looktype to image, it will use our default (that is 128, male citizen, but you can change in options);  
* **Configurable:** when instantiate Outfit, first argument is an array with settings options. You can configure/change the queries and default values, also you can queriefy by setting "query" => true;  
* **32x32** to 64x64: all 32x32 images are automagically transformed in 64x64 before output. No more different sizes;  
* **Colors are sexy:** all colors from head, body, legs and feet can be setted by numbers (tibia default colors table), hex (#FFFFFF or FFFFFF) and presetted color names like "red", "magenta", and "flat-clouds" (all flatuicolors.com colors are available by "flat-" + colorname, like "flat-peterriver").  

## Outfits folder
In this repository have an outifts.zip with all outfits/creatures until 10.79  (thanks to gesior). 

## Usage

### Direct Properties

With defaults:  
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit();
$outfit->render();
```
![](http://i.imgur.com/uElhkOj.png)  

Lets change looktype:
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit();
$outfit->looktype = 129;
$outfit->render();
```
![](http://i.imgur.com/73fMiHL.png)

Lets add addons, and see the sexy preset colors:  
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit();
$outfit->looktype = 129;
$outfit->addons = 3;
$outfit->body = "red";
$outfit->render();
```
![](http://i.imgur.com/q02vsAW.png)

Now, with all properties:
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit();
$outfit->looktype = 130;
$outfit->direction = 2;
$outfit->movement = 3;
$outfit->addons = 3;
$outfit->mount = 450;
$outfit->head = "flat-emerald"; // preset color
$outfit->body = "#FF9900"; // css-like hex
$outfit->legs = "4FE7A9"; // hex
$outfit->feet = 4; // tibia color table
$outfit->render();
```
![](http://i.imgur.com/irOk7n8.png)

### Enable properties by `$_GET` with queriefy()

```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit();
$outfit->queriefy();
$outfit->render();
```
![](http://i.imgur.com/BfTJJmk.png)

Queriefy enables properties set by `$_GET` with this params:  
`id` (looktype), `addons`, `movement`, `direction`, `mount`, `head`, `body`, `legs` and `feet`.  
Example: *outfit.php?id=128&movement=2&direction=1*

But, its a long query with long words. Fortunately you can change these query names by settings.  

### Settings

#### Auto Queriefy

```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit(array('query' => true));
$outfit->render();
```
![](http://i.imgur.com/BfTJJmk.png)

#### Queries
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit(array(
    'query' => true,
    'queries' => array(
        'mount' => 'foo'
    )
));
$outfit->render();
```
![](http://i.imgur.com/EYXU4aF.png)

#### Defaults
```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit(array(
    'query' => true,
    'defaults' => array(
        'body' => 'red',
        'mount' => 322,
        'direction' => 2 //right
    )
));
$outfit->render();
```
![](http://i.imgur.com/bPO410s.png)

## Adapting to gesior-style

My term for `gesior-style` means that query arguments are a, b, c, d, e etc.
You will need to change queries and enable `hexmount` setting

```php
<?php
include('Outfit.class.php');
header('Content-type: image/png');

$outfit = new Outfit(array(
    'query' => true,
    'hexmount' => true,
    'queries' => array(
        'looktype' => 'a',
        'addons' => 'b',
        'head' => 'c',
        'body' => 'd',
        'legs' => 'e',
        'feet' => 'f',
        'mount' => 'g',
        'direction' => 'h',
        'movement' => 'i'
    )
));
$outfit->render();
```

Now you can test  
*outfit.php?a=514&b=2&c=45&d=13&e=65&f=1&g=66083&&h=2&i=3*

![](http://i.imgur.com/0mBJPDv.png)

---

[Otland post][https://otland.net/threads/new-tibia-outfitter-php.239183/]
