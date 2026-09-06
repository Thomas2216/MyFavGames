<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinimumAgeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof MinimumAge) {
            throw new \InvalidArgumentException('Unexpected constraint type.');
        }

        if (null === $value) {
            return;
        }

        $today = new \DateTime();
        $age = $today->diff($value)->y;

        if ($age < $constraint->minAge) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ min_age }}', (string) $constraint->minAge)
                ->addViolation();
        }
    }
}
