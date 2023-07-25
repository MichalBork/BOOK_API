## Lista routingu


dodac do .env dla przykładu
```dotenv

DATABASE_URL="mysql://root:root@mysql:3306/bookstore?serverVersion=5.7"

```

Jak instalować:
```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Do headera należy dodać:
```json
{
  "authToken": "123"
}
```

Token działa na eventListenerze, który sprawdza czy token jest poprawny.

Jest to proste rozwiazanie, ktore zostalo dodane z powodu czasu.


| Metoda | Ścieżka | Opis |
| --- | --- | --- |
| GET | /api/find-author-books | Znajduje książki na podstawie nazwy autora |
| PATCH | /api/add-author-books | Dodaje autora do książki |
| POST | /api/add-book | Dodaje nową książkę |
| DELETE | /api/delete-book | Usuwa książkę na podstawie ID |
| GET | /api/get-books | Pobiera wszystkie książki |
| PATCH | /api/update-book | Aktualizuje dane książki |


Json który zawsze działa przy każdym zapytaniu
```json
{
  "id":1,
  "book":1,
  "title": "Book Title",
  "publisher": " Name",
  "pageCount": 3220,
  "isPublic": false,
  "authors": [1,2,3,4]
}

```