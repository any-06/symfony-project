<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre :',
                'required' => true
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.enable = true')
                        ->orderBy('c.titre', 'ASC');
                },
                'label' => 'Catégories :',
                'choice_label' => 'titre',
                'multiple' => true,
                'by_reference' => false
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu :',
                'required' => true
            ]);
        // ->add('save', SubmitType::class, [
        //     'label' => 'CRÉER',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
