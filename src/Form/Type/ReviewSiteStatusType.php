<?php

namespace App\Form\Type;

use App\DBAL\Types\ReviewSiteStatusType as ReviewSiteStatusEnumType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReviewSiteStatusType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => ReviewSiteStatusEnumType::getChoices()
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
