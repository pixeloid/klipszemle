<?php 

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class MaximumChecked extends Constraint
{
	
	public string $message = 'Maximum  {{ string }} mezőt pipálhatsz!';

	protected int $max = 3;

	public function getMax(): int
    {
		return $this->max;
	}
}