<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name')
        ->add('description')
        ->add('price')
        ->add('stock')
<<<<<<< HEAD
        ->add('image')
       
        
        
        ;        
=======
        ->add('image', FileType::class, [
            'label' => 'image',

            // unmapped means that this field is not associated to any entity property
            'mapped' => false,

            // make it optional so you don't have to re-upload the PDF file
            // every time you edit the Product details
            'required' => false,

            // unmapped fields can't define their validation using annotations
            // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
                new File([
                    'mimeTypes' => [
                        'image/jpg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'ton image je laime pas reesaye stp',
                ])
            ],
        ]);        
>>>>>>> ac03925c9555c13481e3950806cefe680d2593f1
            
     }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}