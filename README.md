# shopify-dev
```php
parameters:
    urg_shopfy:
        api_key: ""
        password: ""
        shared_secret: ""
        domain: ""
        scope: 
            - read_content
            - write_content
            - read_products
            - write_products

```

### form create using Symfony FormType

```php

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

```