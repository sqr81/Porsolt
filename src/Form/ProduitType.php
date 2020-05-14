<?php

namespace App\Form;

use App\Entity\Etude;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProduitPorsolt')
            ->add('groupe')
            ->add('nbreAnimaux')
            ->add('voieAdmin')
            ->add('datePremierPrelevement')
//        , DateType::class, [
//                'translation_domain' => 'invoicing',
//                'label' => 'date premier prélèvement',
//                'widget' => 'single_text',
//                'format' => 'dd.MM.yy',
//                'required' => true,
//                // prevents rendering it as type="date", to avoid HTML5 date pickers
//                'html5' => false,
//                // adds a class that can be selected in JavaScript
//                'attr' => ['class' => 'datepicker'],
//            ])

            //->add('commentaire')
            ->add('etude', EntityType::class, [
                'class'=>Etude::class,
                'query_builder'=>function (EntityRepository $repository){
                    return $repository->createQueryBuilder('e');
                }

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }

}