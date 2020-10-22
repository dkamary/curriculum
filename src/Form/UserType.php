<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('email')
            ->add('password')
            ->add('gender')
            ->add('firstname')
            ->add('lastname')
            ->add('birthdate')
            ->add('birthplace')
            ->add('address')
            ->add('zipcode')
            ->add('town')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('isActive')
            ->add('type')
            ->add('companyType')
            ->add('nationality')
            ->add('country')
            ->add('avatar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
