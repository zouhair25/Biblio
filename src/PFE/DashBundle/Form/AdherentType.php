<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use PFE\DashBundle\Form\BibliothequeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class AdherentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          /*  ->add('created',DateType::class,array(
                            'widget'=>'single_text',
                            'format'=>'dd-MM-y',
                            'attr'=>['class'=>'datepicker']
                                ))*/
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('dateNaissance',DateType::class, array(
                'years' => range(date("Y"),1930),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker'],))
            //->add('age')
            ->add('sexe',ChoiceType::class, array(
                'choices'  => array(
                    'Homme' => 1,
                    'Femme' => 0),
                    'choices_as_values' => true,
            ))
            ->add('dateInscription',DateType::class, array(
                'years' => range(date("Y"),2010),
                'format' => 'dd-MM-y',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker']))
            ->add('bibliotheque',EntityType::class,array(
                'class' =>  'PFEDashBundle:Bibliotheque',
                'choice_label' => 'nom',
                'multiple'=>false
            )
            )
           // ->add('save',SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Adherent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_adherent';
    }
}
