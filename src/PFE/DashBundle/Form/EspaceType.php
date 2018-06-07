<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class EspaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isDisponible',CheckboxType::class
               /* , array('choices'  => array(
                    'Disponible' => 1,
                    'Non disponible' => 0),
                'choices_as_values' => true,)*/
            )
            ->add('etat',CheckboxType::class
                , array(
                /*'choices'  => array(
                    'Bon' => 1,
                    'Médiocre' => 0),
                'choices_as_values' => true,*/
                )
            )
            ->add('nombrePlaceAssises')
            //->add('created')
            ->add('typeespace',EntityType::class, array(
                'class' =>  'PFEDashBundle:Typeespace',
                'choice_label' => 'nom'
            ))
            ->add('bibliotheque',EntityType::class,array(
                    'class' =>  'PFEDashBundle:Bibliotheque',
                    'choice_label' => 'nom',
                    'multiple'=>false)
            )
            ->add('bibliotheque',EntityType::class,array(
                    'class' =>  'PFEDashBundle:Bibliotheque',
                    'choice_label' => 'nom',
                    'multiple'=>false)
            )

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Espace'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_espace';
    }
}
