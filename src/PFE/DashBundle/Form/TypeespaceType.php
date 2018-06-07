<?php

namespace PFE\DashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

   class TypeespaceType extends AbstractType
 {
 	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     public function buildForm(FormBuilderInterface $builder, array $options){

      $builder->
      add('nom',TextType::class)
      ;

     }


 	/**
     * {@inheritdoc}
     */
 	public function configureOptions(OptionsResolver $resolver){

 		$resolver->setDefaults(array('data_class'=>'PFE\DashBundle\Entity\Typeespace'));
 	}

 	/**
     * {@inheritdoc}
     */
 	public function  getBlockPrefix(){

 		return 'pfe_dashbundle_typeespace';
 	}
 }