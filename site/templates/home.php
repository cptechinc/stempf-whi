<?php 
	include $config->paths->content."logic/api-docs-logic.php"; 
	$functions = array_keys($apifunctions); 
?>

<?php include('./_head.php'); ?>
	
	<div class="container">
		<h1 class="text-primary"><?php echo $page->get('pagetitle|headline|title') ; ?></h1>
	</div>


    <div class="container page">
        
        <div class="row">
        	<div class="col-xs-12">
				<?php foreach($functions as $function) : ?>
					<div class="panel panel-info">
						<div class="panel-heading"><h3 class="panel-title"><?php echo $function; ?> </h3></div>
						<div class="panel-body">
							<div>
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#<?= $function."-details"; ?>" aria-controls="send" role="tab" data-toggle="tab">Details </a>
									</li>
									<li role="presentation">
										<a href="#<?= $function."-send"; ?>" aria-controls="send" role="tab" data-toggle="tab">Sample JSON </a>
									</li>
									<li role="presentation">
										<a href="#<?= $function."-response"; ?>" aria-controls="response" role="tab" data-toggle="tab">Sample Response </a>
									</li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="<?= $function."-details"; ?>">
										<br>
										<p>Test URL: <a href="<?= $apifunctions[$function]['url']['request']."test/"; ?>"><?= $apifunctions[$function]['url']['request']; ?></a></p>
									</div>
									<div role="tabpanel" class="tab-pane" id="<?= $function."-send"; ?>">
										<br>
										<div class="code">
											<?php 
												$json = json_decode(file_get_contents($apifunctions[$function]['json']['request']));
												echo nl2br(str_replace("\t", "&nbsp; &nbsp; &nbsp; &nbsp;", json_format($json)));
											?>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="<?= $function."-response"; ?>">
										<br>
										<div class="code">
											<?php 
												$json = json_decode(file_get_contents($apifunctions[$function]['json']['response']));
												echo nl2br(str_replace("\t", "&nbsp; &nbsp; &nbsp; &nbsp;", json_format($json)));
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<?php endforeach; ?>
			</div>
        </div>
    </div>
<?php include('./_foot.php'); // include footer markup ?>
