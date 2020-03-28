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
            ->add('especeAnimale',ChoiceType::class, [
                'choices' => $this->getChoices()
            ]) 
            ->add('statut',ChoiceType::class,[
                'choices' => [
                    'stocké' => true,
                    'en cours' => false,
                    'détruit' => false,
                ],
            ])
            ->add('commentaire')
            ->add('numero')
            ->add('phase')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etude::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Etude::ESPECE;
        $ouput = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
