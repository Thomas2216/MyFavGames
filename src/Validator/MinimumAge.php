<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class MinimumAge extends Constraint
{
    public string $message = 'Vous devez avoir au moins {{ min_age }} ans pour vous inscrire.';
    public int $minAge = 16;
}
