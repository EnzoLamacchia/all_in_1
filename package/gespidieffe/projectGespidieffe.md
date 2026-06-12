# projectGespidieffe.md

Documento di contesto per il package `elamacchia/gespidieffe`.
Da leggere all'inizio di ogni sessione di lavoro su questo package.

---

## Autorizzazioni

- Leggere qualsiasi file del progetto senza chiedere conferma all'utente.
- Modificare file nel package `package/gespidieffe/` liberamente.
- Rispondere **sempre in italiano**.

---

## Ambiente di sviluppo

| Voce | Valore |
|---|---|
| Sistema operativo | Windows 10 Home — Laragon standalone |
| Shell | bash (sintassi Unix in Claude, CMD/PowerShell per tool di sistema) |
| PHP | 8.1 (Laragon) |
| Framework | Laravel 9 |
| Frontend | Tailwind CSS, Alpine.js, Vite 4 |
| Database | MariaDB (Laragon) |
| App URL | http://develsolution.test |

### Comandi principali

```bash
php artisan migrate
php artisan db:seed
npm run build        # compila asset
npm run dev          # Vite dev server
php artisan test
composer pint        # formattazione codice
```

### Strumenti di sistema richiesti (installati su Windows/Laragon)

- `qpdf` — manipolazione PDF (conteggio pagine, estrazione, merge, rotazione)
- `gs` / `gswin64c` (Ghostscript) — rasterizzazione pagine PDF in PNG — `C:/Program Files/gs/gs10.07.0/bin/gswin64c.exe`
- `pdftk` — overlay/stamp PDF
- `python` (Laragon) — `C:/laragon8/bin/python/python-3.13/python.exe` — con `pdf2docx` installato via pip
- `tesseract` — OCR — `C:/Program Files/Tesseract-OCR/tesseract.exe` — con lang pack `ita`
- `pdftotext` / `pdfimages` / `pdfinfo` (Poppler) — `C:/poppler-25.12.0/Library/bin/`
- `pandoc` — conversione testo → docx
- `soffice` (LibreOffice headless) — `C:/Program Files/LibreOffice/program/soffice.exe`

### Variabili .env richieste per PDF to Word

```env
GESPIDIEFFE_PYTHON_BIN="C:/laragon8/bin/python/python-3.13/python.exe"
GESPIDIEFFE_LIBREOFFICE_BIN="C:/Program Files/LibreOffice/program/soffice.exe"
GESPIDIEFFE_TESSERACT_BIN="C:/Program Files/Tesseract-OCR/tesseract.exe"
GESPIDIEFFE_PDFTOTEXT_BIN="C:/poppler-25.12.0/Library/bin/pdftotext.exe"
GESPIDIEFFE_PDFIMAGES_BIN="C:/poppler-25.12.0/Library/bin/pdfimages.exe"
GESPIDIEFFE_PDFINFO_BIN="C:/poppler-25.12.0/Library/bin/pdfinfo.exe"
GESPIDIEFFE_GS_BIN="C:/Program Files/gs/gs10.07.0/bin/gswin64c.exe"
```

**NOTA**: i path nel `.env` devono usare forward slash (`/`) non backslash — altrimenti il parser dotenv di Laravel genera errore "unexpected escape sequence".

---

## Struttura del package

```
package/gespidieffe/
├── composer.json
└── src/
    ├── GespidieffeServiceProvider.php
    ├── Console/
    │   ├── PulisciTmpCommand.php
    │   └── AzzeraContatoriCommand.php          ← NUOVO
    ├── database/migrations/
    │   ├── ..._create_gespidieffe_contatori_table.php          ← NUOVO
    │   └── ..._create_gespidieffe_storico_settimanale_table.php ← NUOVO
    ├── Models/
    │   ├── GespidieffeContatore.php             ← NUOVO
    │   └── GespidieffeStoricoSettimanale.php    ← NUOVO
    ├── Services/
    │   └── ContatorePdfService.php              ← NUOVO
    ├── Http/Controllers/
    │   ├── GespidieffeController.php
    │   ├── CensuraPdfController.php
    │   ├── MergePdfController.php
    │   ├── SplitPdfController.php
    │   ├── OrganizzaPdfController.php
    │   ├── RuotaPdfController.php
    │   ├── NumeraPdfController.php
    │   ├── UnisciOrganizzaController.php
    │   ├── PdfToWordController.php              ← NUOVO
    │   └── StatisticheController.php
    ├── routes/
    │   └── web.php
    └── resources/views/
        ├── layouts/app.blade.php
        ├── home.blade.php
        ├── censura/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── merge/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── split/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── organizza/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── ruota/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── numera/
        │   ├── upload.blade.php
        │   └── editor.blade.php
        ├── pdftoword/
        │   └── upload.blade.php                 ← NUOVO (step 1 + 2 + 3 in unico file)
        ├── unisciorganizza/
        │   ├── upload.blade.php
        │   ├── editor-merge.blade.php
        │   └── editor-organizza.blade.php
        └── statistiche/
            └── index.blade.php
```

