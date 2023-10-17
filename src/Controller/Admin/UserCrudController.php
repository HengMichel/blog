<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ "id" caché
            // HiddenField::new('id'), 
            IdField::new('id')->hideOnForm(),
            TextField::new('username'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('password'),
            EmailField::new('email'),
        ];
    }
    
}
