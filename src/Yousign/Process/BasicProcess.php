<?php

declare(strict_types=1);

namespace Yousign\Process;

use Exception;
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
class BasicProcess extends AbstractProcess
{
    public function __construct(YousignApi $api)
    {
        parent::__construct($api);
    }

    /**
     * Build the procedure's data and sends to the API
     */
    public function execute(): self
    {
        $this->checkFilesBeforeBuilding();
        $this->checkProcedureBeforeBuilding();

        // --- Build and post file
        $count = $this->files->count();
        for ($i = 0; $i < $count; $i++) {
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
        if (! $this->files->count()) {
            throw new Exception(
                'There must be at least one file to execute a procedure.'
            );
        }

        foreach ($this->files as $file) {
            if (! $file->has('name')) {
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
        if (! $this->procedure->has('members')) {
            throw new Exception(
                'There must be at least one member to execute a procedure.'
            );
        }
    }
}
