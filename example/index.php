<?php
require_once '../src/autoload.php';
use WCPDigital\Html\FormHelper;

session_start();

$form = new FormHelper();

$errors = [];

$formData = [];

if( $form->isPost() ){
	
	$csrfToken = $form->request('csrfToken');
	if( !$form->validateToken('my_custom_token',$csrfToken) ){
		$errors[] = 'Invalid CSRF Token';
	}
	
	$formData = [
		'username' => $form->request('username','')	
		,'email' => $form->request('email','')	
		,'password' => $form->request('password','')
		,'country' => $form->request('country','')	
		,'options' => $form->request('options','')	
	];

	$cleanData = $form->sanitizeData( $formData );
	
	if( !$form->validate( $cleanData['username'], FormHelper::RULE_USERNAME ) ){
		$errors[] = 'Your username must be alphanumeric and between 4 and 22 characters in length.';
	}
	
	if( !$form->validate( $cleanData['email'], FormHelper::RULE_EMAIL ) ){
		$errors[] = 'Your Email is not a valid format.';
	}
	
	// ... Store to a repository
	// ... Redirect to a success page
	// ...
	
}
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					
					<h1>
						PHP HTML Form Helper example
					</h1>
					
					<?php if( !empty( $errors ) ): ?>
						<div class="alert alert-danger">
							<?php foreach( $errors as $err ): ?>
								<div><?php echo $err; ?></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					
					<?php if( !empty( $cleanData ) ): ?>
						<div class="alert alert-info">
							<pre><?php var_dump( $cleanData ); ?></pre>
						</div>
					<?php endif; ?>
					
					
					<form class="form-horizontal" method="post" action="" novalidate>
						<?php
						$csrfToken = $form->createToken( 'my_custom_token' );
						echo $form->hidden('csrfToken',$csrfToken);
						?>
					
						<div class="form-group">
							<?php echo $form->label('username', 'Username', ['class'=>'control-label col-sm-4'] ); ?>
							<div class="col-sm-8">
								<?php echo $form->text('username','',[
									'class'=>'form-control text'
									,'placeholder'=>'JBlogs123'
									,'required'=>'required'
								] ); ?>	
							</div>
						</div>
						
						<div class="form-group">
							<?php echo $form->label('email', 'Email', ['class'=>'control-label col-sm-4'] ); ?>
							<div class="col-sm-8">
								<?php echo $form->email('email','',[
									'class'=>'form-control email'
									,'placeholder'=>'email@domain.com'
									,'required'=>'required'
								] ); ?>	
							</div>
						</div>
						
						<div class="form-group">
							<?php echo $form->label('password', 'Password', ['class'=>'control-label col-sm-4'] ); ?>
							<div class="col-sm-8">
								<?php echo $form->password('password','',[
									'class'=>'form-control password'
									,'placeholder'=>'Password'
									,'required'=>'required'
								] ); ?>	
							</div>
						</div>
						
						<div class="form-group">
							<?php echo $form->label('country', 'country', ['class'=>'control-label col-sm-4'] ); ?>
							<div class="col-sm-8">
								<?php echo $form->select('country'
									,[
										'' => 'Select country...'
										,'AU' => 'Australia'
										,'NZ' => 'New Zealand'
									]
									,''
									,[
										 'class'=>'form-control select'
										,'required'=>'required'
									] ); ?>	
							</div>
						</div>
						
						
						<div class="form-group">
							<?php echo $form->label('options', 'Options', ['class'=>'control-label col-sm-4'] ); ?>
							<div class="col-sm-8">
								
								<div class="checkbox">
									<label>
										<?php echo $form->checkbox('options[]','Marvel' ); ?>
										Marvel
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										<?php echo $form->checkbox('options[]','DC' ); ?>
										DC
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										<?php echo $form->checkbox('options[]','Dark Horse' ); ?>
										Dark Horse
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										<?php echo $form->checkbox('options[]','Image' ); ?>
										Image
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										<?php echo $form->checkbox('options[]','Other' ); ?>
										Other
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<?php echo $form->submit('Submit Form',[
									'class'=>'btn btn-lg btn-primary'
									,'id'=>'submitBtn'
									,'name'=>'submitBtn'
								] ); ?>	
							</div>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
