<?php

namespace PFE\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType
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
            ->add('roles',ChoiceType::class,[
                    'multiple'=>true,
                    'expanded'=>true,
                    'choices' => [
                       'Emloyé' => 'ROLE_EMPLOYE',
                       'Responsable'  => 'ROLE_RESPONSABLE',
                       'Directeur' => 'ROLE_DIRECTEUR',
            ]])
          /*  ->add('dateNaissance',DateType::class, array(
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
            )*/
           // ->add('save',SubmitType::class)
        ;
    }
     public function getParent()

   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_user_registration';
    }


      public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
