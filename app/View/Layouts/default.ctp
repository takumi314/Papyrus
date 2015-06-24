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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
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

		echo $this->Html->css('cake.generic');

		echo $this->Html->css('cooking');
		echo $this->Html->css('bootstrap_min');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('blog-post');
		//echo $this->Html->css('');
		//echo $this->Html->css('');
		
		// jQuery CDN
        echo $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js');

        // Twitter Bootstrap 3.0 CDN
        echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css');
        echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-glyphicons.css');
        echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js');
		
		// check.ctpのcssのため
		//echo $this->Html->css('//stm-study.netdna-ssl.com/b691defb5531/_assets/stm/66c27085c68c971c9dedeb98abcb5d0a.css',array('media'=>'screen', 'rel'=>'stylesheet', 'type'=>'text/css'));;
		//echo $this->Html->css('//stm-study.netdna-ssl.com/b691defb5531/_assets/stm/d1e8186026884a178731c0f44afd94a7.css',array('media'=>'all', 'rel'=>'stylesheet', 'type'=>'text/css'));


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

	<header>
		
			<nav id="header" class="navbar navbar-default" style="position: fixed; width:1380px;">
			
    				<!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar">グルメ</span>
			        <span class="icon-bar">アクティビティ</span>
			        <span class="icon-bar">ローカル</span>
			        <span class="icon-bar">生活・留学</span>
			      </button>
      				<!-- <a class="navbar-brand " href="">Papyrus</a> -->
      				<?php echo $this->Html->link('Papyrus', array('controller' => 'posts', 'action' => 'index'), array('class'=>'navbar-brand')) ; ?>
    			</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class=" nav navbar-nav">
		      	<li class="active">
		      		<?php echo $this->Html->link("Home", array('controller' => 'posts', 'action' => 'index')); ?>
		      		<span class="sr-only">(current)</span>
		      	</li>
		        <li><?php echo $this->Html->link("グルメ", array('controller' => 'categories', 'action' => 'category', 1 )); ?></li>
		        <li><?php echo $this->Html->link("アクティビティ", array('controller' => 'categories', 'action' => 'category', 2 )); ?></li>
		        <li><?php echo $this->Html->link("ローカル", array('controller' => 'categories', 'action' => 'category', 3 )); ?></li>
		        <li><?php echo $this->Html->link("生活・留学", array('controller' => 'categories', 'action' => 'category', 4 )); ?></li>
		        				
		       	<!-- <li><a href="category#4">生活・留学</a></li> -->		    
		      	<?php //foreach ($Categories as $category): ?>
					<!-- <li> -->
						<?php //echo $this->Html->Link($category['Category']['name'], array('controller' => 'Categories', 'action' => 'category', $$category['Post']['category_id'])); ?>
					<!-- </li> -->
				<?php //endforeach; ?>




		      </ul>

			  <!--  <p>navbar-form navbar-left search-logo</p> -->
		      
		      <form class="navbar-form navbar-left search-logo" role="search" action="index.html" style="width: 380px; padding-left: 40px;">
		        <div class="form-group" style="width: 270px;">
		        <input type="text" class="form-control" placeholder="Search"  id="search" style=" width: 250px;">
		        </div>
		        <button type="submit" class="btn btn-default" id="searchbtn"></button>
		      </form>


			    <ul class="nav navbar-nav navbar-right" >
			        <li style="margin-top: 6px;"><h5 style="height: 30px; width: 200px; ">ようこそ <?php echo $userName; ?> さん</h5></li>
			        <li><?php echo $this->Html->link("投稿する", array('controller' => 'posts', 'action' => 'add')); ?><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></li>
			        <li class="dropdown">
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="searchbtn">
			        		<img src="" style=""><?php echo 'ユーザー';?><span class="caret" ></span>
			        	</a>
			        	<ul class="dropdown-menu" role="menu">
				            <!-- <li><a href="">Login</a></li> -->
				            <li><?php echo $this->Html->link("Login", array('controller' => 'users', 'action' => 'login')); ?></li>
				            <li><?php echo $this->Html->link("お気に入り", array('controller' => 'favorites','action' => 'favorites')); ?></li>  
				            <li><?php echo $this->Html->link("編集・削除", array('controller' => 'posts','action' => 'edit')); ?></li>
				            <li><?php echo $this->Html->link("Logout", array('controller' => 'users','action' => 'logout')); ?></li>
				            <li class="divider"></li>
				            <li><?php echo $this->Html->link("新規登録", array('controller' => 'users','action' => 'register')); ?></li>
				            <li><?php echo $this->Html->link("アカウント設定", array('controller' => 'users','action' => 'acount')); ?></li>
				            <li><?php echo $this->Html->link("退会", array('controller' => 'users','action' => 'delate')); ?></li>
			          	</ul>
			        </li>
			    </ul>
			    </div><!-- /.navbar-collapse -->
			
			</nav>
		</div><!-- /.container-fluid -->  
	</header>



	<div class="body">

		<div class="tab-content body" style="margin-top: 85px;">
            
            <!-- ここからメイン部分 -->
            <div id="content">

						<?php echo $this->Session->flash(); ?>

						<?php echo $this->fetch('content'); ?>

			</div>	
			<!-- ここまでメイン部分 -->	


              <!-- <ul>
                    <li class="current">
                        <a href="blog.html"><img src="" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">グルメ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">アクティビティ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">ローカル</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
              </ul> -->


			

        </div>




		


		<div>

