<?php

namespace App\Controller\Admin;

use App\Entity\Users;

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
        return Users::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('mail'),
            TextField::new('mdp')->setFormType(PasswordType::class),
            AssociationField::new('role')->renderAsNativeWidget(),
        ];
    }


    /**
     * @param Users $user
     */
    public function setPassword(Users $user, UserPasswordHasherInterface $passwordHasher): void
    {
        $pass = $user->getMdp();

        $user->setMdp(
            $hashedPassword = $passwordHasher->hashPassword($user, $pass)
        );
        $user->setMdp($hashedPassword);
    }
}
