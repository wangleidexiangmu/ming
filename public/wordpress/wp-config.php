<?php
define('DB_NAME', 'weixin');

define('DB_USER', 'root');

define('DB_PASSWORD', '123456abc');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8mb4');

define('DB_COLLATE', '');

define('AUTH_KEY',         'h.zzvkNRQ*2>TqjDF6{]9p*loE&EwmsS7s-oz|z/&SRi6Z nkL``CVTF#F`O@3~Y');
define('SECURE_AUTH_KEY',  '=7PzVIX<LoZ?,qGWLV<7t+D3[iWy^9nLY(I@oxjEMG.Axl?OeGPlpiN`4V&QUGc?');
define('LOGGED_IN_KEY',    'm{=A=g[tdtgZ`S+d5n(I)wO&js&TP70[R%^?l}o#5E+b$<7x*KUa-:(ry)a]gw0R');
define('NONCE_KEY',        'f<,M<wY2[bmMz4-V8:(`x8DY3_9R{r)Rcq0?2|R4>nFnC96Q*$NDa}@Zc/<r##*Y');
define('AUTH_SALT',        '7EBHn0BBy]r+-vFH>`xW[dSa?t?1BYr.9kR,Z(BJHHXL}8C&,/}CN%5<XTP)>BMK');
define('SECURE_AUTH_SALT', 'Fgc|gdbEl/8D3YQRgUk%F@zU`]TwQ4u)Va6fyblb}=I96jWVrLd}O>#96s[V]?FY');
define('LOGGED_IN_SALT',   'HZNm7lTvnF@^s!DmXsel6:c#&P7`~|L!:K3W&~<ez3L^!Tp3@)g%@0c,HRexAU##');
define('NONCE_SALT',       ';iDjeD^6Xn`#P;*i[Xx%/_lRad4/$*Fr>OYDZ+{`S8Bsge K@ y|05[uBNwO*)}~');

$table_prefix  = 'wp_';

define('WP_DEBUG', false);

if ( !defined('ABSPATH') )
		define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');

