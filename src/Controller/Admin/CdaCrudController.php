<?php

namespace App\Controller\Admin;

use App\Entity\Cda;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            DateTimeField::new('start'),
            DateTimeField::new('end'),
            ColorField::new('background_color')
        ];
    }


    // Faire paginiation par mois
}
