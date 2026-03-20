<p align="center"><img src="https://github.com/EnzoLamacchia/dedir/blob/main/devEL-logo.png?raw=true" width="100" alt="Logo"></p>

# DeDir Determine Dirigenziali
## Sw Gestione archivio determinazioni dirigenziali

[![Framework](https://img.shields.io/static/v1?label=Framework&message=Laravel%209.x&color=red&style=for-the-badge&logo=laravel)](https://laravel.com)
[![Framework](https://img.shields.io/static/v1?label=PHP%20Version&message=8.0&color=777BB4&style=for-the-badge&logo=php)](https://php.net)
[![Version](http://poser.pugx.org/elamacchia/dedir/version?style=for-the-badge)](https://packagist.org/packages/elamacchia/dedir)
[![License](http://poser.pugx.org/elamacchia/dedir/license?style=for-the-badge)](https://packagist.org/packages/elamacchia/dedir)
[![Total Downloads](http://poser.pugx.org/elamacchia/dedir/downloads?style=for-the-badge)](https://packagist.org/packages/elamacchia/dedir)  
DeDir è un package di AdmEL (vd. https://github.com/EnzoLamacchia/admel.git), applicazione dockerizzata costruita su un framework Laravel v.9.0 e PHP 8.0, finalizzata essenzialmente alla gestione di utenti, ruoli e permessi.  
DeDir invece è un'app pensata er la gestione di un albo on-line di determinazioni della Pubblica Amministrazione. Presenta funzioni di archiviazione, ricerca e reportistica.

## Dipendenze
Oltre alle dipendenze di Laravel 9.x, DeDir utilizza:

**barryvdh/laravel-dompdf: ^2.0**  
**laravel/jetstream: ^2.14**  
**maatwebsite/excel: ^3.1**  
**spatie/laravel-permission: ^5.7**  
**elamacchia/admel ^1.0.1**

## Installazione
Dopo aver installato Admel (vd. istruzioni su https://github.com/EnzoLamacchia/admel.git), nella shell della nuova app AdmEL richiedere il pacchetto DeDir mediante il comando:

```sh
composer require elamacchia/dedir
```
Successivamente potrebbe essere necessario settare i diritti di ownwership del file laravel.log

```sh
chown 1000:sail storage/logs/laravel.log  (potrebbe non servire)
```
Migrare le tabelle di DeDir:
```sh
php artisan migrate
```
Pubblicare gli asset del pacchetto DeDir:
```sh
php artisan vendor:publish (selezionare elamacchia/dedir)
```
Fatto!

## Utilizzo
Come prima attività occorre accedere all'interfaccia di gestione, attraverso un utente preconfigurato con ruolo di super-administrator.
Le credenziali sono:
```sh
id: superadmin@example.com
pw: password
```
Attraverso questo account è possibile:  
- crare nuovi utenti, ruoli e permessi.  
- assegnare a ciascun ruolo dei permessi.  
- assegnare a ciuascun utente ruoli, permessi singoli o permessi via ruolo  

Attraverso tale account è possibile, dalla dashboard, accedere all'app di gestione delle determinazioni attraverso il link "Determine Dirigenziali".  
E' opportuno tuttavia creare uno o più account cui assegnare il ruolo di "gestione_determine".  
A questo punto tale nuovo utente avrà accesso alla sola gestione determinazioni e non alla gestione degli utenti.
