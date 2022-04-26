<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cours::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom_cours'),
            AssociationField::new('Formations')->renderAsNativeWidget(),
            AssociationField::new('classe')->renderAsNativeWidget(),

        ];
    }
}
