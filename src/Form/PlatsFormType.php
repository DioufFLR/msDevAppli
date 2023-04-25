<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('prix', options: [
                'label' => 'Prix'
            ])
            ->add('image', options: [
                'label' => 'Image'
            ])
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
