# ERP Bank Account Module - Documentation

Welcome to the ERP Bank Account Module documentation. This directory contains comprehensive guides for setting up, configuring, and integrating the Bank Account module with other ERP modules.

## Documentation Index

### 📖 [Installation Guide](installation-guide.md)
Complete step-by-step installation instructions for setting up the Bank Account module. Includes module installation, database setup, menu configuration, and integration with other modules.

### ⚡ [Quick Start Guide](quick-start.md)
Condensed installation process for developers who need to get the Bank Account module running quickly. Includes essential commands and integration steps.

## Module Overview

The ERP Bank Account Module provides comprehensive bank account management functionality:

- **Bank Account Management**: Create, edit, and manage bank accounts
- **Bank Information Storage**: Store bank names, addresses, IBAN, SWIFT codes
- **Integration Ready**: Seamless integration with Invoice module
- **User-Friendly Interface**: Modern UI with search and filtering capabilities
- **Multi-language Support**: Internationalization capabilities

## Key Features

- **Bank Account CRUD Operations**: Complete create, read, update, delete functionality
- **Search and Filter**: Advanced search capabilities for bank accounts
- **Invoice Integration**: Direct linking with invoice module for payment processing
- **Form Validation**: Comprehensive input validation and error handling
- **Responsive Design**: Mobile-friendly interface
- **Security**: Role-based access control integration

## Architecture

```
src/
├── Controller/BankAccount/     # Bank account controllers
├── Entity/BankAccount/         # Bank account entities
├── Repository/BankAccount/     # Data access layer
├── Form/BankAccount/           # Form types and validation
├── Service/BankAccount/        # Business logic services
└── templates/bank_account/     # Twig templates
```

## Integration Capabilities

### Invoice Module Integration
The Bank Account module can be seamlessly integrated with the Invoice module to:

- Link bank accounts to invoices
- Display bank information on printed invoices
- Provide payment processing capabilities
- Support multiple bank accounts per invoice

### Core Module Integration
- User authentication and authorization
- File management system
- Multi-language support
- Menu system integration

## Technology Stack

- **Backend**: PHP 8.0+, Symfony 6+
- **Database**: MySQL 8.0+ with Doctrine ORM
- **Frontend**: Twig templates, SASS, JavaScript
- **Forms**: Symfony Form component with validation
- **Security**: Role-based access control

## Getting Help

- **Installation Issues**: Check the [Installation Guide](installation-guide.md)
- **Quick Setup**: Use the [Quick Start Guide](quick-start.md)
- **Integration**: Refer to integration examples in installation guide
- **Support**: Contact support@devscale.bg

## Contributing

When contributing to the Bank Account module documentation:

1. Keep it clear and concise
2. Include code examples where helpful
3. Update both installation and quick start guides
4. Test all commands and procedures
5. Add troubleshooting sections for common issues
6. Include integration examples with other modules

## Version Information

- **Current Version**: 1.0.0
- **Last Updated**: [Current Date]
- **Compatibility**: PHP 8.0+, Symfony 6+, MySQL 8.0+
- **Dependencies**: ERP Core Module System 