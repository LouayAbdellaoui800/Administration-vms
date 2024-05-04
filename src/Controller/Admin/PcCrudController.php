<?php

namespace App\Controller\Admin;

use App\Entity\Pc;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PcCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pc::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('model'),
            TextField::new('os'),
            TextField::new('cpu'),
            TextField::new('gpu'),
            BooleanField::new('active'),
            IntegerField::new('RAM'),
            IntegerField::new('HDD'),
        ];
    }

}
