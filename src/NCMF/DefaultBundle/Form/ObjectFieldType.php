<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectFieldType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'required' => true,
            'label' => 'Название свойства',
        ));
        $builder->add('code', TextType::class, array(
            'required' => true,
            'label' => 'Код',
        ));
        $builder->add('fieldType', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:FieldType',
            'choice_label' => 'name',
            'label' => 'Тип данных',
        ));
        $builder->add('object', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Object',
            'choice_label' => 'name',
            'label' => 'Объект',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NCMF\DefaultBundle\Entity\ObjectField'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_defaultbundle_objectfield';
    }


}
