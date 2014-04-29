<?php

namespace AyrshireMinis\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'choice', array(
                //An array of choices the user can pick
                'choices'     => array(
                    'mr'   => 'Mr',
                    'mrs'  => 'Mrs',
                    'ms'   => 'Ms',
                    'miss' => 'Miss',
                    'dr'   => 'DR'
                ),
                //Set an empty value so the user doesnt accidently submit "mr" without checking
                'empty_value' => 'Please select',
                'attr'        => array(
                    'class' => 'form-control'
                )
            ))
            ->add('name', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('company', 'text', array(
                //Stop HTML5 required validation
                'required' => false,
                'attr'     => array(
                    'class' => 'form-control'
                )
            ))
            ->add('telephone', 'text', array(
                'required' => false,
                'attr'     => array(
                    'class' => 'form-control'
                )
            ))
            ->add('email', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('message', 'textarea', array(
                //attr lets us set any key => value pair as a html attribute
                "attr" => array("cols" => "60", "rows" => 4, 'class' => 'form-control')
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AyrshireMinis\ContactBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ayrshireminis_contactbundle_contact';
    }
}
