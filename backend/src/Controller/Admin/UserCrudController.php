<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('pseudo', 'Pseudonyme'),
            EmailField::new('email', 'Adresse Email'),
            ChoiceField::new('roles', 'Permissions')
                ->setChoices([
                    'Membre Classique' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Banni (Aucun droit)' => 'ROLE_BANNED'
                ])
                ->allowMultipleChoices(),
            DateTimeField::new('createdAt', 'Date d\'inscription')->hideOnForm(),
        ];
    }
}
