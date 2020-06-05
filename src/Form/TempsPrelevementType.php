<?php

namespace App\Form;

use Symfony\Component\Form\CallbackTransformer;
use App\Entity\TempsPrelevement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TempsPrelevementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tempsPrelevement')
//           ->add('groupes')
//            ->add('dataCheckBox')

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TempsPrelevement::class,
        ]);
    }
}
