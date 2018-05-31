<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BibliothequeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('dateCreation','date', array(
                'years' => range(date("Y"),1930),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('superficie')
            ->add('adresse')
            ->add('tel')
            ->add('fax')
            ->add('email')
            ->add('dateInstallationInternet','date', array(
                'years' => range(date("Y"),1930),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            ->add('isFormation','choice', array(
                'choices'  => array(
                    'OUI' => 1,
                    'NON' => 0),
                'choices_as_values' => true,
            ))
            ->add('catalogue','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Catalogue',
                'property' => 'nom'
            ))
            ->add('province','entity', array(
                'class' =>  'PFE\DashBundle\Entity\Province',
                'property' => 'nom'
            ))
//            ->add('responsable','entity', array(
//                'class' =>  'PFE\UserBundle\Entity\User',
//                'property' => 'username',
//                'query_builder' => function (\PFE\UserBundle\Entity\UserRepository $repository)
//                {
//                    return $repository->findByRoleQuery('ROLE_RESPONSABLE');
//                }
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Bibliotheque'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_bibliotheque';
    }
}
