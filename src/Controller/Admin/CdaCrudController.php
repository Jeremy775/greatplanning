<?php

namespace App\Controller\Admin;

use App\Entity\Cda;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CdaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cda::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    // Faire paginiation par mois
}
