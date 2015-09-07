<?php 

namespace Pixeloid\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * @Annotation
 */
class MaximumCheckedValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
// 		foreach ($value as $key => $value) {
// 			var_dump(($value->getId()));
// 			# code...
// 		}
// exit;
		if(count($value) > $constraint->getMax()){
			$this->buildViolation($constraint->message)
			    ->setParameter('{{ string }}', $constraint->getMax())
			    ->addViolation();
		}


	}


}