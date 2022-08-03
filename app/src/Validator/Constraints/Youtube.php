<?php 

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
#[\Attribute] class Youtube extends Constraint
{
	
	public $message = 'Érvénytelen Youtube link!';

}