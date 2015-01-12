<body class="<?php echo (($isFrontpage) ? ('front') : ('page')).' '.$active_alias.' '.$pageclass; ?>">

<?php $pos='logo'; ?>
<?php if ($this->countModules($pos)): ?>
	<div class="container">
		<!-- <?php echo $pos; ?> -->
		<div class="row <?php echo $pos; ?>">
			<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
			<div class="clearfix"></div>
		</div><!-- div.row -->
	</div>
<?php endif;?>

<!-- RESPONSIVE MENU-->
<?php $pos='menu'; ?>
<?php if ($this->countModules($pos)): ?>
	<div class="container">
		<!-- Static navbar -->
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo $this->baseurl; ?>/"><?php echo $app->getCfg('sitename'); ?></a>
				</div>
				<div class="navbar-collapse collapse">
					<jdoc:include type="modules" name="menu"/>
					<jdoc:include type="modules" name="search" />
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</nav>
	</div>
<?php endif;?>

<?php $pos='onepage'; ?>
<?php if ($this->countModules($pos)): ?>
	<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
<?php endif;?>

<?php $pos='top'; ?>
<?php if ($this->countModules($pos)): ?>
	<div class="container">
		<!-- <?php echo $pos; ?> -->
		<div class="row <?php echo $pos; ?>">
			<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
			<div class="clearfix"></div>
		</div><!-- div.row -->
	</div>
<?php endif;?>

<?php if (!$hidecontentwrapper) : ?>
	<div class="container">
		<!-- CONTENT -->
		<div class="contentwrapper">
			<div class="row">

				<?php $pos='sidebar-a'; ?>
				<?php if ($this->countModules($pos)): ?>
					<!-- <?php echo $pos; ?> -->
					<div class="<?php echo $sidebar_a; ?> <?php echo $pos; ?>">
						<div class="row">
							<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
						</div><!-- div.row -->
					</div><!-- .<?php echo $pos; ?> -->
				<?php endif;?>

				<div class="content <?php echo $contentclass; ?>">

					<?php $pos='inner-top'; ?>
					<?php if ($this->countModules($pos)): ?>
						<!-- <?php echo $pos; ?> -->
						<div class="row <?php echo $pos; ?>">
							<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
						</div><!-- div.row -->
					<?php endif;?>

					<?php if (!$showsystemoutput) : ?>
						<jdoc:include type="message" />
						<!-- Component Start -->
						<jdoc:include type="component" />
						<!-- Component End -->
					<?php endif; ?>

					<?php $pos='inner-bottom'; ?>
					<?php if ($this->countModules($pos)): ?>
						<!-- <?php echo $pos; ?> -->
						<div class="row <?php echo $pos; ?>">
							<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
						</div><!-- div.row -->
					<?php endif;?>

				</div><!-- .content -->

				<?php $pos='sidebar-b'; ?>
				<?php if ($this->countModules($pos)): ?>
					<!-- <?php echo $pos; ?> -->
					<div class="<?php echo $sidebar_b; ?> <?php echo $pos; ?>">
						<div class="row">
							<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
						</div><!-- div.row -->
					</div><!-- .<?php echo $pos; ?> -->
				<?php endif;?>

			</div><!-- div.row -->
		</div><!-- div.contentwrapper -->
	</div><!-- div.container -->
<?php endif; ?>

<?php $pos='onepagebottom'; ?>
<?php if ($this->countModules($pos)): ?>
	<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
<?php endif;?>

<?php $pos='bottom'; ?>
<?php if ($this->countModules($pos)): ?>
	<!-- <?php echo $pos; ?> -->
	<div class="row <?php echo $pos; ?>">
		<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
	</div><!-- div.row -->
<?php endif;?>

<?php $pos='footer'; ?>
<?php if ($this->countModules($pos)): ?>
	<!-- <?php echo $pos; ?> -->
	<footer>
		<div class="container">
			<div class="row <?php echo $pos; ?>">
				<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
			</div><!-- div.row -->
		</div>
	</footer>
	<!-- End <?php echo $pos; ?> -->
<?php endif;?>

<div class="container">
	<div class="row copyright">
		<div class="col-md-12 col-lg-12"><?php echo '&copy; '.date('Y').' - '.$app->getCfg('sitename');?></div>
	</div><!-- .copyright -->
</div><!-- .container -->