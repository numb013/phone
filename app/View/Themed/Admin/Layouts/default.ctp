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

$cakeDescription = __d('cake_dev', 'FDU-24:【管理画面】');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');



		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');



		echo $this->Html->css('font-awesome');
		echo $this->Html->css('custom');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('morris/morris-0.4.3.min');
		echo $this->Html->css('dataTables/dataTables.bootstrap');



		echo $this->Html->script('jquery-1.10.2');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.metisMenu');
		echo $this->Html->script('morris/raphael-2.1.0.min');
		echo $this->Html->script('morris/morris');
		echo $this->Html->script('dataTables/dataTables.bootstrap');
		echo $this->Html->script('dataTables/jquery.dataTables');
		echo $this->Html->script('custom');


	?>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="js/ajaxzip3.js" charset="UTF-8"></script>
</head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width">

<body>
	<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					</button>
					<div class="navbar-brand">
						<?php echo $this->Html->link('FDU_24', array('controller' => 'Dashboards', 'action' => 'index', 'class' => "navbar-brand")); ?>
					</div>
			</div>
<div style="color: white;
				padding: 10px 10px 5px 50px;
				float: right;
				font-size: 16px;">
				<?php echo $this->Html->link( 'Logout', array('controller' => 'users', 'action' => 'logout'),array('class'=>'btn btn-danger square-btn-adjust'));?>
</div>

	</nav>
		 <!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="main-menu">
			<li class="text-center">
			<?php echo $this->Html->link($this->Html->image('find_user.png'),array('controller'=>'user','action'=>'regist'),array('escape'=>false));?>
			</li>
			<li>
				<?php echo $this->Html->link('管理画面TOP', array('controller' => 'Dashboards', 'action' => 'index')); ?>
			<li>
				<?php echo $this->Html->link('ホームテキスト', array('controller' => 'Homes', 'action' => 'admin_index')); ?>
			</li>
			<li>
				<?php echo $this->Html->link('ブログ', array('controller' => 'blogs', 'action' => 'admin_index')); ?>
			</li>
			<li>
				<?php echo $this->Html->link('Rss', array('controller' => 'Rsses', 'action' => 'admin_index')); ?>
			</li>
			<li>
				<?php echo $this->Html->link('お問い合わせ', array('controller' => 'contacts', 'action' => 'admin_index')); ?>
			</li>
			<li  >
				<?php echo $this->Html->link('管理ユーザー', array('controller' => 'Users', 'action' => 'admin_add')); ?>
			</li>
		</ul>
	</div>
</nav>
	<div id="page-wrapper" >
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
	</div>
	<div id="footer">
	</div>

</body>
</html>
