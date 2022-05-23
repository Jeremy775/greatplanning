<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER', 'ROLE_FORMATEUR'];

        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('mail'),
            TextField::new('password')->setFormType(PasswordType::class),
            ChoiceField::new('roles')->setChoices(array_combine($roles, $roles))
                ->allowMultipleChoices()
                ->renderExpanded()
                ->renderAsBadges(),
            AssociationField::new('Formations'),
            // ImageField::new('assurance_maladie')->setUploadDir("public\uploads\assurances")
            //     ->setFormType(FileUploadType::class)
            //     ->setUploadedFileNamePattern('[year]/[month]/[day]/[slug]-[contenthash].[extension]')
            //     ->setColumns(6)
            //     ->hideOnIndex()
            //     ->setFormTypeOptions(['attr' => [
            //         'accept' => 'application/pdf','image/jpeg',
            //         'image/png',
            //         'image/webp',
            //     ]
            // ]),
            // ImageField::new('carte_identite')->setUploadDir("public\uploads\carte_identite")
            //     ->setFormType(FileUploadType::class)
            //     ->setUploadedFileNamePattern('[year]/[month]/[day]/[slug]-[contenthash].[extension]')
            //     ->setColumns(6)
            //     ->hideOnIndex()
            //     ->setFormTypeOptions(['attr' => [
            //         'accept' => 'application/pdf','image/jpeg',
            //         'image/png',
            //         'image/webp',
            //     ]
            // ]),
            TextField::new('assurance_maladie')->onlyOnIndex(),
            TextField::new('carte_identite')->onlyOnIndex(),





        ];
    }
}
