<?php

namespace AyrshireMinis\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryImageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'attr'        => array(
                    'class' => 'form-control'
                )
            ))
            ->add('category', 'choice', array(
                // An array of choices the user can pick
                'choices'     => array(
                    'classic' => 'Classic Mini (1959-2000)',
                    'new' => 'New MINI (2001-onwards)'
                ),
                // Set an empty value so the user doesnt accidently submit "mr" without checking
                'empty_value' => 'Please select',
                'attr'        => array(
                    'class' => 'form-control'
                )
            ))
            ->add('description', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('year', 'choice', array(
                // An array of choices the user can pick
                'choices'     => $this->getYears(),
                // Set an empty value so the user doesnt accidently submit "mr" without checking
                'empty_value' => 'Please select',
                'attr'        => array(
                    'class' => 'form-control'
                )
            ))
            ->add('Image', 'file', array(
                'attr' => array(
                    'accept' => 'image/*',
                    'class' => 'btn-default'
                )
            ))
        ;
    }

    /**
     * get the years of Mini production (from 1959 onwards)
     * @return array
     */
    private function getYears()
    {
        $years = array();

        for ($i = 1959; $i <= date('Y'); $i++) {
            $years[$i] = $i;
        }

        return $years;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AyrshireMinis\GalleryBundle\Entity\GalleryImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ayrshireminis_gallerybundle_galleryimage';
    }
}
