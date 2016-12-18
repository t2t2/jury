<?php
namespace t2t2\JuRYShow\Install;

use Composer\Installer\PackageEvent;
use Composer\Package\PackageInterface;
use function Symfony\Component\VarDumper\VarDumper\dump;

/**
 * 
 */
class UpdateStaticFiles {

	static $paths;

	public static function postInstalledModule(PackageEvent $event) {
		$package = $event->getOperation()->getPackage();
		$paths = static::getPaths($event, $package);

		if ($paths) {
			static::installAssets($paths);
		}
	}

	public static function postRemovedModule(PackageEvent $event) {
		$package = $event->getOperation()->getPackage();
		$paths = static::getPaths($event, $package);

		if ($paths && is_dir($paths['target'])) {
			static::delTree($paths['target']);
		}
	}

	protected static function getPaths(PackageEvent $event, PackageInterface $package) {
		if (!static::$paths) {
			static::$paths = require(getcwd() . '/bootstrap/paths.php');
		}

		if ($package->getName() === 'processwire/processwire') {
			return [
				'base' => static::$paths['paths']['root'] . static::$paths['paths']['wire'],
				'target' => static::$paths['paths']['root'] . static::$paths['paths']['public'] . static::$paths['urls']['wire']
			];
		} elseif ($package->getType() === 'pw-module') {
			$installPath = getcwd() . '/' . $event->getComposer()->getInstallationManager()->getInstallPath($package);
			$modulesPath = static::$paths['paths']['root'] . static::$paths['paths']['siteModules'];
			if (substr($installPath, 0, strlen($modulesPath)) === $modulesPath) {
				$packageDir = substr($installPath, strlen($modulesPath));
				return [
					'base' => $installPath,
					'target' => static::$paths['paths']['root'] . static::$paths['paths']['public'] . static::$paths['urls']['siteModules'] . $packageDir
				];
			}
		}
		return false;
	}

	protected static function installAssets($paths) {
		echo 'Copying static assets to public' . PHP_EOL;

		$base = $paths['base'];
		$target = $paths['target'];

		// Clean up old
		if (is_dir($target)) {
			static::delTree($target);
		}

		$dir = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($base));
		$filtered = new \RegexIterator($dir, '/\.(?:css|js|html|gif|png|eot|svg|ttf|woff2?)$/', \RegexIterator::MATCH);

		foreach ($filtered as $file) {
			$from = $file->getPathname();
			$to = str_replace($base, $target, $from);

			$targetDir = pathinfo($to, PATHINFO_DIRNAME);
			if (!is_dir($targetDir)) {
				mkdir($targetDir, 0755, true);
			}

			copy($from, $to);
		}

		echo 'Complete!' . PHP_EOL;
	}

	public static function makeInstaller() {
		copy(__DIR__ . '/install.stub', __DIR__ . '/../../public/install.php');
		echo 'Made install.php' . PHP_EOL;
	}

	protected static function delTree($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? static::delTree("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}
}
