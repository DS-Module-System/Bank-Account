# ERP Bank Account Module - Installation Guide

This guide provides step-by-step instructions for setting up the ERP Bank Account Module and integrating it with other modules.

## Prerequisites

- ERP Core Module System installed and configured
- PHP 8.0 or higher
- Composer
- MySQL/MariaDB database server
- Symfony CLI (optional but recommended)

## Installation Steps

### 1. Copy Bank Account Module

First, copy the Bank Account module files to your ERP system. The module should include:

- `src/Controller/BankAccount/` - Controllers
- `src/Entity/BankAccount/` - Entities
- `src/Repository/BankAccount/` - Repositories
- `src/Form/BankAccount/` - Form types
- `src/Service/BankAccount/` - Services
- `templates/bank_account/` - Templates
- `translations/bank_account.*.yaml` - Translation files

### 2. Generate Database Migrations

Create the initial database migration for the Bank Account module:

```bash
php bin\console make:migration
```

This command will generate migration files based on your BankAccount entity definitions.

### 3. Execute Database Migrations

Apply the migrations to create the bank account tables in your database:

```bash
php bin/console doctrine:migrations:migrate
```

This will create the `bank_account` table with all necessary fields.

### 4. Configure Menu System

Add the Bank Account menu items to the navigation system. Edit the file `src/Menu/Builder.php` and add the following code:

```php
$menu->addChild('bank_account.leftMenu.bankAccounts', [
    'label' => $this->domainTranslationService->translate('bank_account.leftMenu.bankAccounts'),
    'route' => 'bank_account_list',
    'extras' => [
        'routes' => [
            'bank_account_create',
            'bank_account_edit',
        ],
    ],
]);
```

**Note:** Make sure to add this code in the appropriate section where other menu items are defined.

### 5. Verify Installation

Access the Bank Account module through the menu system to verify that:

- The menu item appears in the navigation
- You can access the bank account list page
- You can create new bank accounts
- You can edit existing bank accounts

## Integration with Invoice Module

If you want to integrate the Bank Account module with the Invoice module, follow these additional steps:

### 1. Update Invoice Entity

Edit the file `src/Entity/Invoice/Invoice.php` and add the following code:

```php
use App\Entity\BankAccount\BankAccount;

// Add this property to the Invoice class
#[ORM\ManyToOne(inversedBy: 'invoices')]
private ?BankAccount $bankAccount = null;

// Add these methods to the Invoice class
public function getBankAccount(): ?BankAccount
{
    return $this->bankAccount;
}

public function setBankAccount(?BankAccount $bankAccount): self
{
    $this->bankAccount = $bankAccount;

    return $this;
}
```

### 2. Generate Integration Migrations

Create a new migration for the invoice-bank account relationship:

```bash
php bin\console make:migration
```

### 3. Execute Integration Migrations

Apply the new migration:

```bash
php bin/console doctrine:migrations:migrate
```

This will add the `bank_account_id` foreign key to the `invoice` table.

### 4. Update Invoice Form

Edit the file `src/Form/Invoice/InvoiceForm.php` and add the bank account field:

```php
use App\Entity\BankAccount\BankAccount;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;

// Add this field to the form builder
->add('bankAccount', EntityType::class, [
    'class' => BankAccount::class,
    'label' => 'bankAccount',
    'required' => true,
    'constraints' => [
        new NotBlank(),
    ],
    'choice_label' => function (BankAccount $entity) {
        return $entity->getName();
    },
    'placeholder' => 'Избери',
    'attr' => [
        'class' => 'select2',
    ]
])
```

### 5. Update Invoice Template

Edit the file `templates/invoice/form_fields.html.twig` and add:

```twig
{{ form_table.tr(form.bankAccount) }}
```

### 6. Display Bank Information on Printed Invoices

To show bank account information on printed invoices, edit the appropriate invoice template file (e.g., `templates/invoice/invoice_template.html.twig`) and add:

```twig
{{ invoice.bankAccount ? invoice.bankAccount.bankName : '' }}
{{ invoice.bankAccount and invoice.bankAccount.address ? invoice.bankAccount.address : '' }}
{{ invoice.bankAccount ? invoice.bankAccount.iban : '' }}
{{ invoice.bankAccount ? invoice.bankAccount.swift : '' }}
```

## Configuration

### Translation Files

Ensure the following translation files are present and properly configured:

- `translations/bank_account.en.yaml` - English translations
- `translations/bank_account.bg.yaml` - Bulgarian translations

### Routes Configuration

Verify that the bank account routes are properly configured in your routing files:

```yaml
# config/routes/bank_account.yaml
bank_account_list:
    path: /bank-account
    controller: App\Controller\BankAccount\BankAccountController::index

bank_account_create:
    path: /bank-account/create
    controller: App\Controller\BankAccount\BankAccountController::create

bank_account_edit:
    path: /bank-account/{id}/edit
    controller: App\Controller\BankAccount\BankAccountController::edit
```

## Troubleshooting

### Common Issues

1. **Menu Not Appearing**
   - Verify the menu code is added to the correct location in `Builder.php`
   - Check if the translation key exists in translation files
   - Clear the cache: `php bin/console cache:clear`

2. **Migration Errors**
   - Ensure the BankAccount entity is properly defined
   - Check for syntax errors in entity files
   - Verify database connection and permissions

3. **Form Integration Issues**
   - Ensure all required use statements are added
   - Check if the BankAccount entity is properly imported
   - Verify the form field is added in the correct location

4. **Template Errors**
   - Check if template files exist in the correct location
   - Verify template syntax and variable names
   - Clear the cache after template changes

### Cache Management

After making changes to entities, forms, or templates, clear the cache:

```bash
php bin/console cache:clear
```

### Database Verification

To verify the database structure, you can use:

```bash
php bin/console doctrine:schema:validate
```

## Security Considerations

- Ensure proper role-based access control is configured
- Validate all form inputs
- Implement proper CSRF protection
- Use prepared statements for database queries (handled by Doctrine)

## Next Steps

After successful installation:

1. Configure user permissions for bank account management
2. Set up proper validation rules for bank account data
3. Configure email notifications for bank account changes
4. Set up audit logging for bank account modifications
5. Test the integration with the Invoice module
6. Configure backup procedures for bank account data

## Support

For additional support or questions:

- Check the [Quick Start Guide](quick-start.md) for condensed instructions
- Review the [README](README.md) for module overview
- Contact support@devscale.bg for technical assistance 