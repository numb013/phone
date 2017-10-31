<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', '【法人携帯】格安で使える情報満載 ｜ お得な法人携帯.jp');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

	<?php echo $this->Html->charset(); ?>
	<title>
            <?php if (empty($datas)): ?>
                <?php echo $cakeDescription ?>
            <?php else: ?>
                <?php echo $this->fetch('title'); ?> :
                <?php echo $cakeDescription ?>
            <?php endif; ?>       
        </title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('animate');
		echo $this->Html->css('flexslider');
                echo $this->Html->css('slider-pro');
		echo $this->Html->css('main');
		echo $this->Html->script('jquery.min.js');
                echo $this->Html->script('skel.min');
                echo $this->Html->script('util');
                echo $this->Html->script('main');
                echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="/img/180.png">
        <meta name="description" content="">
        <meta name="google-site-verification" content="x353_ujDJJV6H__kTHhDVCtuDklhAc5OQ5pHIx23fUI" />

</head>
<?php
$this->Html->addCrumb('ホーム', '/');
$this->Html->addCrumb('一覧', '/list');
$this->Html->addCrumb('詳細', '/detail');
?>
<link href="https://fonts.googleapis.com/css?family=Denk+One" rel="stylesheet">
<meta name="viewport" content="width=device-width; initial-scale=1.0" />
<body>
    <div id="wrapper">
	<?php echo $this->element('head'); ?>
	<?php echo $this->Flash->render(); ?>
	<?php echo $this->fetch('content'); ?>
</body>
</html>
