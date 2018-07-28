<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class SocialMediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',ChoiceType::class, array(
                'choices'  => array(
                    ''   => '',
                    'fb' => 'Facebook',
                    'tw' => 'Twitter',
                    'ig' => 'Instagram',
                    'gp' => 'Google+',
                    'sw' => 'Site Web',
            )))
            ->add('url')
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
            'data_class' => 'PFE\DashBundle\Entity\SocialMedia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_socialmedia';
    }
}
