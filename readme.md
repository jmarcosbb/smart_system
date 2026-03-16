# 🚀 Sistema de Controle de Embarque

Sistema desenvolvido em Laravel para controle de fluxo de passageiros, com geração de código de atendimento (senha de fila).

---

## 📌 Funcionalidades

* Registro de embarque
* Controle de fluxo de passageiros
* Geração de código de atendimento
* Interface para terminal e painel

---

## 🛠️ Tecnologias

* PHP 7.4
* Laravel
* postgres
* Blade

---

## ▶️ Como rodar o projeto

```bash
git clone https://github.com/jmarcosbb/smart_system.git
cd smart_system

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## ⚠️ Observações

* O campo "senha" refere-se a código de atendimento (fila), não senha de autenticação
* Projeto desenvolvido para fins de estudo e demonstração

---

## 👨‍💻 Autor

João Marcos Batalha
