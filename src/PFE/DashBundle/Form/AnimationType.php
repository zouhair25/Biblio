<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('occamenheb',ChoiceType::class , array(
                'choices'  => array(
                    'Hebdomadaire' => 1,
                    'Mensuel' => 2,
                    'Occasionnel' => 3),'choices_as_values' => true,
            ))
            ->add('publicvise')
            ->add('dateExposition',DateType::class, array(
                'years' => range(date("Y"),2010),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('publicTotal')
            ->add('dateanimation',DateType::class, array(
                'years' => range(date("Y"),2010),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('typeanimation',EntityType::class, array(
                'class' =>  'PFEDashBundle:Typeanimation',
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
