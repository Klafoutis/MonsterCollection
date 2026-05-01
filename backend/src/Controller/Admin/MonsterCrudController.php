<?php

namespace App\Controller\Admin;

use App\Entity\Monster;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class MonsterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Monster::class;
    }

    // 1. DÉFINITION DES COLONNES
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom de la canette'),
            TextField::new('flavor', 'Saveur'),
            TextField::new('type', 'Gamme (Type)'),
            ChoiceField::new('status', 'Statut')->setChoices([
                'En attente' => 'pending',
                'Approuvé' => 'approved',
                'Refusé' => 'rejected'
            ]),
            // TextField pour l'image en attendant l'étape d'upload de fichiers
            TextField::new('image', 'URL de l\'image'),
        ];
    }

    // 2. CRÉATION DES BOUTONS DE MODÉRATION
    public function configureActions(Actions $actions): Actions
    {
        $valider = Action::new('valider', 'Valider', 'fa fa-check')
            ->linkToCrudAction('validerMonster')
            ->setCssClass('btn btn-success')
            // N'afficher le bouton que si la canette est "pending"
            ->displayIf(static function ($entity) {
                return $entity->getStatus() === 'pending';
            });

        $refuser = Action::new('refuser', 'Refuser', 'fa fa-times')
            ->linkToCrudAction('refuserMonster')
            ->setCssClass('btn btn-danger')
            ->displayIf(static function ($entity) {
                return $entity->getStatus() === 'pending';
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $valider)
            ->add(Crud::PAGE_INDEX, $refuser);
    }

    // 3. LOGIQUE D'APPROBATION
    public function validerMonster(AdminContext $context, EntityManagerInterface $em): Response
    {
        $monster = $context->getEntity()->getInstance();
        $monster->setStatus('approved');
        $em->flush();

        $this->addFlash('success', 'La canette a été validée et ajoutée au catalogue officiel !');
        return $this->redirect($context->getReferrer() ?? $this->container->get(\EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator::class)->setAction(Action::INDEX)->generateUrl());
    }

    // 4. LOGIQUE DE REFUS
    public function refuserMonster(AdminContext $context, EntityManagerInterface $em): Response
    {
        $monster = $context->getEntity()->getInstance();
        $monster->setStatus('rejected');
        $em->flush();

        $this->addFlash('warning', 'La proposition a été refusée.');
        return $this->redirect($context->getReferrer() ?? $this->container->get(\EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator::class)->setAction(Action::INDEX)->generateUrl());
    }
}
