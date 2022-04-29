<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('mail'),
            TextField::new('password')->setFormType(PasswordType::class),
            AssociationField::new('role')->renderAsNativeWidget(),
            AssociationField::new('Formations')
        ];
    }


    /**
     * @param User $user
     */
    public function setPassword(User $user, UserPasswordHasherInterface $passwordHasher): void
    {
        $pass = $user->getPassword();

        $user->setPassword(
            $hashedPassword = $passwordHasher->hashPassword($user, $pass)
        );
        $user->setPassword($hashedPassword);
    }
}
