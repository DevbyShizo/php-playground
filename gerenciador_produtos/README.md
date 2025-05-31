# Gerenciador de Produto 🛒

Um pequeno sistema de gerenciamento de produtos e carrinho de compras, desenvolvido em **PHP** com uso de **POO** e **Composer Autoload**, para fins de estudo e aprimoramento.

---

## 🚀 Funcionalidades

- ✅ Cadastro de produtos com nome e preço.
- ✅ Cadastro de usuário com nome e e-mail.
- ✅ Adicionar e remover produtos do carrinho.
- ✅ Exibir lista de produtos do carrinho.
- ✅ Calcular o total da compra.

---

## 🛠️ Tecnologias utilizadas

- PHP 8+
- Composer (Autoload PSR-4)
- Programação Orientada a Objetos (POO)

---

## 📂 Estrutura do projeto

- /App
- Produto.php
- Carrinho.php
- Usuario.php
- /public
- index.php
- composer.json
- vendor/

---

## 💻 Como rodar o projeto

1. Clone o repositório:

```bash
git clone https://github.com/matheus/gerenciador_produto.git
cd gerenciador_produto
```

2. Instale o autoload do Composer:

```bash
composer dump-autoload
```

3. Execute o projeto com o servidor embutido do PHP:

```bash
php -S localhost:8000
```

4. Acesse no navegador:

```bash
http://localhost:8000/public/index.php
```
