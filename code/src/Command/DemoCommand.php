<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Output\OutputInterface;
use App\Mailer\Mailer;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Style\SymfonyStyle;

class DemoCommand extends Command
{
    protected static $defaultName = 'app:demo';

    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addOption('option', 'o', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Description')
            ->addArgument('arg', InputArgument::REQUIRED, 'Documentation')
            ->setHelp(
                '<info>Titre de l\'aide</info>

* Exemple aide
                '
            )
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('Give arg', ['orange', 'lapin']);

        $input->setArgument('arg', $helper->ask($input, $output, $question));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
    
        $io = new SymfonyStyle($input, $output);
        $io->title('Lorem Ipsum Dolor Sit Amet');

        $io->table(['Title', 'name'], [
            ['Book', 'Author'],
            ['Book', 'Author'],
            ['Book', 'Author'],
        ]);

        $progressBar = new ProgressBar($output, 50);

        $progressBar->start();

        $i = 0;
        while ($i++ < 50) {
            // ... do some work

            // advances the progress bar 1 unit
            $progressBar->advance();

            // you can also advance the progress bar by more than 1 unit
            // $progressBar->advance(3);
          //  sleep(1);
        }

        // ensures that the progress bar is at 100%
        $progressBar->finish();

        dump($input->getOption('option'), $input->getArgument('arg'));

        $this->mailer->send('test');

        return 0;
    }
}
