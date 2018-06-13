<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class FondocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class)
           /* ->add('created',DateType::class,array(
                'widget'=>'single_text',
                'attr'=>['class'=>'datepicker']))*/
            ->add('typefondoc',EntityType::class, array(
                'class' =>  'PFEDashBundle:Typefondoc',
                'choice_label' => 'nom'
            ))
            ->add('bibliotheque',EntityType::class, array(
                'class' =>  'PFEDashBundle:Bibliotheque',
                'choice_label' => 'nom'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Fondoc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_fondoc';
    }
}
