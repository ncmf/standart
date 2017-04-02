<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldValueTextType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $valueType = TextType::class;
        $valueOptions = array(
            'label' => 'Значение'
        );
        if ($builder->getData()->getField()->getFieldType()->getType()) {
            $valueType = TextareaType::class;
            $valueOptions['attr'] = array(
                'class' => 'tinymce'
            );
        }
        $builder->add('value', $valueType, $valueOptions);
        $builder->add('description')->add('field');
        $builder->add('field', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:ObjectField',
            'choice_label' => 'name',
            'label' => 'Поле объекта'
        ));
        $builder->add('instance', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Instance',
            'choice_label' => 'name',
            'label' => 'Экземпляр'
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
