<?php 

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class Youtube extends Constraint
{
	
	public $message = 'Érvénytelen Youtube link!';

}