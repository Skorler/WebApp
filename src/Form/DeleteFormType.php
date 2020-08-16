<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class DeleteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->users = $options['users'];
        $builder
            ->add('selectedUsers', EntityType::class, [
                'class' => User::class,
                'expanded' => true,
                'multiple' => true,
                'choices' =>$this->users
            ])
            ->add('block', SubmitType::class, ['label' => 'block'])
            ->add('unblock', SubmitType::class, ['label' => 'unblock'])
            ->add('delete', SubmitType::class, ['label' => 'delete']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'users' => null
        ]);
    }
}
//div class="custom-control custom-checkbox">
//                           <input type="checkbox" class="checkbox custom-control-input" id="{{ user.id }}" checked>
//                           <label class="custom-control-label" for="{{ user.id }}"></label>
//                           </a>
//                       </div>