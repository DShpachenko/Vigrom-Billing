<?php

namespace App\Console\Commands;

use App\Models\Billing\CurrencyRates;
use App\Repositories\Billing\CurrencyRatesRepository;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class UpdateRates
 * @package App\Console\Commands
 */
class UpdateRates extends Command
{
    /**
     * Ссылка на центра-банк со списком валют.
     */
    public const CBR_CURRENCIES = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @var Client
     */
    public $client;

    /**
     * @var CurrencyRatesRepository
     */
    public $repository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление списка валютных пар для конвертации.';

    /**
     * Create a new command instance.
     *
     * @param Client $client
     * @param CurrencyRatesRepository $repository
     */
    public function __construct(Client $client, CurrencyRatesRepository $repository)
    {
        parent::__construct();

        $this->client = $client;
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(): void
    {
        $response = $this->client->request('GET', self::CBR_CURRENCIES);
        $xml = simplexml_load_string($response->getBody());
        $json = json_encode($xml);
        $currencies = json_decode($json,TRUE);

        foreach ($currencies['Valute'] as $currency) {
            if ($currency['CharCode'] === 'USD') {
                $value = str_replace(',','.',$currency['Value']);

                DB::beginTransaction();

                try {
                    CurrencyRates::truncate();

                    $this->repository->create([
                        'currency_from' => 'USD',
                        'currency_to' => 'RUB',
                        'rate' => (float) $value,
                    ]);

                    $this->repository->create([
                        'currency_from' => 'RUB',
                        'currency_to' => 'USD',
                        'rate' => (float) (1 / $value),
                    ]);

                    DB::commit();
                    echo 'Успешно!'.PHP_EOL;
                } catch (\Exception $e) {
                    DB::rollBack();
                    echo 'Ошибка!'.PHP_EOL;
                }

                exit;
            }
        }
    }
}
