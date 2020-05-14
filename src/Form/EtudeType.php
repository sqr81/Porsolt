<?php

namespace App\Form;

use App\Entity\Etude;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sponsor')
            ->add('testType')
            ->add('de')
            ->add('representantSponsor')
            ->add('tre')
            ->add('commercial')
            ->add('especeAnimale')
            ->add('statut')
            ->add('commentaire')
            ->add('numero')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etude::class,
        ]);
    }


}
