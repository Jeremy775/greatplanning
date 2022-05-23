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
            TextField::new('plainPassword', 'Mot de passe')->setFormType(PasswordType::class)
                ->hideOnIndex(),
            ChoiceField::new('roles')->setChoices(array_combine($roles, $roles))
                ->allowMultipleChoices()
                ->renderExpanded()
                ->renderAsBadges(),
            AssociationField::new('Formations'),
            TextField::new('assurance_maladie')->onlyOnIndex(),
            TextField::new('carte_identite')->onlyOnIndex(),
        ];
    }
}
