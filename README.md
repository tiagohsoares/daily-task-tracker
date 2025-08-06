# 📋 Daily Task Tracker

Um projeto simples de **agenda para organizar tarefas diárias**, desenvolvido com o framework **Laravel**.

---

## 📑 Tabela de Conteúdo
- [📋 Daily Task Tracker](#-daily-task-tracker)
  - [📑 Tabela de Conteúdo](#-tabela-de-conteúdo)
  - [1. Introdução](#1-introdução)
    - [🧰 Tecnologias utilizadas:](#-tecnologias-utilizadas)
    - [1.1. Requisitos](#11-requisitos)
    - [1.2. Comandos para Iniciar o Projeto](#12-comandos-para-iniciar-o-projeto)

---

## 1. Introdução

Este é o **Daily Task Tracker**, uma aplicação para gerenciar tarefas diárias, desenvolvida com **PHP** e o framework **Laravel**.

### 🧰 Tecnologias utilizadas:
- **PHP**: 8.4.10  
- **Composer**: 2.8.10  
- **Node.js**: 22.17.1  
- **NPM**: 11.4.2

---

### 1.1. Requisitos

Antes de iniciar, certifique-se de ter os seguintes itens instalados na sua máquina:

- PHP >= 8.4
- Composer
- Node.js e NPM
- Git
- Docker (caso opte por usar o Laravel Sail)

---

### 1.2. Comandos para Iniciar o Projeto

Clone o repositório:

```bash
git clone git@github.com:tiagohsoares/daily-task-tracker-.git
cd daily-task-tracker
composer install
php artisan key:generate
./vendor/bin/sail up -d
````
