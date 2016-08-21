[php Html Form Helper] - A light-weight HTML5 form generator and validator.
================================

** An easy to use, compact and flexible HTML5 form generator and validator built in php. Works well with bootstrap and jQuery validation.

### How to use the Form Helper

```php
require_once '../src/autoload.php';
use WCPDigital\Html\FormHelper;

$form = new FormHelper();
if( $form->isPost() ){

	$csrfToken = $form->request('csrfToken');
	if( !$form->validateToken('my_custom_token',$csrfToken) ){
		$errors[] = 'Invalid CSRF Token';
	}

	$email = $form->request('email','');
	$password = $form->request('password','');
	
	if( !$form->validate( $cleanData['email'], FormHelper::RULE_EMAIL ) ){
		..
	}
	
	...
}
```

```html
<form class="form-horizontal" method="post" action="" novalidate>
	<?php
	$csrfToken = $form->createToken( 'my_custom_token' );
	echo $form->hidden('csrfToken',$csrfToken);
	?>

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
		<div class="col-sm-12 text-right">
			<?php echo $form->submit('Submit Form',[
				'class'=>'btn btn-lg btn-primary'
				,'id'=>'submitBtn'
				,'name'=>'submitBtn'
			] ); ?>	
		</div>
	</div>
	
</form>
```

## License
Copyright &copy; WCP Digital &amp; Patrick Purcell<br>
Licensed under the [MIT license](http://www.opensource.org/licenses/mit-license.php).
<br>**Commercial use?** Go for it! You can include uiGlance in your commercial products.