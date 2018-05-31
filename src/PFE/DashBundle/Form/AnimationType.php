<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('created')
            ->add('occamenheb', 'choice', array(
                'choices'  => array(
                    'Hebdomadaire' => 1,
                    'Mensuel' => 2,
                    'Occasionnel' => 3),'choices_as_values' => true,
            ))
            ->add('publicvise')
            ->add('dateExposition','date', array(
                'years' => range(date("Y"),2010),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('publicTotal')
            ->add('dateanimation','date', array(
                'years' => range(date("Y"),2010),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('typeanimation','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Typeanimation',
                'property' => 'nom'
            ))
            ->add('bibliotheque','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Bibliotheque',
                'property' => 'nom'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Animation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_animation';
    }
}
