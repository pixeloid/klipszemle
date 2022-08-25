<?php 

namespace App\Validator\Constraints;

use App\Entity\EventRegistration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * @Annotation
 */
class YoutubeValidator extends ConstraintValidator
{


    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
	{

		if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $value, $id)) {
		  $values = $id[1];
		} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $value, $id)) {
		  $values = $id[1];
		} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $value, $id)) {
		  $values = $id[1];
		} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $value, $id)) {
		  $values = $id[1];
		}
		else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $value, $id)) {
			$values = $id[1];
		} else {   
		// not an youtube video
		}


		if(!isset($values)){
			$this->context->buildViolation($constraint->message)
			    ->addViolation();
		}
        if (!isset($id[1])) return;

        $dupe = $this->entityManager->getRepository(EventRegistration::class)->findOneBy(['yt_id' => $id[1]]);

        if($dupe) {
            $this->context->buildViolation('Ez a video már nevezésre került!')
                ->addViolation();

        }

	}


}
