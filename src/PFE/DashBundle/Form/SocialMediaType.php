<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SocialMediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','choice', array(
                'choices'  => array(
                    'fb' => 'Facebook',
                    'tw' => 'Twitter',
                    'ig' => 'Instagram',
                    'gp' => 'Google+',
                    'sw' => 'Site Web',
            )))
            ->add('url')
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
