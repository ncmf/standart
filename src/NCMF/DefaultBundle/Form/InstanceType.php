<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('code');
        $builder->add('object', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Object',
            'choice_label' => 'name',
        ));
        $builder->add('section', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Section',
            'choice_label' => 'name',
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NCMF\DefaultBundle\Entity\Instance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_defaultbundle_instance';
    }


}
