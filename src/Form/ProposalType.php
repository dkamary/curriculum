<?php

namespace App\Form;

use App\Entity\Proposal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProposalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('startTime')
            ->add('endTime')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('isActive')
            ->add('owner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proposal::class,
        ]);
    }
}
