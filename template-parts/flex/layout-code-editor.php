<?php
/**
 * Code Editor (Read-only Anzeige)
 * Felder: language (html|css|js|markdown), code (text)
 */
$lang = get_sub_field('language') ?: 'html';
$code = (string) get_sub_field('code');

if ($code !== ''):
  // kleine Klassenzuordnung für Prism/Highlight.js (falls du später nachrüstest)
  $lang_class = 'language-' . preg_replace('~[^a-z0-9-]+~i', '', $lang);
?>
<pre class="code-block p-3 bg-light rounded overflow-auto"><code class="<?php echo esc_attr($lang_class); ?>"><?php
  echo esc_html($code);
?></code></pre>
<?php endif; ?>