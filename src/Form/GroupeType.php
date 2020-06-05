<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $etudeId = $options['etudeId'];
        $groupe = new Groupe;
        $builder

            ->add('idAnimalPorsolt')
            ->add('nomUsuel')
            ->add('puce')
//            ->add('groupeId', EntityType::class, [
//                'class'=>Produit::class,
////                'query_builder'=>function (EntityRepository $repository){
////                    return $repository->createQueryBuilder('p');
////                },
//                'mapped'=>false,
//                'choice_label'=>'groupe',
//
//            ])
            ->add('intitule')
//            ->add('nbreAnimaux')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,

        ]);
        $resolver->setRequired(['etudeId']);
    }
}
