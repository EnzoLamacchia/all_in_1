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
| Sistema operativo | WSL Ubuntu 18.04 su Windows 10 Home |
| Shell | bash (sintassi Unix) |
| PHP | 8.1 |
| Framework | Laravel 9 |
| Frontend | Tailwind CSS, Alpine.js, Vite 4 |
| Database | MariaDB 10 (Docker/Sail) |
| Cache | Redis (Docker/Sail) |
| App URL | http://localhost |
| Adminer | http://localhost:8087 |
| Vite dev | porta 5174 |

### Comandi principali

```bash
./vendor/bin/sail up -d          # avvia Docker
./vendor/bin/sail down           # ferma Docker
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
npm run build                    # compila asset
npm run dev                      # Vite dev server
./vendor/bin/sail artisan test
./vendor/bin/sail composer pint  # formattazione codice
```

### Strumenti di sistema richiesti (nel container Docker)

- `qpdf` — manipolazione PDF (conteggio pagine, estrazione, merge, rotazione)
- `gs` (Ghostscript) — rasterizzazione pagine PDF in PNG

---

## Struttura del package

```
package/gespidieffe/
├── composer.json
└── src/
    ├── GespidieffeServiceProvider.php
    ├── Console/
    │   └── PulisciTmpCommand.php
    ├── Http/Controllers/
    │   ├── GespidieffeController.php
    │   ├── CensuraPdfController.php
    │   ├── MergePdfController.php
    │   ├── SplitPdfController.php
    │   ├── OrganizzaPdfController.php
    │   ├── RuotaPdfController.php
    │   └── NumeraPdfController.php
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
        └── numera/
            ├── upload.blade.php
            └── editor.blade.php
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
| Merge PDF | ✅ Implementata | `MergePdfController` | Upload multiplo + drag&drop riordinamento (SortableJS, card JS puro senza x-for) + qpdf merge. Bollino blu = ID fisso upload, ordine visuale = ordine merge |
| Split PDF | ✅ Implementata | `SplitPdfController` | Modalità singole/intervalli, download PDF singolo o ZIP |
| Organizza pagine | ✅ Implementata | `OrganizzaPdfController` | Griglia drag&drop (Sortable.js) + duplica/elimina + qpdf ricostruzione |
| Ruota pagine | ✅ Implementata | `RuotaPdfController` | Click per +90°/card, "Ruota tutto", badge gradi, qpdf --rotate |
| Numera pagine | ✅ Implementata | `NumeraPdfController` | TCPDF overlay + pdftk stamp, testo originale selezionabile; controlli editor centrati nella colonna sinistra |

---

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