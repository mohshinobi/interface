<?php

namespace App\Controller;

use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RunPythonController extends AbstractController
{
    protected $parameterBag=null;
    public function ___contruct(ParameterBagInterface $parameterBag){
        $this->parameterBag = $parameterBag;
    }
 
     /**
     * @Route("/run/{slug}", name="python")
     */
 
    public function runScript( string  $slug):Response
    {
        $path = $this->getParameter('kernel.project_dir')."/public/py/";
 
        // //  '/path/to/your_script.py'
        $process = new Process(['python',  $path.$slug ]);
        $process->run();
        
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        echo $process->getOutput();
        
        return new Response("<br><br><br>   >>> Loading Python script [" .  $slug  ."]  >>>>");
    }
}
