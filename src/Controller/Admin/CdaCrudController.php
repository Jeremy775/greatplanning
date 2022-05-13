<?php

namespace App\Controller\Admin;

use App\Entity\Cda;
use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class CdaCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Cda::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $choices = ['Java POO', 'PHP', 'Anglais'];

        return [
            ChoiceField::new('title')->setChoices(array_combine($choices, $choices)),
            TextEditorField::new('description'),
            BooleanField::new('all_day'),
            DateField::new('start'),
            DateField::new('end'),
            ColorField::new('background_color')
        ];
    }


    // Faire paginiation par mois
}
