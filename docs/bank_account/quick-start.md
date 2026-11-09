# ERP Bank Account Module - Quick Start Guide

This guide provides condensed instructions for quickly setting up the ERP Bank Account Module.

## Prerequisites

- ERP Core Module System installed
- PHP 8.0+, Composer, MySQL
- Basic Symfony knowledge

## Quick Installation

### 1. Copy Module Files

Copy the Bank Account module files to your ERP system:

```bash
# Copy module files to appropriate directories
# - src/Controller/BankAccount/
# - src/Entity/BankAccount/
# - src/Repository/BankAccount/
# - src/Form/BankAccount/
# - templates/bank_account/
# - translations/bank_account.*.yaml
```

### 2. Database Setup

```bash
# Generate and run migrations
php bin\console make:migration
php bin/console doctrine:migrations:migrate
```

### 3. Menu Configuration

Add to `src/Menu/Builder.php`:

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

### 4. Clear Cache

```bash
php bin/console cache:clear
```

## Quick Integration with Invoice Module

### 1. Update Invoice Entity

Add to `src/Entity/Invoice/Invoice.php`:

```php
use App\Entity\BankAccount\BankAccount;

#[ORM\ManyToOne(inversedBy: 'invoices')]
private ?BankAccount $bankAccount = null;

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

### 2. Update Invoice Form

Add to `src/Form/Invoice/InvoiceForm.php`:

```php
use App\Entity\BankAccount\BankAccount;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;

->add('bankAccount', EntityType::class, [
    'class' => BankAccount::class,
    'label' => 'bankAccount',
    'required' => true,
    'constraints' => [new NotBlank()],
    'choice_label' => function (BankAccount $entity) {
        return $entity->getName();
    },
    'placeholder' => 'Избери',
    'attr' => ['class' => 'select2']
])
```

### 3. Update Template

Add to `templates/invoice/form_fields.html.twig`:

```twig
{{ form_table.tr(form.bankAccount) }}
```

### 4. Run Integration Migration

```bash
php bin\console make:migration
php bin/console doctrine:migrations:migrate
```

## Quick Verification

1. **Check Menu**: Navigate to see if "Bank Accounts" appears in menu
2. **Test CRUD**: Create, edit, delete a bank account
3. **Test Integration**: Create invoice with bank account selection
4. **Check Print**: Verify bank info appears on printed invoice

## Common Issues & Solutions

### Menu Not Visible
```bash
php bin/console cache:clear
# Check translation files exist
```

### Migration Errors
```bash
# Check entity syntax
php bin/console doctrine:schema:validate
```

### Form Errors
```bash
# Verify use statements added
# Check form field placement
```

## Essential Commands

```bash
# Clear cache
php bin/console cache:clear

# Validate schema
php bin/console doctrine:schema:validate

# Check routes
php bin/console debug:router | grep bank

# Check translations
php bin/console debug:translation bank_account
```

## Next Steps

1. Configure user permissions
2. Set up validation rules
3. Test invoice integration
4. Configure backup procedures

## Support

- **Full Guide**: [Installation Guide](installation-guide.md)
- **Module Info**: [README](README.md)
- **Technical Support**: support@devscale.bg 