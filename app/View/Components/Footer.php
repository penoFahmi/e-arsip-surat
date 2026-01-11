<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Config;
use App\Enums\Config as ConfigEnum; // Pastikan namespace Enum benar

class Footer extends Component
{
    /**
     * Data konfigurasi yang akan dikirim ke view.
     */
    public $config;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $institutionName = Config::where('code', 'institution_name')->value('value') ?? 'Nama Instansi';

        $this->config = [
            'institution_name' => $institutionName,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
