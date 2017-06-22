<?php

namespace AppBundle\Form;
use AppBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $input_class = ['class' => 'form-control'];
        $builder
            ->add('titre', TextType::class, [
                'attr' => $input_class,
            ])
            ->add('file', FileType::class)
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-info'],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
        ));
    }
}