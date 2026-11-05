# WordPress-Startertheme

Dieses Theme ist für WordPress Studio und gewöhnliches WordPress-Hosting
ausgelegt. Es benötigt weder Node.js, npm, CSS-Präprozessoren noch einen
Entwicklungsserver. Änderungen an PHP, CSS und JavaScript werden nach dem
Speichern und Neuladen direkt verwendet.

## Dateien bearbeiten

- `assets/css/theme.css` ist der zentrale Einstiegspunkt für die eigenen Styles.
- Die bearbeitbaren CSS-Bereiche liegen getrennt in `assets/css/`: `constants.css`,
  `base.css`, `typography.css`, `header.css`, `menu.css`, `footer.css`,
  `forms.css`, `components.css` und `pages.css`.
- `assets/css/bootstrap.min.css` ist die lokale, an die ursprünglichen
  Theme-Variablen angepasste Bootstrap-5-Datei.
- `assets/js/main.js` ist der zentrale JavaScript-Einstiegspunkt und importiert
  weitere eigene Module wie `menu.js`.
- `configure/js-css.php` bindet die Dateien in der richtigen Reihenfolge ein und
  verwendet die Änderungszeit als Version.
- PHP-Templates, `templates/`, `acf-json/` und die Dateien in `configure/` bleiben
  die Arbeitsbereiche für Markup, ACF und WordPress-Funktionen.

## Asset-Struktur

```text
assets/
├── css/
│   ├── bootstrap.min.css
│   ├── theme.css
│   ├── constants.css
│   ├── base.css
│   ├── typography.css
│   ├── header.css
│   ├── menu.css
│   ├── footer.css
│   ├── forms.css
│   ├── components.css
│   └── pages.css
├── js/
│   └── main.js
└── img/
```

Eigene Bilder können in `assets/img/` abgelegt und mit
`get_template_directory_uri()` referenziert werden. Das Theme enthält derzeit
kein Logo-Bild; der entsprechende Footer-Bereich wird deshalb nur ausgegeben,
wenn `assets/img/logo.svg` vorhanden ist.

## Voraussetzungen

Erforderliche Plugins:

- Advanced Custom Fields PRO (`wpackagist-plugin/advanced-custom-fields:^6.5`)
- Advanced Custom Fields Extended (kostenloses Add-on für ACF PRO)

Für die ACF-Funktionen werden die vorhandenen `acf-json`-Dateien genutzt.
Zusätzliche WordPress-Konfigurationen und Plugin-Hinweise stehen weiterhin in
den PHP-Dateien dieses Themes.

## WordPress-Einstellungen

Für die Beispielseiten sollte unter **Einstellungen > Lesen** eine statische
Startseite eingerichtet werden.
