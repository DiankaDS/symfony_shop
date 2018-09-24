<?php
namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control']])
            ->add('username', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('name', TextType::class, ['label' => 'Full name', 'attr' => ['class' => 'form-control']])
            ->add('phone', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('card', TextType::class, ['label' => 'Number of shop card', 'attr' => ['class' => 'form-control']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Users::class,
        ));
    }
}
