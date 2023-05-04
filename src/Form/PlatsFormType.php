<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;

class PlatsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', options: [
                'label' => 'Nom'
            ])
            ->add('description', options: [
                'label' => 'Description'
            ])
            ->add('prix', MoneyType::class, options: [
                'label' => 'Prix',
                'constraints' => [
                    new Positive(
                        message: 'Le prix ne peut être négatif'
                    )
                ]
            ])
//            ->add('image', options: [
//                'label' => 'Image'
//            ])
            ->add('active', options: [
                'label' => 'Active'
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libelle',
                'label' => 'Catégorie',
                'query_builder' => function(CategorieRepository $categorieRepository)
                {
                    // Pour trier par ordre alphabétique
                    return $categorieRepository->createQueryBuilder('c')
                        ->OrderBy('c.libelle', 'ASC');
                }
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
