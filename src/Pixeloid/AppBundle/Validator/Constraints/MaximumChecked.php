<?php 

namespace Pixeloid\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class MaximumChecked extends Constraint
{
	
	public $message = 'Maximum  {{ string }} mezőt pipálhatsz!';

	protected $max = 3;

	public function getMax()
	{
		return $this->max;
	}
}