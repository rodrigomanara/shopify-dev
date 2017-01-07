<?php

namespace Urg\ShopfyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use \Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('title')
                ->add('vendor')
                ->add("product_type")
                ->add('image', HiddenType::class , array('label' => ''))
                ->add('filename', HiddenType::class , array('label' => ''))
                ->add(
                        $builder
                        ->create('variants', FormType::class, array('by_reference' => true
                            , 'label' => ''
                            , 'attr' => array('class' => '')
                        ))
                        ->add('option1', TextType::class, array('label' => 'Option Title'))
                        ->add('sku', TextType::class)
                        ->add('price', MoneyType::class, array('label' => 'price',
                            'currency' => ''
                        ))
                )
                ->add('body_html', TextareaType::class, array(
                    'attr' => array('class' => 'materialize-textarea'),
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

}
