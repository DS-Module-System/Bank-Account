# Bank Account

Банкови сметки на фирмата (IBAN, SWIFT, банка) като платежни дестинации за фактури.

## Функционалност

- CRUD на банкови сметки
- Полета: име, банка, IBAN, SWIFT, адрес
- Търсене и филтриране

## Интеграция в системата

Copy-in модул: файловете се копират в хоста под `App\`.

- Пътища: `src/Controller|Entity|Form|Repository/BankAccount/`, `templates/bank_account/`, `translations/bank_account.*.yaml`, `config/roles/bank_account.yaml`
- Роли: `ROLE_BANK_ACCOUNT_{VIEW,CREATE,EDIT,DELETE}`
- Маршрути: `/bank-accounts`

В хост приложението кодът може да е копиран, но **няма елемент в лявото меню** — сметките се избират от фактурите. За пълен достъп трябва да се добавят `config/roles/bank_account.yaml` и запис в `src/Menu/Builder.php`.

Използва се от **invoice** (ManyToOne към `BankAccount`).

## Структура

- `BankAccountController` (разширява `CoreBaseController`)
- Ентитет: `BankAccount`
- Форми: сметка и търсене

## Зависимости

- **erp-core** — `CoreBaseController`, `EditForm` / `SearchForm`

## Документация

- [docs/bank_account/README.md](docs/bank_account/README.md)
- [docs/bank_account/installation-guide.md](docs/bank_account/installation-guide.md)
- [docs/bank_account/quick-start.md](docs/bank_account/quick-start.md)