### Percorso assoluto (WSL)

```
/home/elamacchia/code/napp/package/gespidieffe/
```

### Percorso da Windows/VSCode

```
\\wsl$\Ubuntu-18.04\home\elamacchia\code\napp\package\gespidieffe\
```

---

## Identificativi del package

| Voce | Valore |
|---|---|
| Nome Composer | `elamacchia/gespidieffe` |
| Namespace PHP | `Elamacchia\Gespidieffe\` |
| Namespace view | `gespidieffe::` |
| Dipendenze PHP | `setasign/fpdi ^2.3`, `tecnickcom/tcpdf ^6.5` |
| Service Provider | `Elamacchia\Gespidieffe\GespidieffeServiceProvider` |
| Registrato in | `config/app.php` (autoload Composer) |

---

## Route

Tutte le route sono protette da middleware `['web', 'auth:sanctum', 'verified']`.
Prefix: `/gespidieffe` — Named prefix: `gespidieffe.`

| Metodo | URI | Controller | Nome |
|---|---|---|---|
| GET | `/gespidieffe/` | `GespidieffeController@index` | `gespidieffe.home` |
| GET | `/gespidieffe/censura` | `CensuraPdfController@index` | `gespidieffe.censura` |
| POST | `/gespidieffe/censura/upload` | `CensuraPdfController@upload` | `gespidieffe.censura.upload` |
| GET | `/gespidieffe/censura/editor/{file}` | `CensuraPdfController@editor` | `gespidieffe.censura.editor` |
| POST | `/gespidieffe/censura/applica` | `CensuraPdfController@applica` | `gespidieffe.censura.applica` |
| GET | `/gespidieffe/censura/download/{file}` | `CensuraPdfController@download` | `gespidieffe.censura.download` |
| DELETE/POST | `/gespidieffe/censura/elimina/{file}` | `CensuraPdfController@elimina` | `gespidieffe.censura.elimina` |
| GET | `/gespidieffe/censura/pdf/{file}` | `CensuraPdfController@servePdf` | `gespidieffe.censura.pdf` |
| GET | `/gespidieffe/merge` | `MergePdfController@index` | `gespidieffe.merge` |
| POST | `/gespidieffe/merge/upload` | `MergePdfController@upload` | `gespidieffe.merge.upload` |
| GET | `/gespidieffe/merge/editor/{session}` | `MergePdfController@editor` | `gespidieffe.merge.editor` |
| GET | `/gespidieffe/merge/aggiungi/{session}` | `MergePdfController@aggiungi` | `gespidieffe.merge.aggiungi` |
| POST | `/gespidieffe/merge/applica` | `MergePdfController@applica` | `gespidieffe.merge.applica` |
| GET | `/gespidieffe/merge/download/{file}` | `MergePdfController@download` | `gespidieffe.merge.download` |
| DELETE/POST | `/gespidieffe/merge/elimina/{session}` | `MergePdfController@elimina` | `gespidieffe.merge.elimina` |
| GET | `/gespidieffe/merge/pdf/{session}/{index}` | `MergePdfController@servePdf` | `gespidieffe.merge.pdf` |
| GET | `/gespidieffe/split` | `SplitPdfController@index` | `gespidieffe.split` |
| POST | `/gespidieffe/split/upload` | `SplitPdfController@upload` | `gespidieffe.split.upload` |
| GET | `/gespidieffe/split/editor/{file}` | `SplitPdfController@editor` | `gespidieffe.split.editor` |
| POST | `/gespidieffe/split/applica` | `SplitPdfController@applica` | `gespidieffe.split.applica` |
| GET | `/gespidieffe/split/download/{file}` | `SplitPdfController@download` | `gespidieffe.split.download` |
| GET | `/gespidieffe/split/download-zip/{file}` | `SplitPdfController@downloadZip` | `gespidieffe.split.download-zip` |
| DELETE/POST | `/gespidieffe/split/elimina/{file}` | `SplitPdfController@elimina` | `gespidieffe.split.elimina` |
| GET | `/gespidieffe/split/pdf/{file}` | `SplitPdfController@servePdf` | `gespidieffe.split.pdf` |
| GET | `/gespidieffe/organizza` | `OrganizzaPdfController@index` | `gespidieffe.organizza` |
| POST | `/gespidieffe/organizza/upload` | `OrganizzaPdfController@upload` | `gespidieffe.organizza.upload` |
| GET | `/gespidieffe/organizza/editor/{file}` | `OrganizzaPdfController@editor` | `gespidieffe.organizza.editor` |
| POST | `/gespidieffe/organizza/applica` | `OrganizzaPdfController@applica` | `gespidieffe.organizza.applica` |
| GET | `/gespidieffe/organizza/download/{file}` | `OrganizzaPdfController@download` | `gespidieffe.organizza.download` |
| DELETE/POST | `/gespidieffe/organizza/elimina/{file}` | `OrganizzaPdfController@elimina` | `gespidieffe.organizza.elimina` |
| GET | `/gespidieffe/organizza/pdf/{file}` | `OrganizzaPdfController@servePdf` | `gespidieffe.organizza.pdf` |
| GET | `/gespidieffe/ruota` | `RuotaPdfController@index` | `gespidieffe.ruota` |
| POST | `/gespidieffe/ruota/upload` | `RuotaPdfController@upload` | `gespidieffe.ruota.upload` |
| GET | `/gespidieffe/ruota/editor/{file}` | `RuotaPdfController@editor` | `gespidieffe.ruota.editor` |
| POST | `/gespidieffe/ruota/applica` | `RuotaPdfController@applica` | `gespidieffe.ruota.applica` |
| GET | `/gespidieffe/ruota/download/{file}` | `RuotaPdfController@download` | `gespidieffe.ruota.download` |
| DELETE/POST | `/gespidieffe/ruota/elimina/{file}` | `RuotaPdfController@elimina` | `gespidieffe.ruota.elimina` |
| GET | `/gespidieffe/ruota/pdf/{file}` | `RuotaPdfController@servePdf` | `gespidieffe.ruota.pdf` |
| GET | `/gespidieffe/numera` | `NumeraPdfController@index` | `gespidieffe.numera` |
| POST | `/gespidieffe/numera/upload` | `NumeraPdfController@upload` | `gespidieffe.numera.upload` |
| GET | `/gespidieffe/numera/editor/{file}` | `NumeraPdfController@editor` | `gespidieffe.numera.editor` |
| POST | `/gespidieffe/numera/applica` | `NumeraPdfController@applica` | `gespidieffe.numera.applica` |
| GET | `/gespidieffe/numera/download/{file}` | `NumeraPdfController@download` | `gespidieffe.numera.download` |
| DELETE/POST | `/gespidieffe/numera/elimina/{file}` | `NumeraPdfController@elimina` | `gespidieffe.numera.elimina` |
| GET | `/gespidieffe/numera/pdf/{file}` | `NumeraPdfController@servePdf` | `gespidieffe.numera.pdf` |
| GET | `/gespidieffe/statistiche` | `StatisticheController@index` | `gespidieffe.statistiche` |
| GET | `/gespidieffe/pdf2word` | `PdfToWordController@index` | `gespidieffe.pdf2word` |
| POST | `/gespidieffe/pdf2word/upload` | `PdfToWordController@upload` | `gespidieffe.pdf2word.upload` |
| GET | `/gespidieffe/pdf2word/confirm/{file}` | `PdfToWordController@confirm` | `gespidieffe.pdf2word.confirm` |
| POST | `/gespidieffe/pdf2word/applica` | `PdfToWordController@applica` | `gespidieffe.pdf2word.applica` |
| GET | `/gespidieffe/pdf2word/download/{file}` | `PdfToWordController@download` | `gespidieffe.pdf2word.download` |
| DELETE/POST | `/gespidieffe/pdf2word/elimina/{file}` | `PdfToWordController@elimina` | `gespidieffe.pdf2word.elimina` |

---

## Architettura: pattern flusso multi-step

Ogni funzione del package segue questo schema:

1. **Upload** → validazione → salva in `storage/app/gespidieffe/tmp/{uuid}.pdf` → redirect all'editor
2. **Editor/Preview** → rendering client-side con PDF.js → Alpine.js per interazione
3. **Elaborazione** → POST con dati operazione → manipolazione PDF server-side (qpdf + Ghostscript + TCPDF) → risposta JSON con `download_token`
4. **Download** → GET con token → `response()->download()`
5. **Pulizia** → DELETE/POST elimina file temporanei → scheduler orario rimuove file > 24h

### File temporanei

- Cartella: `storage/app/gespidieffe/tmp/`
- Naming: `{uuid}.pdf` (originale), `{uuid}_<suffisso>.pdf` (output)
- Pulizia automatica: comando `gespidieffe:pulisci-tmp --ore=24` ogni ora via scheduler

---

## Funzioni della home (stato attuale)

| Funzione | Stato | Controller | Note |
|---|---|---|---|
| Censura PDF | ✅ Implementata | `CensuraPdfController` | Flusso ibrido vettoriale/raster. Rettangoli bruciati direttamente sui pixel PNG via GD — contenuto irrecuperabile |
| Merge PDF | ✅ Implementata | `MergePdfController` | Upload multiplo + drag&drop riordinamento (SortableJS, card JS puro senza x-for) + qpdf merge. Bollino blu = ID fisso upload, ordine visuale = ordine merge | Upload duale: nuova sessione (min 2 file) o aggiunta a sessione esistente via aggiungi/{session} (min 1 file). Pulsante Aggiungi file in editor naviga senza eliminare la sessione (flag _mergeSkipCleanup). Alert JS se submit con 1 solo file in modalita normale |
| Split PDF | ✅ Implementata | `SplitPdfController` | Modalità singole/intervalli, download PDF singolo o ZIP |
| Organizza pagine | ✅ Implementata | `OrganizzaPdfController` | Griglia drag&drop (Sortable.js) + duplica/elimina + spostamento singolo e blocchi multipli (Ctrl+click) + qpdf ricostruzione. DOM card gestito interamente da JS (no x-for), stesso pattern del merge. |
| Ruota pagine | ✅ Implementata | `RuotaPdfController` | Click per +90°/card, "Ruota tutto", badge gradi, qpdf --rotate |
| Numera pagine | ✅ Implementata | `NumeraPdfController` | TCPDF overlay + pdftk stamp, testo originale selezionabile; controlli editor centrati nella colonna sinistra |
| Unisci e Organizza | ✅ Implementata | `UnisciOrganizzaController` | Flusso in due step: merge multi-file poi riorganizzazione pagine del risultato |
| PDF to Word | ✅ Implementata | `PdfToWordController` | Rilevamento automatico tipo PDF (nativo/ibrido/scansionato), conversione con pdf2docx / pdftotext+Pandoc / Tesseract+Ghostscript+LibreOffice. Flusso: upload → conferma+tipo → conversione → download |

---

## UX globale (layout condiviso)

- **Dropdown "Funzioni"** nella navbar (`layouts/app.blade.php`): permette di navigare a qualsiasi funzione del package senza tornare alla home. Usa Alpine.js `x-data` con `@click.outside`. Posizionato a destra con `mr-6` per separarlo da nome utente e Dashboard.
- Il dropdown è presente in **tutte** le pagine (upload ed editor) di ogni funzione.

---

## Sistema contatori utilizzo

Implementato sistema di tracciamento delle elaborazioni PDF per funzione.

### Tabelle DB
- `gespidieffe_contatori` — un record per servizio con contatori giornaliero, settimanale, globale
- `gespidieffe_storico_settimanale` — storico dei valori settimanali salvati prima dell'azzeramento

### Logica azzeramento
- **Giornaliero**: ogni notte alle 00:00 via `gespidieffe:azzera-contatori` → azzera `contatore_giornaliero`
- **Settimanale**: ogni lunedì alle 00:00 (lo stesso command) → salva lo storico su `gespidieffe_storico_settimanale` poi azzera `contatore_settimanale`
- **Globale**: non si azzera mai

### File coinvolti
- `Services/ContatorePdfService::incrementa(string $servizio)` — chiamato da ogni controller nel metodo `applica()`
- `Console/AzzeraContatoriCommand` — schedulato `dailyAt('00:00')` nel ServiceProvider
- Route `/gespidieffe/statistiche` — protetta da `auth:sanctum` + `verified` + `permission:usa gespidieffe`

## PDF to Word — note tecniche

- **Rilevamento tipo PDF**: `rilevaTipoPdf()` usa `qpdf --show-npages` + `pdfinfo` + `pdfimages -list` + `pdftotext` per classificare in `nativo` / `ibrido` / `scansionato`
- **Nativo** → `pdf2docx` (Python) via `exec()` — preserva layout, tabelle, immagini
- **Ibrido** → `pdftotext -layout` per estrarre testo OCR invisibile già presente → `pandoc` per produrre `.docx`
- **Scansionato** → `gswin64c` rasterizza ogni pagina a 300 DPI → `tesseract -l ita+eng` fa OCR → `soffice --headless --convert-to docx` assembla il `.docx`
- **Output**: `{uuid}_pdf2word.docx` in `storage/app/gespidieffe/tmp/`
- **PHP non trova i binari di sistema**: su Windows il processo PHP (Laragon) non eredita il PATH di sistema. Tutti i binari vanno specificati con percorso assoluto nel `.env` usando forward slash
- **Python da usare**: `C:/laragon8/bin/python/python-3.13/python.exe` (bundled con Laragon, ha pdf2docx installato). Il `python` di sistema su Windows punta allo stub Microsoft Store → exit code 9009

## Prossimo obiettivo

Tutte le funzioni previste sono state implementate. Nessun obiettivo pendente.

---

## Note tecniche importanti

- **TCPDF**: usare `new \TCPDF(...)` (namespace globale, non importato)
- **FPDI + TCPDF**: per sovrapporre testo su PDF esistente — `$pdf->setSourceFile()`, `$pdf->importPage()`, `$pdf->useImportedPage()`
- **Coordinate PDF**: i rettangoli passati dal frontend sono in **punti PDF** (pt). Conversione in mm: `mm = pt * (25.4 / 72.0)`. Conversione in pixel (per GD): `px = pt * (dpi / 72.0)` dove dpi=200
- **Censura sicura**: i rettangoli vengono bruciati sul PNG con `imagefilledrectangle()` (GD) prima di inserire l'immagine in TCPDF — nessun layer vettoriale sovrapposto, contenuto irrecuperabile anche copiando dal PDF
- **Orientamento pagina TCPDF**: se `larghezza > altezza` → `'L'` (landscape), altrimenti `'P'` (portrait)
- **qpdf merge**: `qpdf --empty --pages file1 file2 ... -- output.pdf`
- **qpdf pagina singola**: `qpdf source.pdf --pages . {N} -- output.pdf`
- **qpdf rotazione**: `qpdf input.pdf --rotate=+90:1 --rotate=+180:3 -- output.pdf`
- **Ghostscript rasterizza pagina**: `gs -dNOPAUSE -dBATCH -sDEVICE=png16m -r200 -dFirstPage={N} -dLastPage={N} -sOutputFile=out.png input.pdf`
- **Storage path**: `storage_path('app/gespidieffe/tmp/')` → `/var/www/html/storage/app/gespidieffe/tmp/` nel container
- **Redirect stderr cross-platform**: tutti i comandi shell usano `$null = PHP_OS_FAMILY === 'Windows' ? 'NUL' : '/dev/null'` e `2>' . $null` — funziona sia in sviluppo (Windows/Laragon) che in produzione (Linux)
- **pdftk multistamp**: `pdftk input.pdf multistamp overlay.pdf output output.pdf` — sovrappone pagina N dell'overlay alla pagina N del documento originale. Usare `multistamp` (non `stamp`): `stamp` applica solo la pagina 1 dell'overlay a tutte le pagine. Richiede `pdftk` installato nel container (aggiunto al Dockerfile riga 17)
- **Numera pagine**: TCPDF genera un overlay PDF trasparente con soli numeri (una pagina per ogni pagina del documento), `pdftk multistamp` lo applica all'originale. Le dimensioni di ogni pagina vengono lette con `qpdf --json`
- **Organizza pagine — pattern DOM JS puro**: l'editor usa lo stesso pattern del merge — niente `x-for` Alpine, le card sono costruite con `_buildGrid()` / `_creaCard()` e inserite/spostate nel DOM direttamente. Sortable sincronizza l'array `window._orgPages` con `splice(oldIndex,1)` + `splice(newIndex,0,moved)` per il singolo; per il blocco multiplo sposta i nodi DOM con `insertBefore` senza ricostruire le card (i canvas rimangono intatti). L'ordine al salvataggio viene letto dal DOM (`querySelectorAll('#gridContainer > [data-uid]')`). I pulsanti azione usano `data-action-uid` (non `data-uid`) per non essere intercettati dai querySelectorAll sulle card.
