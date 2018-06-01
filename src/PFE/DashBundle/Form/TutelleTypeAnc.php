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

 public class TutelleType extends AbstractType{

 	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

 	public function buildForm(FormBuilderInterface $build, array $option){

     $build->add('created',DateType::class)
           ->add('nom',TextType::class)
           //->add('bibliotheque',BibliothequeType:)
 	}

 	 /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PFE\DashBundle\Entity\Tutelle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pfe_dashbundle_tutelle';
    }
 }