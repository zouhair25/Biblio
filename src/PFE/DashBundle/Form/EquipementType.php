<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PFE\DashBundle\Form\TypeequipementType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use PFE\DashBundle\Form\EspaceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class EquipementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isDisponible',ChoiceType::class
                , array(
                'choices'  => array(
                    'Disponible' => 1,
                    'Non disponible' => 0)
               )
                
           )
            ->add('nombre')
            ->add('nombre_endommage')
            ->add('nombre_nutilisable')
            //->add('created') 
            //TypeequipementType::class
            ->add('typeequipement',EntityType::class, 
                 array(
                 'class' =>  'PFEDashBundle:Typeequipement',
                 'choice_label' => 'nom'
            )
        )
            ->add('espace',EntityType::class,array(
                   'class' =>  'PFEDashBundle:Espace',
                   'choice_label' => 'typeespace.nom',
                   'multiple'=>false
            )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Equipement'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pfe_dashbundle_equipement';
    }
}
