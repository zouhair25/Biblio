<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PFE\DashBundle\Form\TypeequipementType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use PFE\DashBundle\Form\EspaceType;

class EquipementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('isDisponible',CheckboxType::class
                , array(
                'choices'  => array(
                    'Disponible' => 1,
                    'Non disponible' => 0),
                'choices_as_values' => true, )
                
           )*/
            ->add('nombre')
            ->add('nombre_endommage')
            ->add('nombre_nutilisable')
            //->add('created') 
            //TypeequipementType::class
            ->add('typeequipement',TypeequipementType::class
                /*'entity', array(
                'class' =>  'PFE\DashBundle\Entity\Typeequipement',*/
               // 'property' => 'nom'
            //)
        )
            ->add('espace',EspaceType::class
                /*'entity', array(
                'class' =>  'PFE\DashBundle\Entity\Espace',
                //'property' => 'typeespace.nom'
            )*/
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