<!--
			<div class="tab-content body" style="margin-top: 85px;">
			  <div class="tab-pane active" id="home">
			  	<a href="index.html"><img src="images/background.jpg" alt="Image" style="max-width: 780px; height: auto;"></a>
			  </div>
			  <div class="tab-pane" id="food">
			  	<a href="food.html"><img src="images/DSC05821.JPG" alt="Image" style="max-width: 780px; height: auto;"></a>
			  </div>
			  <div class="tab-pane" id="activity">
			  	<a href="activity.html"><img src="" alt="Image"></a>
			  </div>
			  <div class="tab-pane" id="local">
			  	<a href="local.html"><img src="" alt="Image"></a>
			  </div>
			  <div class="tab-pane" id="life">
			  	<a href="life.html"><img src="" alt="Image"></a>
			  </div>



				<ul>
					<li class="current ">
						<a href="blog.html"><img src="images/holi-turkey.jpg" alt="Image"></a>
						<div>
							<h2><a href="blog.html">グルメ</a></h2>
							<p>
								This is just a place holder
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="images/fruits-and-bread.jpg" alt="Image"></a>
						<div>
							<h2><a href="blog.html">アクティビティ</a></h2>
							<p>
								This is just a place holder
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="images/dessert.jpg" alt="Image"></a>
						<div>
							<h2><a href="blog.html">ローカル</a></h2>
							<p>
								This is just a place holder
							</p>
						</div>
					</li>
				</ul>

-->


			</div>


<!--
			<div class="footer ">
				<ul>
					<li>
						<h2><a href="featured.html">グルメ</a></h2>
						<a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
					</li>
					<li>
						<h2><a href="recipes.html">アクティビティ</a></h2>
						<a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
					</li>
				</ul>
				<ul>
					<li>
						<h2><a href="videos.html">ローカル</a></h2>
						<a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
					</li>
					<li>
						<h2><a href="blog.html">生活・留学</a></h2>
						<a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
					</li>
				</ul>
			</div>

			<div class="footer ">
				<ul>
					<li>
						<h2><a href="featured.html">Featured Recipes</a></h2>
						<a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
					</li>
					<li>
						<h2><a href="recipes.html">A to Z Recipes</a></h2>
						<a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
					</li>
				</ul>
				<ul>
					<li>
						<h2><a href="videos.html">Videos</a></h2>
						<a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
					</li>
					<li>
						<h2><a href="blog.html">Blog</a></h2>
						<a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
					</li>
				</ul>
			</div>


		</div>

-->


		<div style="margin-top: 90px;">
		<!--
			<div >
				<h3>Cooking Video</h3>
				<a href="videos.html"><img src="images/cooking-video.png" alt="Image"></a>
				<span>Vegetable &amp; Rice Topping</span>
			</div>
		-->
			<div>
				<!-- 後で見る -->
				<h3>後で見る</h3>
				
				<?php echo $this->Element('afterlook'); ?>				

			</div>

			<div>
				<!-- <h3>最新の記事</h3> -->
				<h3>最新の記事</h3>

				<?php echo $this->Element('latest5post'); ?>
		
			</div>
			<div>
				<!-- 注目の記事 -->
				<h3>注目の記事</h3>
				<?php echo $this->Element('popular5post'); ?>
			</div>

			<div >
				<h3>Get Updates</h3>
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
				<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
				<a href="http://freewebsitetemplates.com/go/youtube/" target="_blank" id="youtube">Youtube</a>
				<a href="http://freewebsitetemplates.com/go/flickr/" target="_blank" id="flickr">Flickr</a>
				<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google&#43;</a>
			</div>
		</div>
	</div>

	<div class="footer">
		<div>
			<p>
				&copy; Copyright 2014. All rights reserved by Kohei
			</p>
		</div>
	</div>


	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>

		</div>
		<div id="content">

			<?php //echo $this->Session->flash(); ?>

			<?php //echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php //echo $this->Html->link(
					//$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					//'http://www.cakephp.org/',
					//array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				//);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
