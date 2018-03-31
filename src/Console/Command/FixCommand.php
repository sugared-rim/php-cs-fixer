<?php



namespace SugaredRim\PhpCsFixer\Console\Command;

use ReflectionMethod;
use ReflectionProperty;
use Schnittstabil\Get;
use SugaredRim\PhpCsFixer\Config;
use SugaredRim\PhpCsFixer\ConfigFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Console\Command\FixCommand as FixCmd;
use PhpCsFixer\Fixer;
use PhpCsFixer\ToolInfo;
use Symfony\Component\Console\Input\InputArgument;

class FixCommand extends Command
{
    const COMMAND_NAME = 'fix';

    /**
     * @var FixCmd
     */
    protected $fixCmd;

    /**
     * @var ConfigFactory
     */
    protected $configFactory;

    /**
     * @var Config
     */
    protected $defaultConfig;

    public function __construct(ConfigFactory $configFactory = null, FixCmd $fixCmd = null)
    {
        if ($configFactory === null) {
            $configFactory = $this->buildDefaultConfigFactory();
        }
        $this->configFactory = $configFactory;

        if ($fixCmd === null) {
            $fixCmd = $this->buildDefaultFixCommand();
        }
        $this->fixCmd = $fixCmd;

        parent::__construct(self::COMMAND_NAME);
    }

    /**
     * @return FixCmd
     */
    protected function buildDefaultFixCommand()
    {
        return new FixCmd(new ToolInfo);
    }

    /**
     * @return ConfigFactory
     */
    protected function buildDefaultConfigFactory()
    {
        return new ConfigFactory;
    }

    /**
     * @param InputInterface $input
     * @param string $name
     * @param bool $default
     */
    protected function parseOptionalOptionValue(&$input, $name, $default)
    {
        $values = $input->getOption($name);

        if (count($values) === 0) {
            // no option; use default
            $input->setOption($name, Get\value($name, $this->defaultConfig, $default));

            return;
        }

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
        $this->setDefinition([
            new InputArgument('path', InputArgument::IS_ARRAY, 'The path.'),
            new InputOption('path-mode', '', InputOption::VALUE_REQUIRED, 'Specify path mode (can be override or intersection).', 'override'),
            new InputOption('allow-risky', '', InputOption::VALUE_REQUIRED, 'Are risky fixers allowed (can be yes or no).'),
            new InputOption('config', '', InputOption::VALUE_REQUIRED, 'The path to a .php_cs file.'),
            new InputOption('dry-run', '', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Only shows which files would have been modified.'),
            new InputOption('rules', '', InputOption::VALUE_REQUIRED, 'The rules.'),
            new InputOption('using-cache', '', InputOption::VALUE_REQUIRED, 'Does cache should be used (can be yes or no).'),
            new InputOption('cache-file', '', InputOption::VALUE_REQUIRED, 'The path to the cache file.'),
            new InputOption('diff', '', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Also produce diff for each file.'),
            new InputOption('diff-format', '', InputOption::VALUE_REQUIRED, 'Specify diff format.'),
            new InputOption('format', '', InputOption::VALUE_REQUIRED, 'To output results in other formats.'),
            new InputOption('stop-on-violation', '', InputOption::VALUE_NONE, 'Stop execution on first violation.'),
            new InputOption('show-progress', '', InputOption::VALUE_REQUIRED, 'Type of progress indicator (none, run-in, estimating, estimating-max or dots).'),
            new InputOption('namespace', null, InputOption::VALUE_REQUIRED, 'composer.json/extra namespace', 'sugared-rim/php-cs-fixer'),
        ])->setDescription('Fixes a directory or a file.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $namespace = $input->getOption('namespace');
        $this->defaultConfig = call_user_func($this->configFactory, $namespace);

        $fixCmdDefaultConfig = new ReflectionProperty(FixCmd::class, 'defaultConfig');
        $fixCmdDefaultConfig->setAccessible(true);
        $fixCmdDefaultConfig->setValue($this->fixCmd, $this->defaultConfig);

        $this->parseOptionalOptionValue($input, 'diff', false);
        $this->parseOptionalOptionValue($input, 'dry-run', false);

        parent::initialize($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fixCmdConfigure = new ReflectionMethod(FixCmd::class, 'execute');
        $fixCmdConfigure->setAccessible(true);
        return $fixCmdConfigure->invoke($this->fixCmd, $input, $output);
    }
}
