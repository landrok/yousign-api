<?php

declare(strict_types=1);

namespace Yousign\Process;

use Yousign\Model\Factory;
use Yousign\Model\FileCollection;
use Yousign\Model\Procedure;
use Yousign\YousignApi;

/*
 * Basic class for a process
 */
abstract class AbstractProcess
{
    /**
     * Yousign API wrapper
     *
     * @var \Yousign\YousignApi
     */
    protected $api;

    /**
     * Files to send
     *
     * @var \Yousign\Model\FileCollection
     */
    protected $files;

    /**
     * Procedure to send
     *
     * @var \Yousign\Model\Procedure
     */
    protected $procedure;

    public function __construct(YousignApi $api)
    {
        $this->api = $api;
        $this->files = Factory::createFileCollection();
        $this->procedure = Factory::createProcedure([]);
    }

    /**
     * Add one file to the process
     */
    public function addFile(array $file): self
    {
        $this->files->add(
            Factory::createFile($file)
        );

        return $this;
    }

    /**
     * Add the procedure to the process
     */
    public function setProcedure(array $procedure): self
    {
        $this->procedure = Factory::createProcedure($procedure);

        return $this;
    }

    /**
     * Get the initial procedure before calling the API
     *  or the final result when API has been called with success
     */
    public function getProcedure(): Procedure
    {
        return $this->procedure;
    }

    /**
     * Get the initial files before calling the API
     *  or the final results when API has been called with success
     */
    public function getFiles(): FileCollection
    {
        return $this->files;
    }
}
