<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldValueTextType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value')->add('description')->add('field');
        $builder->add('field', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:ObjectField',
            'choice_label' => 'name',
        ));
        $builder->add('instance', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Instance',
            'choice_label' => 'name',
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NCMF\DefaultBundle\Entity\FieldValueText'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_defaultbundle_fieldvaluetext';
    }


}
