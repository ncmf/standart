<?php

namespace NCMF\DefaultBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldTypeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => 'Название',
            'required' => true
        ));
        $builder->add('code', TextType::class, array(
            'label' => 'Код',
            'required' => true
        ));
        $builder->add('type', ChoiceType::class, array(
            'label' => 'Тип',
            'choices' => array(
                'Строка' => 'string',
                'Текст' => 'text',
                'HTML' => 'html',
                'Дата' => 'date',
                'Время' => 'time',
                'Дата и время' => 'date_time',
                'Год' => 'year',
                'Месяц' => 'month',
                'День месяца' => 'day_of_month',
                'День недели' => 'day_of_week',
                'Изображение' => 'image',
                'Файл' => 'file',
            ),
            'required' => true,
        ));
        $builder->add('properties', TextareaType::class, array(
            'label' => 'Свойства',
            'required' => false
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NCMF\DefaultBundle\Entity\FieldType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_defaultbundle_fieldtype';
    }


}
