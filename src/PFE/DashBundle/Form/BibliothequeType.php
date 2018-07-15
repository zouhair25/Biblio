<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use PFE\DashBundle\Form\CatalogueType;
class BibliothequeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class)
               /* ->add('dateCreation', DateType::class
              ,array(
                //)
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker']
            ))*/
                ->add('superficie',TextType::class)
                ->add('adresse',TextType::class)
                ->add('tel',TextType::class)
                ->add('fax',TextType::class)
                ->add('email',EmailType::class)
                ->add('dateInstallationInternet',DateType::class,array(
                                                                'widget'=>'single_text',
                                                                'attr'=>['class'=>'datepicker']
                   ))
                ->add('isFormation',ChoiceType::class, array(
                      'choices' => array(
                          'Oui' => '1',
                          'Non' => '0'
                      ),
                      'expanded' => true,
                      
                    ))
                 ->add('responsable')
                ->add('catalogue',EntityType::class,array(
                  'class'   =>'PFEDashBundle:Catalogue',
                  'choice_label'    =>'nom',
                  'multiple' =>false
                ))
               
                ->add('province',EntityType::class,array(
                    'class'=>'PFEDashBundle:Province',
                    'choice_label'=>'nom',
                    'multiple'=>false))
               
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Bibliotheque'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_dashbundle_bibliotheque';
    }


}
