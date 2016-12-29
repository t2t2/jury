<?php namespace ProcessWire;

use League\Plates\Engine;
use ProcessWire\HookEvent;
use ProcessWire\TemplateFile;

class TemplatePlates extends WireData implements Module {
	protected $templates;

	public static function getModuleInfo() {
		return array(
			'title' => 'Plates for Processwire',
			'version' => 1,
			'author' => 't2t2',
			'summary' => 'Plates templating engine for ProcessWire.',
			'singular' => true,
			'autoload' => true,
			'requires' => array(
				'PHP>=5.4.0',
				'ProcessWire>=3.0.0'
			)
		);
	}

	public function ready() {
		if ($this->wire('page')->template->name == 'admin') {
			return;
		}
		$this->config->templateCompile = false;
		$this->addHookBefore('TemplateFile::render', $this, 'replaceRender', [
			'priority' => 9999 // Last always
		]);
	}

	/**
	 * Hook to call own renderer
	 */
	public function replaceRender(HookEvent $event) {
		$templateFile = $event->object;

		$event->return = $this->render($templateFile);
		$event->replace = true;
	}

	public function ___getEngine() {
		if ($this->templates) {
			return $this->templates;
		}

		$this->templates = new Engine($this->config->paths->templates);
		return $this->templates;
	}

	/**
	 * Custom renderer
	 */
	public function render(TemplateFile $templateFile) {
		if(!$templateFile->filename) return '';
		if(!file_exists($templateFile->filename)) {
			$error = "Template file does not exist: '$templateFile->filename'";
			if($templateFile->throwExceptions) throw new WireException($error);
			$templateFile->error($error); 
			return '';
		}
		$fileName = str_replace($this->config->paths->templates, '', $templateFile->filename);
		if (substr($fileName, -(strlen($this->config->templateExtension))) === $this->config->templateExtension) {
			$fileName = substr($fileName, 0, -(strlen($this->config->templateExtension) + 1));
		}

		// ensure that wire() functions in template file map to correct ProcessWire instance
		$templateFile->savedInstance = ProcessWire::getCurrentInstance();
		ProcessWire::setCurrentInstance($templateFile->wire());

		$templateFile->profiler = $templateFile->wire('profiler');
		$templateFile->savedDir = getcwd();	

		if($templateFile->chdir) {
			chdir($templateFile->chdir);
		} else {
			chdir(dirname($templateFile->filename));
		}
		
		$fuel = $templateFile->getArray(); // so that script can foreach all vars to see what's there

		$templates = $this->getEngine();
		$templates->addData($fuel);
		$out = $templates->render($fileName);


		if($templateFile->savedDir) chdir($templateFile->savedDir); 
		ProcessWire::setCurrentInstance($templateFile->savedInstance);

		$out = trim($out); 
		if(!strlen($out) && !$templateFile->halt && $returnValue && $returnValue !== 1) return $returnValue;

		return $out;
	}
}