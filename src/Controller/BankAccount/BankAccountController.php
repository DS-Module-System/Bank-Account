<?php

namespace App\Controller\BankAccount;

use App\Controller\Core\CoreBaseController;
use App\Entity\BankAccount\BankAccount;
use App\Form\BankAccount\BankAccountForm;
use App\Form\BankAccount\BankAccountSearchForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/bank-accounts', name: 'bank_account_')]
class BankAccountController extends CoreBaseController
{


    protected string $entityClass = BankAccount::class;
    protected string $formClass = BankAccountForm::class;
    protected string $searchFormClass = BankAccountSearchForm::class;
    protected string $moduleTemplateName = 'bank_account';

    #[Route(path: '', name: 'list')]
    #[IsGranted('ROLE_ADMIN')]
    public function list(Request $request): Response
    {
        $page = $request->get('page', 1);
        return $this->baseList($request, $page);
    }

    #[Route(path: '/create', name: 'create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request): Response
    {
        return $this->baseCreate($request);
    }

    #[Route(path: '/{id}/edit', name: 'edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit($id, Request $request): Response
    {
        return $this->baseEdit($request, $id);
    }

    #[Route(path: '/deletes', name: 'deletes')]
    #[IsGranted('ROLE_ADMIN')]
    public function deletes(Request $request): Response
    {
        return $this->baseDeletes($request);
    }

}
