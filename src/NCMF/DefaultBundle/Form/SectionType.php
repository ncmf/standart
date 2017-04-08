<?php

namespace NCMF\DefaultBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('code');
        $builder->add('title', TextType::class, array(
            'label' => 'Title',
            'required' => false,
        ));
        $builder->add('header', TextType::class, array(
            'label' => 'Заголовок страницы',
            'required' => false,
        ));
        $builder->add('keywords', TextType::class, array(
            'label' => 'Ключевые слова',
            'required' => false,
        ));
        $builder->add('template', TextType::class, array(
            'label' => 'Шаблон страницы',
            'required' => false,
        ));
        $builder->add('description', TextType::class, array(
            'label' => 'Описание страницы',
            'required' => false,
        ));
        $builder->add('content', TextareaType::class, array(
            'label' => 'Содержание страницы',
            'required' => false,
            'attr' => array(
                'class' => 'tinymce',
            )
        ));
        $builder->add('site', EntityType::class, array(
            'required' => true,
            'class' => 'NCMFDefaultBundle:Site',
            'choice_label' => 'name',
        ));
        $builder->add('parent', EntityType::class, array(
            'required' => false,
            'class' => 'NCMFDefaultBundle:Section',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.root, u.lft', 'ASC');
            },
            'choice_label' => 'indentName',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NCMF\DefaultBundle\Entity\Section'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_defaultbundle_section';
    }


}
