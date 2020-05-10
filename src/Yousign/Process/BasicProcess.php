<?php

namespace Yousign\Process;

use Exception;
use Yousign\Model\Factory;
use Yousign\Model\FileCollection;
use Yousign\Model\Procedure;
use Yousign\YousignApi;

/*
 * Basic process wrapper
 *
 * Usage
 * --------
 *
 * use Yousign\Process\BasicProcess;
 *
 * $process = BasicProcess::create($token, $production = false)
 *          ->addFile()
 *          ->setProcedure()
 *          ->execute();
 */
class BasicProcess
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
     *
     * @return self
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
     *
     * @return self
     */
    public function setProcedure(array $procedure): self
    {
        $this->procedure = Factory::createProcedure($procedure);

        return $this;
    }

    /**
     * Get the initial procedure before calling the API
     *  or the final result when API has been called with success
     *
     * @return Yousign\Model\Procedure
     */
    public function getProcedure(): Procedure
    {
        return $this->procedure;
    }

    /**
     * Get the initial files before calling the API
     *  or the final results when API has been called with success
     *
     * @return Yousign\Model\FileCollection
     */
    public function getFiles(): FileCollection
    {
        return $this->files;
    }

    /**
     * Build the procedure's data and sends to the API
     */
    public function execute(): self
    {
        $this->checkFilesBeforeBuilding();
        $this->checkProcedureBeforeBuilding();

        // --- Build and post file
        for ($i = 0; $i < $this->files->count(); $i++) {
            $file = $this->files->offsetGet($i);

            // File is given with a base64 content
            if ($file->has('content')) {
                $this->files->offsetSet(
                    $i,
                    $this->api->postFile(
                        $file->toArray()
                    )
                );
            }
            // @todo Make file with a given path
        }

        // --- Build procedure
        foreach ($this->procedure->members as $member) {
            foreach ($member->fileObjects as $fileObject) {
                $fileObject->set('file', $this->files->offsetGet(0)->id);
            }
        }

        $this->procedure = $this->api->postProcedure(
            $this->procedure->toArray()
        );

        return $this;
    }

    /**
     * Various check about files before building
     *
     * @throws \Exception if file data does not pass validation
     * controls.
     */
    protected function checkFilesBeforeBuilding(): void
    {
        // --- At least one file has been added
        if (!$this->files->count()) {
            throw new Exception(
                "There must be at least one file to execute a procedure."
            );
        }

        foreach ($this->files as $file) {
            if (!$file->has('name')) {
                throw new Exception(
                    "Given file must have a 'name' attribute."
                );
            }
        }
    }

    /**
     * Various check about procedure before building
     *
     * @throws \Exception if procedure data does not pass validation
     * controls.
     */
    protected function checkProcedureBeforeBuilding(): void
    {
        if (!$this->procedure->has('members')) {
            throw new Exception(
                "There must be at least one member to execute a procedure."
            );
        }
    }
}
