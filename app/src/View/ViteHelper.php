<?php

namespace App\View;

use SilverStripe\Core\Environment;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * Helper class to include Vite assets in SilverStripe templates
 *
 * Usage in templates:
 *   $ViteAssets
 *
 * In development (VITE_DEV=1), loads from Vite dev server
 * In production, loads from the built manifest
 */
class ViteHelper implements TemplateGlobalProvider
{
  public static function get_template_global_variables(): array
  {
    return [
      'ViteAssets' => 'getViteAssets',
    ];
  }

  public static function getViteAssets(): string
  {
    $isDev = Environment::getEnv('VITE_DEV') === '1';
    $devServerUrl = Environment::getEnv('VITE_DEV_SERVER') ?: 'http://localhost:5173';

    if ($isDev) {
      return self::getDevAssets($devServerUrl);
    }

    return self::getProductionAssets();
  }

  protected static function getDevAssets(string $devServerUrl): string
  {
    return <<<HTML
<script type="module" src="{$devServerUrl}/@vite/client"></script>
<script type="module" src="{$devServerUrl}/src/main.jsx"></script>
HTML;
  }

  protected static function getProductionAssets(): string
  {
    $manifestPath = BASE_PATH . '/themes/my-theme/dist/.vite/manifest.json';

    if (!file_exists($manifestPath)) {
      return '<!-- Vite manifest not found. Run: npm run build -->';
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
    $entry = $manifest['src/main.jsx'] ?? null;

    if (!$entry) {
      return '<!-- Vite entry not found in manifest -->';
    }

    $baseUrl = ModuleResourceLoader::resourceURL('themes/my-theme/dist/');
    $output = '';

    // Load CSS files
    if (!empty($entry['css'])) {
      foreach ($entry['css'] as $cssFile) {
        $output .= '<link rel="stylesheet" href="' . $baseUrl . $cssFile . '">' . "\n";
      }
    }

    // Load JS entry
    $output .= '<script type="module" src="' . $baseUrl . $entry['file'] . '"></script>' . "\n";

    return $output;
  }
}
