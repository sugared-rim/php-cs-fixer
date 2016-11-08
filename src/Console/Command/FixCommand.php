<?php

namespace SugaredRim\PhpCsFixer\Console\Command;

use Schnittstabil\Get\Get;
use SugaredRim\PhpCsFixer\ConfigFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\CS\ConfigInterface;
use Symfony\CS\Console\Command\FixCommand as BaseFixCommand;
use Symfony\CS\Fixer;

class FixCommand extends BaseFixCommand
{
    protected $configFactory;

    public function __construct(
        Fixer $fixer = null,
        ConfigInterface $config = null,
        ConfigFactory $configFactory = null
    ) {
        parent::__construct($fixer, $config);
        if ($configFactory === null) {
            $configFactory = new ConfigFactory();
        }
        $this->configFactory = $configFactory;
    }

    /*
     * Symfony/Console dosen't support options with values very well.
     * Therefore VALUE_IS_ARRAY: count() === 0 implies the option is not set.
     */
    protected function makeOptionValueOptional($name)
    {
        $inputDefinition = $this->getDefinition();
        $args = $inputDefinition->getOptions();
        $args[$name] = new InputOption(
            $name,
            null,
            InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
            $args[$name]->getDescription(),
            array()
        );
        $inputDefinition->setOptions($args);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function parseOptionalOptionValue(&$input, $name, $default)
    {
        if (count($input->getOption($name)) === 0) {
            // no option; use default
            $input->setOption($name, Get::value($name, $this->defaultConfig, $default));

            return;
        }

        $values = $input->getOption($name);
        $value = end($values);

        if ($value === null) {
            // option w/o value
            $value = true;
        }

        $input->setOption($name, filter_var($value, FILTER_VALIDATE_BOOLEAN));
    }

    protected function configure()
    {
        parent::configure();
        $this->makeOptionValueOptional('dry-run');
        $this->makeOptionValueOptional('diff');
        $this->getDefinition()->addOption(
            new InputOption(
                'namespace',
                null,
                InputOption::VALUE_REQUIRED,
                'composer.json/extra namespace',
                'schnittstabil/sugared-php-cs-fixer'
            )
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getOption('namespace');
        $this->defaultConfig = call_user_func($this->configFactory, $namespace);

        $this->parseOptionalOptionValue($input, 'diff', false);
        $this->parseOptionalOptionValue($input, 'dry-run', false);

        parent::initialize($input, $output);
    }
}
