<?php

namespace Maatwebsite\LaravelNovaExcel\Actions;

use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;

class DownloadExcel extends ExportToExcel
{
    /**
     * @var string
     */
    protected $disk = 'public';

    /**
     * @inheritdoc
     */
    public function handle($response)
    {
        if (false === $response) {
            return Action::danger(__('Resource export could not be downloaded.'));
        }

        return Action::download(
            $this->getDownloadUrl(),
            $this->getFilename()
        );
    }

    /**
     * @return string
     */
    private function getDownloadUrl()
    {
        return url(Storage::disk($this->getDisk())->url($this->getFilename()));
    }
}