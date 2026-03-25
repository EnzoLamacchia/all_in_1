# GespidiEffe — Gestione e modifica file PDF

[![Framework](https://img.shields.io/static/v1?label=Framework&message=Laravel%209.x&color=red&style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/static/v1?label=PHP%20Version&message=8.1&color=777BB4&style=for-the-badge&logo=php)](https://php.net)
[![License](https://img.shields.io/static/v1?label=License&message=MIT&color=green&style=for-the-badge)](https://opensource.org/licenses/MIT)

GesPidieffe è un package Laravel per la gestione e la modifica di file PDF direttamente dal browser.
Fa parte dell'ecosistema **AdmEL** ed è progettato per essere integrato come package locale in un'applicazione Laravel 9.

---

## Funzionalità

| Funzione | Descrizione |
|---|---|
| **Censura PDF** | Disegna rettangoli neri su aree sensibili del documento; supporto ibrido vettoriale/raster; contenuto irrecuperabile |
| **Unione PDF (Merge)** | Carica più file PDF, riordinali con drag & drop, uniscili in un unico documento |
| **Divisione PDF (Split)** | Estrae singole pagine o intervalli; download del singolo PDF o di uno ZIP con tutti i file estratti |
| **Organizza pagine** | Griglia drag & drop per riordinare, duplicare o eliminare singole pagine |
| **Ruota pagine** | Ruota singole pagine o l'intero documento a passi di 90°; badge visivo con i gradi correnti |
| **Numerazione pagine** | Aggiunge numeri di pagina con posizione, font, dimensione e colore personalizzabili; testo originale rimane selezionabile |
| **Unisci e Sistema** | Flusso in due step: prima unisce più PDF (come Merge), poi permette di riorganizzare liberamente le singole pagine del risultato |
| **PDF to Word** | Converte PDF in `.docx` editabile; rileva automaticamente se il PDF è nativo, ibrido o scansionato e applica la strategia ottimale |

---

## Requisiti

### Applicazione host

| Requisito | Versione |
|---|---|
| PHP | ^8.0 |
| Laravel | 9.x |
| Laravel Jetstream | ^2.14 |
| Laravel Sanctum | ^3.0 |

### Dipendenze PHP (Composer)

| Package | Versione |
|---|---|
| `setasign/fpdi` | ^2.3 |
| `tecnickcom/tcpdf` | ^6.5 |

### Dipendenze di sistema

| Strumento | Utilizzo |
|---|---|
| `qpdf` | Merge, split, rotazione, conteggio pagine |
| `ghostscript` (`gs` / `gswin64c`) | Rasterizzazione pagine PDF in PNG |
| `pdftk` | Overlay numerazione pagine (`multistamp`) |
| `python` 3.8+ con `pdf2docx` | Conversione PDF nativo → DOCX |
| `tesseract` + lang `ita` | OCR su PDF scansionati |
| `poppler-utils` (`pdftotext`, `pdfimages`, `pdfinfo`) | Analisi e estrazione testo PDF |
| `pandoc` | Conversione testo → DOCX (PDF ibridi) |
| `libreoffice` (headless) | Assemblaggio DOCX da OCR (PDF scansionati) |

#### Installazione su Linux (AlmaLinux/RHEL 8)
```bash
dnf install -y ghostscript qpdf poppler-utils libreoffice-headless libreoffice-writer tesseract tesseract-langpack-ita
# Pandoc (non nei repo standard):
curl -sLO https://github.com/jgm/pandoc/releases/download/3.1.13/pandoc-3.1.13-linux-amd64.tar.gz
tar xvzf pandoc-3.1.13-linux-amd64.tar.gz && cp pandoc-3.1.13/bin/pandoc /usr/local/bin/
# pdf2docx in virtualenv dedicato:
python3.8 -m venv /opt/gespidieffe-venv
/opt/gespidieffe-venv/bin/pip install pdf2docx
```

#### Installazione su Windows (Laragon)
- Python: bundled con Laragon — `pip install pdf2docx`
- Tesseract: https://github.com/UB-Mannheim/tesseract/wiki (con language pack `ita`)
- Poppler: https://github.com/oschwartz10612/poppler-windows/releases
- Pandoc: https://pandoc.org/installing.html
- LibreOffice: https://www.libreoffice.org/download/libreoffice/
- Ghostscript: https://www.ghostscript.com/releases/gsdnld.html

---

## Variabili .env

### Linux — solo Python richiede path esplicito
```env
GESPIDIEFFE_PYTHON_BIN=/opt/gespidieffe-venv/bin/python
```

### Windows (Laragon) — tutti i binari con percorso assoluto (forward slash obbligatori)
```env
GESPIDIEFFE_PYTHON_BIN="C:/laragon8/bin/python/python-3.13/python.exe"
GESPIDIEFFE_LIBREOFFICE_BIN="C:/Program Files/LibreOffice/program/soffice.exe"
GESPIDIEFFE_TESSERACT_BIN="C:/Program Files/Tesseract-OCR/tesseract.exe"
GESPIDIEFFE_PDFTOTEXT_BIN="C:/poppler-25.12.0/Library/bin/pdftotext.exe"
GESPIDIEFFE_PDFIMAGES_BIN="C:/poppler-25.12.0/Library/bin/pdfimages.exe"
GESPIDIEFFE_PDFINFO_BIN="C:/poppler-25.12.0/Library/bin/pdfinfo.exe"
GESPIDIEFFE_GS_BIN="C:/Program Files/gs/gs10.07.0/bin/gswin64c.exe"
```

---

## Ambiente di sviluppo

| Voce | Valore |
|---|---|
| Sistema operativo | Windows 10 Home — Laragon standalone |
| PHP | 8.1 (Laragon) |
| Framework | Laravel 9 |
| Frontend | Tailwind CSS, Alpine.js, Vite 4 |
| Database | MariaDB (Laragon) |
| App URL | http://develsolution.test |

### Ambiente di produzione

| Voce | Valore |
|---|---|
| Sistema operativo | AlmaLinux 8.10 standalone |
| Web server | Apache + PHP-FPM (utente `apache`) |
| PHP | 8.x |
| App path | `/var/www/develsolution` |

---

## Installazione

### 1. Aggiungere il package come dipendenza locale

Nel `composer.json` dell'applicazione host, aggiungere il namespace PSR-4 nella sezione `autoload`:

```json
"autoload": {
    "psr-4": {
        "Elamacchia\\Gespidieffe\\": "package/gespidieffe/src/"
    }
}
```

Quindi copiare la cartella `package/gespidieffe/` nella propria applicazione e rigenerare l'autoload:

```bash
composer dump-autoload
```

### 2. Registrare il Service Provider

In `config/app.php`, aggiungere nella sezione `providers`:

```php
Elamacchia\Gespidieffe\GespidieffeServiceProvider::class,
```

### 3. Eseguire le migration

```bash
php artisan migrate
```

Crea le tabelle `gespidieffe_contatori` e `gespidieffe_storico_settimanale` per il sistema statistiche.

### 4. Creare la cartella per i file temporanei

```bash
mkdir -p storage/app/gespidieffe/tmp
```

### 5. Configurare lo scheduler

GespidiEffe registra automaticamente due task nello scheduler:
- **Pulizia file temporanei**: ogni ora, rimuove file > 24h
- **Azzeramento contatori**: ogni notte alle 00:00 (giornaliero) e ogni lunedì (settimanale)

Assicurarsi che il cron di Laravel sia attivo:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## Comandi Artisan

| Comando | Descrizione |
|---|---|
| `php artisan gespidieffe:pulisci-tmp` | Elimina i file temporanei più vecchi di 24 ore |
| `php artisan gespidieffe:pulisci-tmp --ore=48` | Elimina i file più vecchi di N ore |
| `php artisan gespidieffe:azzera-contatori` | Azzera contatori giornalieri/settimanali e salva storico |

---

## Route

Prefix URI: `/gespidieffe` — Named prefix: `gespidieffe.`
Le route sono pubbliche (middleware `web`) tranne `/gespidieffe/statistiche` che richiede `auth:sanctum` + `verified` + `permission:usa gespidieffe`.

| Metodo | URI | Nome route |
|---|---|---|
| GET | `/gespidieffe/` | `gespidieffe.home` |
| GET | `/gespidieffe/censura` | `gespidieffe.censura` |
| POST | `/gespidieffe/censura/upload` | `gespidieffe.censura.upload` |
| GET | `/gespidieffe/censura/editor/{file}` | `gespidieffe.censura.editor` |
| POST | `/gespidieffe/censura/applica` | `gespidieffe.censura.applica` |
| GET | `/gespidieffe/censura/download/{file}` | `gespidieffe.censura.download` |
| DELETE/POST | `/gespidieffe/censura/elimina/{file}` | `gespidieffe.censura.elimina` |
| GET | `/gespidieffe/censura/pdf/{file}` | `gespidieffe.censura.pdf` |
| GET | `/gespidieffe/merge` | `gespidieffe.merge` |
| POST | `/gespidieffe/merge/upload` | `gespidieffe.merge.upload` |
| GET | `/gespidieffe/merge/editor/{session}` | `gespidieffe.merge.editor` |
| POST | `/gespidieffe/merge/applica` | `gespidieffe.merge.applica` |
| GET | `/gespidieffe/merge/download/{file}` | `gespidieffe.merge.download` |
| DELETE/POST | `/gespidieffe/merge/elimina/{session}` | `gespidieffe.merge.elimina` |
| GET | `/gespidieffe/merge/pdf/{session}/{index}` | `gespidieffe.merge.pdf` |
| GET | `/gespidieffe/split` | `gespidieffe.split` |
| POST | `/gespidieffe/split/upload` | `gespidieffe.split.upload` |
| GET | `/gespidieffe/split/editor/{file}` | `gespidieffe.split.editor` |
| POST | `/gespidieffe/split/applica` | `gespidieffe.split.applica` |
| GET | `/gespidieffe/split/download/{file}` | `gespidieffe.split.download` |
| GET | `/gespidieffe/split/download-zip/{file}` | `gespidieffe.split.download-zip` |
| DELETE/POST | `/gespidieffe/split/elimina/{file}` | `gespidieffe.split.elimina` |
| GET | `/gespidieffe/split/pdf/{file}` | `gespidieffe.split.pdf` |
| GET | `/gespidieffe/organizza` | `gespidieffe.organizza` |
| POST | `/gespidieffe/organizza/upload` | `gespidieffe.organizza.upload` |
| GET | `/gespidieffe/organizza/editor/{file}` | `gespidieffe.organizza.editor` |
| POST | `/gespidieffe/organizza/applica` | `gespidieffe.organizza.applica` |
| GET | `/gespidieffe/organizza/download/{file}` | `gespidieffe.organizza.download` |
| DELETE/POST | `/gespidieffe/organizza/elimina/{file}` | `gespidieffe.organizza.elimina` |
| GET | `/gespidieffe/organizza/pdf/{file}` | `gespidieffe.organizza.pdf` |
| GET | `/gespidieffe/ruota` | `gespidieffe.ruota` |
| POST | `/gespidieffe/ruota/upload` | `gespidieffe.ruota.upload` |
| GET | `/gespidieffe/ruota/editor/{file}` | `gespidieffe.ruota.editor` |
| POST | `/gespidieffe/ruota/applica` | `gespidieffe.ruota.applica` |
| GET | `/gespidieffe/ruota/download/{file}` | `gespidieffe.ruota.download` |
| DELETE/POST | `/gespidieffe/ruota/elimina/{file}` | `gespidieffe.ruota.elimina` |
| GET | `/gespidieffe/ruota/pdf/{file}` | `gespidieffe.ruota.pdf` |
| GET | `/gespidieffe/numera` | `gespidieffe.numera` |
| POST | `/gespidieffe/numera/upload` | `gespidieffe.numera.upload` |
| GET | `/gespidieffe/numera/editor/{file}` | `gespidieffe.numera.editor` |
| POST | `/gespidieffe/numera/applica` | `gespidieffe.numera.applica` |
| GET | `/gespidieffe/numera/download/{file}` | `gespidieffe.numera.download` |
| DELETE/POST | `/gespidieffe/numera/elimina/{file}` | `gespidieffe.numera.elimina` |
| GET | `/gespidieffe/numera/pdf/{file}` | `gespidieffe.numera.pdf` |
| GET | `/gespidieffe/unisci-organizza` | `gespidieffe.unisciorganizza` |
| POST | `/gespidieffe/unisci-organizza/upload` | `gespidieffe.unisciorganizza.upload` |
| GET | `/gespidieffe/unisci-organizza/editor-merge/{session}` | `gespidieffe.unisciorganizza.editor-merge` |
| POST | `/gespidieffe/unisci-organizza/applica-merge` | `gespidieffe.unisciorganizza.applica-merge` |
| GET | `/gespidieffe/unisci-organizza/editor-organizza/{session}` | `gespidieffe.unisciorganizza.editor-organizza` |
| POST | `/gespidieffe/unisci-organizza/applica-organizza` | `gespidieffe.unisciorganizza.applica-organizza` |
| GET | `/gespidieffe/unisci-organizza/download/{file}` | `gespidieffe.unisciorganizza.download` |
| DELETE/POST | `/gespidieffe/unisci-organizza/elimina/{session}` | `gespidieffe.unisciorganizza.elimina` |
| GET | `/gespidieffe/pdf2word` | `gespidieffe.pdf2word` |
| POST | `/gespidieffe/pdf2word/upload` | `gespidieffe.pdf2word.upload` |
| GET | `/gespidieffe/pdf2word/confirm/{file}` | `gespidieffe.pdf2word.confirm` |
| POST | `/gespidieffe/pdf2word/applica` | `gespidieffe.pdf2word.applica` |
| GET | `/gespidieffe/pdf2word/download/{file}` | `gespidieffe.pdf2word.download` |
| DELETE/POST | `/gespidieffe/pdf2word/elimina/{file}` | `gespidieffe.pdf2word.elimina` |
| GET | `/gespidieffe/statistiche` | `gespidieffe.statistiche` |

---

## Sistema statistiche

Traccia le elaborazioni per ogni funzione con contatori giornaliero, settimanale e globale.

### Tabelle DB
- `gespidieffe_contatori` — un record per servizio
- `gespidieffe_storico_settimanale` — storico dei valori settimanali

### Servizi tracciati
`censura`, `merge`, `split`, `organizza`, `ruota`, `numera`, `unisci_organizza`, `pdf2word`

### Azzeramento automatico
- **Giornaliero**: ogni notte alle 00:00
- **Settimanale**: ogni lunedì alle 00:00 (con salvataggio storico)
- **Globale**: non si azzera mai

---

## Architettura: flusso multi-step

Ogni funzione segue questo schema:

```
1. Upload      → validazione → salva in storage/app/gespidieffe/tmp/{uuid}.pdf → redirect
2. Editor      → anteprima pagine con PDF.js (client-side) + Alpine.js
3. Elaborazione → POST → manipolazione server-side → JSON { download_token }
4. Download    → GET con token → response()->download()
5. Pulizia     → DELETE/POST elimina file sessione + scheduler rimuove file > 24h
```

**PDF to Word** ha un flusso semplificato senza editor:
```
1. Upload → 2. Conferma (rilevamento tipo PDF) → 3. Conversione → 4. Download
```

---

## Struttura del package

```
package/gespidieffe/
├── composer.json
└── src/
    ├── GespidieffeServiceProvider.php
    ├── Console/
    │   ├── PulisciTmpCommand.php
    │   └── AzzeraContatoriCommand.php
    ├── database/migrations/
    │   ├── ..._create_gespidieffe_contatori_table.php
    │   └── ..._create_gespidieffe_storico_settimanale_table.php
    ├── Models/
    │   ├── GespidieffeContatore.php
    │   └── GespidieffeStoricoSettimanale.php
    ├── Services/
    │   └── ContatorePdfService.php
    ├── Http/Controllers/
    │   ├── GespidieffeController.php
    │   ├── CensuraPdfController.php
    │   ├── MergePdfController.php
    │   ├── SplitPdfController.php
    │   ├── OrganizzaPdfController.php
    │   ├── RuotaPdfController.php
    │   ├── NumeraPdfController.php
    │   ├── UnisciOrganizzaController.php
    │   ├── PdfToWordController.php
    │   └── StatisticheController.php
    ├── routes/
    │   └── web.php
    └── resources/views/
        ├── layouts/app.blade.php
        ├── home.blade.php
        ├── censura/
        ├── merge/
        ├── split/
        ├── organizza/
        ├── ruota/
        ├── numera/
        ├── unisciorganizza/
        ├── pdftoword/
        │   └── upload.blade.php
        └── statistiche/
            └── index.blade.php
```

---

## Identificativi

| Voce | Valore |
|---|---|
| Nome Composer | `elamacchia/gespidieffe` |
| Namespace PHP | `Elamacchia\Gespidieffe\` |
| Namespace view | `gespidieffe::` |
| Service Provider | `Elamacchia\Gespidieffe\GespidieffeServiceProvider` |
| Licenza | MIT |
| Autore | Enzo Lamacchia — e.lamacchia@gmail.com |

---

## Licenza

Distribuito sotto licenza [MIT](https://opensource.org/licenses/MIT).